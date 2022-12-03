<?php declare(strict_types = 1);

namespace Lemonade\Feed\Cache;

class FileSystem implements Adapter {
    
    /**
     * Extenze
     * @var string
     */
    protected $ext = ".cache";
    
    /**
     * Uloziste
     * @var string
     */
    protected $root =  "./storage/0/cache";
    
    /**
     * Cesta pro ulozeni
     * @var string
     */
    protected $directory = null;       
    
    /**
     * Nazev souboru
     * @var string
     */
    protected $file = "";
    
    /**
     * Konstruktor
     * @param string $path
     */
    public function __construct(string $name, bool $asFile = true) {
        
        $this->file = ($asFile ? FileName::asFile($name . $this->ext, 120) : FileName::asUrl($name));       
    }
    
        
    /**
     * Statika
     * @param string $name
     * @param bool $asFile
     * @return \Lemonade\Feed\Cache\Filesystem
     */
    public static function getInstance(string $name, bool $asFile = true) {
        
        return new FileSystem($name, $asFile);
    }
    
    
    /**
     * Nastavi adresar
     * @param string $dir
     * @return \Lemonade\Feed\Cache\FileSystem
     */
    public function setDirectory(string $dir) {
        
        $this->directory = $dir;
        
        return $this;
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::load()
     * @throws \Exception
     * 
     */
    public function load($key, int $ttl = null) {
        
        $file = $this->getFile($key);
        
        if (\file_exists($file) && (\filemtime($file) + $ttl > time())) {
            return \unserialize(\file_get_contents($file));
        }
        
        return false;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::save()
     * @throws \Exception
     * 
     */
    public function save($key, $data) {
        
        if(empty($data)) {
            return "";
        }
        
        $file = $this->getFile($key);
        
        if (!\file_exists(\dirname($file))) {
            if(!\mkdir(\dirname($file), 0755, true)) {
                if (!\file_exists(\dirname($file))) { 
                    throw new \Exception('Nelze vytvorit adresar ' . \dirname($file));
                }
            }
        }
        
        return (\file_put_contents($file, \serialize($data), LOCK_EX)) ? $data : false;
    }
    

    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::delete()
     * @throws \Exception
     * 
     */
    public function delete($key) {
        
        $file = $this->getFile($key);
        
        if (\file_exists($file)) {
            return \unlink($file);
        }
        
        return false;
    }
        
    /**
     *
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::getFile()
     */
    public function getFile(): string {
        
        return $this->getDir() . DIRECTORY_SEPARATOR . $this->file . $this->ext;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::getFileId()
     */
    public function getFileId(): string {
        
        return $this->file;
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::getRoot()
     */
    public function getRoot(): string {
        
        return $this->root;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\Cache\Adapter::getDir()
     */
    public function getDir(): string {
        
        return $this->root . (!empty($this->directory) ? DIRECTORY_SEPARATOR . $this->directory : "");
    }

}