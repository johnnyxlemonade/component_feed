<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * Interface ParserInterface
 * @package Lemonade\Feed
 */
interface ParserInterface {

    /**
     * Vraci url
     */
    public function getUrl(): string;
    
    /**
     * Testuje data
     * @return bool
     */
    public function hasData(): bool;
    
    /**
     * Vraci data
     * @return array
     */
    public function getData(): array;
        
    /**
     * Vraci vsechny data
     * @return array
     */
    public  function getAllNodes(): array;
    
    /**
     * Stahuje data
     */
    public function downloadData();  
    
    /**
     * Raw data
     */
    public function rawData();  
    
    /**
     * Data pomocna funkce
     * @return array
     */
    public function listDropdown(): array;
    
    /**
     * Vraci nazev podle Id
     * @param string $id
     * @return string
     */
    public function getNodeNameById(string $id): string;

}