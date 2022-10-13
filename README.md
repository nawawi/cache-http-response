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
[`WP-CLI`](http://wp-cli.org/) is the official command-line interface for WordPress. You can install cache-http-response using the wp command like this:

```
wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip
```

### Update via WP-CLI
```
wp plugin install --activate https://github.com/nawawi/cache-http-response/archive/main.zip --force
```

### Automatic Updates
Cache HTTP Response supports the [GitHub Updater plugin](https://github.com/afragen/github-updater) WordPress. The plugin enables automatic updates from this GitHub Repository. You will find all information about the how and why at the [plugin wiki page](https://github.com/afragen/github-updater/wiki).

## Settings
This plugin behaviour can be changed using a filter hook. You may load it as a ['mu-plugins'](https://wordpress.org/support/article/must-use-plugins/) script. Copy this code and place it in `wp-content/mu-plugins/cache-http-response-hook.php`.
```php
<?php
add_filter(
    'cache_http_reponse/ttl',
    function() {
        // 1 hour.
        return 3600;
    }
);

add_filter(
    'cache_http_reponse/include',
    function($urls) {
        //$urls[] = '';

        return $urls;
    }
);

add_filter(
    'cache_http_reponse/exclude',
    function($urls) {
        //$urls[] = '';

        return $urls;
    }
);
```

## Filter Hooks

#### `cache_http_reponse/include`  
By default, it will cache all URL if no URL apply to this filter.

```
add_filter(
    'cache_http_reponse/include',
    function($urls) {
        $urls[] = 'https://apihostname1.name/api';
        $urls[] = 'https://apihostname2.name/api';

        return $urls;
    }
);
```

#### `cache_http_reponse/exclude`  
Exclude URL from the cache.

```
add_filter(
    'cache_http_reponse/exclude',
    function($urls) {
        $urls[] = 'https://apihostname1.name/api';
        $urls[] = 'https://apihostname2.name/api';

        return $urls;
    }
);
```

#### `cache_http_reponse/ttl`  
Cache lifespan in seconds. By default, it is set to 300 seconds.

```
add_filter(
    'cache_http_reponse/ttl',
    function() {
        return 300;
    }
);
```

#### `cache_http_reponse/exclude_wporg`  
Exclude *.wordpress.org URL. By default it is set to `true`.

```
add_filter(
    'cache_http_reponse/exclude_wporg',
    '__return_true'
);
```

#### `cache_http_reponse/exclude_localhost`  
Exclude Site URL. By default it is set to `true`.

```
add_filter(
    'cache_http_reponse/exclude_localhost',
    '__return_true'
);
```

## Changelog

**1.0.0**
* Initial release.
