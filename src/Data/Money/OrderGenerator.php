<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;
use Lemonade\Feed\BaseGenerator;

/**
 * @OrderGenerator
 * @\Lemonade\Feed\Data\Money\OrderGenerator
 */ 
final class OrderGenerator extends BaseGenerator
{

    /**
     *
     * {@inheritDoc}
     * @see \Lemonade\Feed\BaseGenerator::pushHeaders()
     */
    protected function pushHeaders() {
        
        header_remove();
        header("Content-type: application/xml");
    }

    /**
     * @param $name
     * @return string
     */
    protected function getTemplate($name) {
        
        $reflex = new \ReflectionClass(objectOrClass: __CLASS__);
        
        return dirname($reflex->getFileName()) . "/latte_order/" . $name . $this->getExtension();
    }

    /**
     * @return array|string|string[]
     */
    protected function getErrorString() {
        
        return \str_replace(["{name}", "{url}"], [$this->getAppName(), $this->getAppHost()], OrderHeader::getErrorString());
    }
    
}