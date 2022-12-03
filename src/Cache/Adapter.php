<?php declare(strict_types = 1);

namespace Lemonade\Feed\Cache;
interface Adapter {
    
    /**
     * Nacist cache
     * @param string $key
     * @param int $ttl time in seconds
     * @return mixed
     */
    public function load($key, int $ttl = null);
    
    /**
     * Ulozit do cache
     * @param string $key
     * @param string $data
     * @return mixed
     */
    public function save($key, $data);
    
    /**
     * Smazat cache
     * @param string $key
     * @return bool
     */
    public function delete($key);
    
    /**
     * Vraci plnou cestu k souboru
     * @return string
     */
    public function getFile(): string;
    
    /**
     * Vraci klic
     * @return string
     */
    public function getFileId(): string;
    
    /**
     * Vraci adresar
     * @return string
     */
    public function getDir(): string;
    
    /**
     * Vraci adresar
     * @return string
     */
    public function getRoot(): string;
    
}