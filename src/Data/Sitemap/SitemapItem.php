<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Sitemap;
use Lemonade\Feed\BaseItem;


/**
 * SitemapItem
 * @package Lemonade\Feed
 * @see https://www.sitemaps.org/protocol.html
 */  
final class SitemapItem extends BaseItem {
    
    /** 
     * @var string 
     * @required
     */
    public $loc;
    
    /** 
     * @var string 
     * @required
     */
    public $changefreq;

    /**
     * @var string
     * @required
     */
    public $priority;
    
    /**
     * @var string|null
     * @required
     */
    public $itemId;
    
    /** @var string|null */
    protected $lastmod;
    
    /**
     * Povolene hodnoty frekvence zmeny
     * @var array
     */
    private const CHANGE_FREQ = [
        "always", 
        "hourly", 
        "daily", 
        "weekly", 
        "monthly", 
        "yearly", 
        "never"        
    ];
    
    
    /**
     *
     * @param string|int $itemId
     */
    public function __construct(string|int $itemId) {
        
        $this->itemId = $itemId;        
    }
    
    /**
     * Vraci itemId
     * @return string
     */
    public function getItemId(): ?string {
        
        return (string) $this->itemId;
    }
    
    /**
     * Nastavuje url polozky 
     * @param string $url
     * @return \Lemonade\Feed\Data\Sitemap\SitemapItem
     */
    public function setLoc(string $url) {
        
        $this->loc = (string) $url;
        
        return $this;
    }

    /**
     * Vraci url polozky
     * @return string
     */
    public function getLoc() {
        
        return $this->loc;
    }

    /**
     * Nastavuje cetnost zmeny
     * @param string $changefreq
     * @throws \InvalidArgumentException
     * @return \Lemonade\Feed\Data\Sitemap\SitemapItem
     */
    public function setChangeFreq(string $changefreq) {
        
        if(!in_array($changefreq, static::CHANGE_FREQ)) {
            throw new \InvalidArgumentException("Neznamy typ frekvence cetnosti zmeny");
        }
        
        $this->changefreq = (string) $changefreq;
        return $this;        
    }
    
    /**
     * Vraci cetnost zmeny
     * @return string
     */
    public function getChangeFreq() {
        
        return $this->changefreq;
    }
    
    
    /**
     * 
     * @param string|int|float $priority
     * @return \Lemonade\Feed\Data\Sitemap\SitemapItem
     */   
    public function setPriority(string|int|float $priority = null) {
        
        $this->priority = (string) $priority;
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getPriority() {
        
        return $this->priority;
    }
    
    /**
     * 
     * @param \DateTime $lastMod
     * @return \Lemonade\Feed\Data\Sitemap\SitemapItem
     */
    public function addLastMod(\DateTime $lastMod = null)  { 
        
        $this->lastmod = $lastMod;
        
        return $this;
    }
    
    /**
     * 
     * @return string|NULL
     */
    public function getLastMod() {
        
        return $this->lastmod instanceof \DateTime ? $this->lastmod->format("Y-m-d H:i:s") : $this->lastmod;
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ItemInterface::getErrorString()
     */
    public static function getErrorString(): string {
        
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"></urlset>";
    }

    
    
    
}