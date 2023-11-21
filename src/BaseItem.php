<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * Class BaseItem
 * @package Lemonade\Feed
 */
abstract class BaseItem implements ItemInterface {
    
	/**
	 * Validace polozek
	 * @return bool
     */
	public function validate() {

	    $reflex = (new \ReflectionObject($this));
	    
	    foreach ($reflex->getProperties(\ReflectionProperty::IS_PUBLIC) as $v) {
	        if($v->getDocComment() && strrpos($v->getDocComment(), "@required") !== false) {	
		        if(!isset($this->{$v->getName()})) {
		            //trigger_error(sprintf("Chybejici parametr %s u polozky %s", $v->getName(), $this->itemId));
		            return false;
		        }
		    }		    
		}

		return TRUE;
	}
}
