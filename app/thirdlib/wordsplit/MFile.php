<?php
/**
 * �ڴ��ļ�
 *
 */
class MFile
{
    /**
     * �������ļ�������
     *
     * @var string
     */
    private $fileHandle;
    
    /**
     * �������ļ�ָ��
     *
     * @var string
     */
    private $current = 0;
    
    /**
     * �ļ��ĳ���
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