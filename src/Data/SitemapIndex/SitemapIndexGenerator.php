<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\SitemapIndex;
use Lemonade\Feed\BaseGenerator;

/**
 * Class SitemapIndexGenerator
 * @package Lemonade\Feed
 */ 
final class SitemapIndexGenerator extends BaseGenerator
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
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\BaseGenerator::getTemplate()
     */
    protected function getTemplate($name) {        
        
        $reflex = new \ReflectionClass(objectOrClass: __CLASS__);
        
        return dirname(path: $reflex->getFileName()) . "/latte/" . $name . $this->getExtension();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\BaseGenerator::getErrorString()
     */
    protected function getErrorString()
    {
        
        return SitemapIndexItem::getErrorString();
    }


}