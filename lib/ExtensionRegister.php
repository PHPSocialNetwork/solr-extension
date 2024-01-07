<?php

declare(strict_types=1);

namespace Phpfastcache;

use Phpfastcache\Extensions\Drivers\Solr\{Config, Driver, Event, Item};

// Semver Compatibility until v10
class_alias(Config::class, Drivers\Solr\Config::class);
class_alias(Driver::class, Drivers\Solr\Driver::class);
class_alias(Event::class, Drivers\Solr\Event::class);
class_alias(Item::class, Drivers\Solr\Item::class);

ExtensionManager::registerExtension('Solr', Driver::class);
