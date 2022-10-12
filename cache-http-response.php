<?php
/**
 * Plugin Name:         Cache HTTP Response.
 * Plugin URI:          https://github.com/nawawi/cache-http-response
 * Version:             1.0.0
 * Description:         Performance tweaks for WordPress to cache HTTP API Call response.
 * GitHub Plugin URI:   https://github.com/nawawi/cache-http-response
 * Author:              Nawawi Jamili
 * Author URI:          https://github.com/nawawi
 * Requires at least:   5.6
 * Requires PHP:        7.4
 * License:             GPLv2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Nawawi\CacheHttpResponse;

\defined('ABSPATH') || exit;

final class cache_http_response
{
    private $cache_prefix = 'cachehttpresponse_';
    private $cache_ttl = 300;
    private $cache_include = [];
    private $cache_exclude = [];

    public function register()
    {
        add_action('init', function () {
            add_filter('http_response', [$this, 'http_response'], \PHP_INT_MIN, 3);
            add_filter('pre_http_request', [$this, 'pre_http_request'], \PHP_INT_MIN, 3);
        }, \PHP_INT_MAX);
    }

    private function cache_key($url)
    {
        return $this->cache_prefix.md5($url);
    }

    public function http_response($response, $args, $url)
    {
        if (200 !== $response['response']['code']) {
            return $response;
        }

        $site_host = wp_parse_url(site_url(), \PHP_URL_HOST);
        $hostname = wp_parse_url($url, \PHP_URL_HOST);

        // Exclude wp.org.
        if (apply_filters('cache_http_reponse/exclude_wporg', true) && 'wordpress.org' === $hostname || '.wordpress.org' === substr($hostname, -\strlen('.wordpress.org'))) {
            return $response;
        }

        // Exclude Localhost.
        if (apply_filters('cache_http_reponse/exclude_localhost', true) && false !== strpos($hostname, $site_host)) {
            return $response;
        }

        $cache_key = $this->cache_key($url);

        $cache_ttl = (int) apply_filters('cache_http_reponse/ttl', $this->cache_ttl);
        if (empty($cache_ttl)) {
            $cache_ttl = $this->cache_ttl;
        }

        $include_list = array_unique(apply_filters('cache_http_reponse/include', $this->cache_include));
        $exclude_list = array_unique(apply_filters('cache_http_reponse/exclude', $this->cache_exclude));

        if (empty($include_list) && empty($exclude_list)) {
            set_transient($cache_key, $response, $cache_ttl);

            return $response;
        }

        if (!empty($include_list) && \is_array($include_list) && \in_array($url, $include_list)) {
            if (!empty($exclude_list) && \is_array($exclude_list) && !\in_array($url, $exclude_list)) {
                set_transient($cache_key, $response, $cache_ttl);
            }

            return $response;
        }

        if (!empty($exclude_list) && \is_array($exclude_list) && !\in_array($url, $exclude_list)) {
            set_transient($cache_key, $response, $cache_ttl);

            return $response;
        }

        return $response;
    }

    public function pre_http_request($preempt, $parsed_args, $url)
    {
        $cache_key = $this->cache_key($url);
        $data = get_transient($cache_key);
        if (!empty($data) && \is_array($data)) {
            return $data;
        }

        return $preempt;
    }
}

(new cache_http_response())->register();
