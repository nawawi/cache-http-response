# Cache HTTP Response
Performance tweaks for WordPress to cache HTTP API Call response.

## Description

Performance tweaks for WordPress to cache WordPress API Call responses made by other plugins. This will reduce HTTP requests to external hosts if the plugin does not implement caching on their API calls.

## Installation

### Manual Installation

1. Upload the plugin folder `cache-http-response` to the ‘/wp-content/plugins/’ directory, or install the plugin zip file `cache-http-response.zip` through the WordPress plugins screen directly.
2. Activate the plugin through the ‘Plugins’ screen in WordPress.

## Via WP-CLI
[`WP-CLI`](http://wp-cli.org/) is the official command-line interface for WordPress. You can install performance-improvements-for-woocommerce using the wp command like this:

```wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip```

## Update via WP-CLI
```wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip --force```

## Automatic Updates
Performance Improvements for WooCommerce supports the [GitHub Updater plugin](https://github.com/afragen/github-updater) WordPress. The plugin enables automatic updates from this GitHub Repository. You will find all information about the how and why at the [plugin wiki page](https://github.com/afragen/github-updater/wiki).

## Changelog

**1.0.0**
* Initial release.
