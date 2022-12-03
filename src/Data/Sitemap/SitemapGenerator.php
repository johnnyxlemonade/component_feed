<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Sitemap;
use Lemonade\Feed\BaseGenerator;

/**
 * Class SitemapGenerator
 * @package Lemonade\Feed
 */ 
final class SitemapGenerator extends BaseGenerator {
    
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
        
        $reflex = new \ReflectionClass(__CLASS__);   
        
        return dirname($reflex->getFileName()) . "/latte/" . $name . $this->getExtension();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\BaseGenerator::getErrorString()
     */
    protected function getErrorString() {
        
        return SitemapItem::getErrorString();
    }


}