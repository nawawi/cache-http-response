# Cache HTTP Response
Performance tweaks for WordPress to cache HTTP API Call response.

## Description

Performance tweaks for WordPress to cache WordPress API Call responses made by other plugins. This will reduce HTTP requests to external hosts if the plugin does not implement caching on their API calls.

## Installation

### Manual Installation

1. Download the plugin [`zip file`](https://github.com/nawawi/cache-http-response/archive/main.zip) and save it as [`cache-http-response.zip`](https://github.com/nawawi/cache-http-response/archive/main.zip).
1. Upload and install the plugin zip file `cache-http-response.zip` through the WordPress plugins screen directly.
2. Activate the plugin through the ‘Plugins’ screen in WordPress.

### Via WP-CLI
[`WP-CLI`](http://wp-cli.org/) is the official command-line interface for WordPress. You can install performance-improvements-for-woocommerce using the wp command like this:

```wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip```

### Update via WP-CLI
```wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip --force```

### Automatic Updates
Cache HTTP Response supports the [GitHub Updater plugin](https://github.com/afragen/github-updater) WordPress. The plugin enables automatic updates from this GitHub Repository. You will find all information about the how and why at the [plugin wiki page](https://github.com/afragen/github-updater/wiki).

## Settings

This plugin behaviour can be changed using a filter hook.

### `cache_http_reponse/include`  
By default, it will cache all URL if no URL apply to this filter.

```
add_filter('cache_http_reponse/include', ['https://apihostname1.name/api', 'https://apihostname1.name/api']);
```

### `cache_http_reponse/exclude`  
Exclude URL from the cache.

```
add_filter('cache_http_reponse/exclude', ['https://apihostname1.name/api', 'https://apihostname1.name/api']);
```

### `cache_http_reponse/ttl`  
Cache Time To Live. By default, it is set to 300 seconds.

```
add_filter('cache_http_reponse/ttl', 300);
```

### `cache_http_reponse/exclude_wporg`  
Exclude *.wordpress.org URL. By default it is set to `true`.

```
add_filter('cache_http_reponse/exclude_wporg', true);
```

### `cache_http_reponse/exclude_localhost`  
Exclude Site URL. By default it is set to `true`.

```
add_filter('cache_http_reponse/exclude_localhost', true);
```

## Changelog

**1.0.0**
* Initial release.
