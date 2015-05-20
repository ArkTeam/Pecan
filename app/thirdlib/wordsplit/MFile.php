<?php
/**
 * 内存文件
 *
 */
class MFile
{
    /**
     * 二进制文件的内容
     *
     * @var string
     */
    private $fileHandle;
    
    /**
     * 二进制文件指针
     *
     * @var string
     */
    private $current = 0;
    
    /**
     * 文件的长度
     *
     * @var string
     */
    private $length;

    function __construct($dictPath)
    {
        global $debug;
        if ($debug)
        {
            $t = microtime(true);
        }
        $this->fileHandle = file_get_contents($dictPath);
        if ($debug)
        {
            $t = microtime(true) - $t;
            echo "read dict cost: $t\n";
        }
    }
    
    function fseek($pos, $seek_mode = SEEK_SET)
    {
        switch ($seek_mode)
        {
            case SEEK_SET : {
                $this->current = $pos;
                break;
            }
            
            case SEEK_CUR: {
                $this->current += $pos;
                break;
            }
            
            case SEEK_END: {
                $this->current = $this->length - 1 - $pos;
                break;
            }
            
            default:{
                return false;
            }
        }
        
        if ($this->current < 0) {
            return false;
        }
    }

    function fread($length)
    {
        $str = substr($this->fileHandle, $this->current, $length);
        $this->current += $length;
        return $str;
    }
}
?>