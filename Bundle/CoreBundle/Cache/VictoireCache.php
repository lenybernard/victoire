<?php

namespace Victoire\Bundle\CoreBundle\Cache;

use Doctrine\Common\Cache\PhpFileCache;

/**
 * this class handle cache system.
 **/
class VictoireCache extends PhpFileCache
{
    const EXTENSION = '.victoire.cache.php';
    protected $businessEntityDebug;

    /**
     * Constructor.
     *
     * @param bool  $businessEntityDebug The businessEntityDebug environment
     * @param mixed $directory
     * @param mixed $extension
     */
    public function __construct($businessEntityDebug, $directory, $extension = self::EXTENSION)
    {
        $this->businessEntityDebug = $businessEntityDebug;
        parent::__construct($directory, $extension);
    }

    /**
     * Fetches an entry from the cache.
     *
     * @param string     $id           cache id The id of the cache entry to fetch
     * @param null|mixed $defaultValue
     *
     * @return mixed the cached data or FALSE, if no cache entry exists for the given id
     */
    public function get($id, $defaultValue = null)
    {
        if ($this->contains($id)) {
            return $this->fetch($id);
        }

        return $defaultValue;
    }

    /**
     * Puts data into the cache.
     *
     * @param string $id   the cache id
     * @param mixed  $data the cache entry/data
     * @param mixed  $ttl
     *
     * @return bool TRUE if the entry was successfully stored in the cache, FALSE otherwise
     */
    public function save($id, $data, $ttl = 20)
    {
        if ($this->businessEntityDebug) {
            parent::save($id, $data, $ttl);
        } else {
            parent::save($id, $data);
        }
    }
}
