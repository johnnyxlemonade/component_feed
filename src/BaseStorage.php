<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * Class StorageXml
 * @package Lemonade\Feed
 */
final class BaseStorage {
    
    /**
     * Uloziste
     * @var string
     */
    protected $root =  "./storage/0/export";
    
    /**
     * Cesta pro ulozeni
     * @var string
     */
    protected $directory = null;   
        
    /**
     * FeedStorage constructor.
     * @param $directory
     */
    public function __construct(string $directory = null) {
        
        $this->directory = $directory;
    }
    

    /**
     * Ulozeni souboru
     * @param string $filename
     * @param string $content
     * @return string|boolean
     */
    public function save(string $filename, string $content) {
        
        
        try {
                        
            if(!is_dir($this->getDir())) {
                mkdir($this->getDir(), 0777, true);
            }
                        
            if(file_put_contents($this->getFile($filename, true), $content, LOCK_EX)) {
                
                return $this->getFile($filename, false);
            }
            
            return false;
            
            
        } catch (\Exception $e) {
            return false;
        }

    }
    
    /**
     * Vraceni adresare pro ulozeni
     * @return string
     */
    public function getDir(bool $absolute = false): string {
        
        $dir = $this->root . (!empty($this->directory) ? DIRECTORY_SEPARATOR . $this->directory : "");
        
        return ($absolute ? realpath($dir) : $dir);
    }
    
    /**
     * Vraci umisteni souboru
     * @return string
     */
    public function getFile(string $file, bool $absolute = false): string {
        
        return $this->getDir($absolute) . DIRECTORY_SEPARATOR . $file;
    }

}
