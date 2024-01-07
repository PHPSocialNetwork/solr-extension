<?php

/**
 *
 * This file is part of Phpfastcache.
 *
 * @license MIT License (MIT)
 *
 * For full copyright and license information, please see the docs/CREDITS.txt and LICENCE files.
 *
 * @author Georges.L (Geolim4)  <contact@geolim4.com>
 * @author Contributors  https://github.com/PHPSocialNetwork/phpfastcache/graphs/contributors
 */

declare(strict_types=1);

namespace Phpfastcache\Extensions\Drivers\Solr;

use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;
use Phpfastcache\Core\Pool\TaggableCacheItemPoolInterface;
use Phpfastcache\Exceptions\PhpfastcacheInvalidArgumentException;
use Phpfastcache\Exceptions\PhpfastcacheLogicException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Solarium\Core\Client\Adapter\AdapterInterface;

class Config extends ConfigurationOption
{
    public const DEFAULT_MAPPING_SCHEMA = [
        Driver::SOLR_DEFAULT_ID_FIELD => Driver::SOLR_DEFAULT_ID_FIELD,
        Driver::SOLR_DISCRIMINATOR_FIELD => Driver::SOLR_DISCRIMINATOR_FIELD . '_s',
        ExtendedCacheItemPoolInterface::DRIVER_KEY_WRAPPER_INDEX => ExtendedCacheItemPoolInterface::DRIVER_KEY_WRAPPER_INDEX . '_s',
        ExtendedCacheItemPoolInterface::DRIVER_DATA_WRAPPER_INDEX => ExtendedCacheItemPoolInterface::DRIVER_DATA_WRAPPER_INDEX . '_s',
        ExtendedCacheItemPoolInterface::DRIVER_EDATE_WRAPPER_INDEX => ExtendedCacheItemPoolInterface::DRIVER_EDATE_WRAPPER_INDEX . '_s',
        ExtendedCacheItemPoolInterface::DRIVER_MDATE_WRAPPER_INDEX => ExtendedCacheItemPoolInterface::DRIVER_MDATE_WRAPPER_INDEX . '_s',
        ExtendedCacheItemPoolInterface::DRIVER_CDATE_WRAPPER_INDEX => ExtendedCacheItemPoolInterface::DRIVER_CDATE_WRAPPER_INDEX . '_s',
        TaggableCacheItemPoolInterface::DRIVER_TAGS_WRAPPER_INDEX => TaggableCacheItemPoolInterface::DRIVER_TAGS_WRAPPER_INDEX . '_ss',
    ];
    protected string $host = '127.0.0.1';
    protected int $port = 8983;
    protected string $coreName = 'phpfastcache';
    protected string $endpointName = 'phpfastcache';
    protected string $scheme = 'http';
    protected EventDispatcherInterface $eventDispatcher;
    protected string $path = '/';
    protected ?AdapterInterface $adapter = null;

    /** @var array<string, string> */
    protected array $mappingSchema = self::DEFAULT_MAPPING_SCHEMA;

    public function __construct(array $parameters = [])
    {
        $this->eventDispatcher = $this->getDefaultEventDispatcher();
        parent::__construct($parameters);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setHost(string $host): Config
    {
        return $this->setProperty('host', $host);
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setPort(int $port): Config
    {
        return $this->setProperty('port', $port);
    }

    /**
     * @return string
     */
    public function getCoreName(): string
    {
        return $this->coreName;
    }

    /**
     * @param string $coreName
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setCoreName(string $coreName): Config
    {
        return $this->setProperty('coreName', $coreName);
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setScheme(string $scheme): Config
    {
        return $this->setProperty('scheme', $scheme);
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getDefaultEventDispatcher(): EventDispatcherInterface
    {
        return new class implements EventDispatcherInterface {
            public function dispatch(object $event): object
            {
                return $event;
            }
        };
    }

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): Config
    {
        return $this->setProperty('eventDispatcher', $eventDispatcher);
    }

    /**
     * @return string[]
     */
    public function getMappingSchema(): array
    {
        return $this->mappingSchema;
    }

    /**
     * @param string[] $mappingSchema
     * @return Config
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheInvalidArgumentException
     */
    public function setMappingSchema(array $mappingSchema): Config
    {
        $diff = array_diff(array_keys(self::DEFAULT_MAPPING_SCHEMA), array_keys($mappingSchema));
        if ($diff) {
            throw new PhpfastcacheInvalidArgumentException('Missing keys for the solr mapping schema: ' . \implode(', ', $diff));
        }
        return $this->setProperty('mappingSchema', $mappingSchema);
    }

    /**
     * @return string
     */
    public function getEndpointName(): string
    {
        return $this->endpointName;
    }

    /**
     * @param string $endpointName
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setEndpointName(string $endpointName): Config
    {
        return $this->setProperty('endpointName', $endpointName);
    }

    public function getAdapter(): ?AdapterInterface
    {
        return $this->adapter;
    }

    public function setAdapter(?AdapterInterface $adapter): Config
    {
        return $this->setProperty('adapter', $adapter);
    }
}
