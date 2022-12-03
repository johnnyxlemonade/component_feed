<?php declare(strict_types = 1);

namespace Lemonade\Feed;
/**
 * Interface ItemInterface
 * @package Lemonade\Feed
 */
interface ItemInterface {
    
	/**
	 * @return bool Validace polozky
     */
	public function validate();
	
	/**
	 * Vraci error string
	 * @return string
	 */
	public static function getErrorString(): string;
}
