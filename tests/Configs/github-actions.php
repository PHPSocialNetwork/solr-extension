<?php

use Phpfastcache\Drivers\Solr\Config as SolrConfig;

return (fn(SolrConfig $config) => $config->setItemDetailedDate(true)
    ->setCoreName('phpfastcache')
    ->setPort(8983)
    ->setHost('127.0.0.1')
    ->setPath('/')
    ->setScheme('http')
)(new SolrConfig());
