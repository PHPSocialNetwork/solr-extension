## Contributing [![Solr extension tests](https://github.com/PHPSocialNetwork/solr-extension/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/PHPSocialNetwork/solr-extension/actions/workflows/php.yml)

Merge requests are welcome but will require the tests plus the quality tools to pass:

_(Commands must be run from the repository root)_
### PHPCS, PHPMD, PHPSTAN (Level 6), unit tests:

```bash
composer run-script quality
composer run-script tests

# In case you want to fix the code style automatically: 
composer run-script phpcbf
```

## Support & Security

Support for this extension must be posted to the main [Phpfastcache repository](https://github.com/PHPSocialNetwork/phpfastcache/issues).

## Composer installation:

```php
composer install phpfastcache/solr-extension
```

#### ⚠️ This extension requires:
1️ The composer `solarium/solarium` library `6.1` at least.

## Events
This driver is emitting [customs events](https://github.com/PHPSocialNetwork/phpfastcache/blob/master/docs/EVENTS.md):

- onSolrBuildEndpoint(*Callable* **$callback**)
    - **Callback arguments**
        - *ExtendedCacheItemPoolInterface* **$itemPool**
        - *EventReferenceParameter($params)* **$endpoints** _via EventReferenceParameter object_ **(type modification forbidden)**
    - **Scope**
        - Solr Driver
    - **Description**
        - Allow you to alter the endpoints built used to connect to Solr server
    - **Risky Circular Methods**: None
