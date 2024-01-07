<?php

use Phpfastcache\Drivers\Solr\Config as SolrConfig;

return (new SolrConfig())
    ->setItemDetailedDate(true)
    ->setCoreName('phpfastcache')
    ->setPort(8983)
    ->setHost('127.0.0.1')
    ->setPath('/')
    ->setScheme('http');
