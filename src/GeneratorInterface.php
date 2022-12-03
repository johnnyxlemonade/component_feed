<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * Interface GeneratorInterface
 * @package Lemonade\Feed
 */
interface GeneratorInterface {

    /**
     * Pridat do souboru
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item);
    
    /**
     * Vygenerovani souboru
     * @param string $callback
     * @return mixed
     */
    public function output(string $callback = null);

    /**
     * Ulozeni souboru
     * @param string $filename
     * @param string $callback
     * @return mixed
     */
    public function save(string $filename = null, string $callback = null);
}