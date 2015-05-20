<?php
/**
 * 这个脚本用于创建一本在PHP情况下的快速查找字典
 * PHP加载一本字典到内存的速度显然太慢了，所以，只能直接查找文件。
 * 这个查找文件是这样设计的。
 * 
 * 1. 首先是一个index 这个索引表示头一个字，并映射到 0 - N
 * 2. 索引结构如下：int n / int start / int count / int len = 12
 * 首字索引 + 这个字的开始位置 + 这个字的词数 + 每个词项的长度
 * 3. 然后，在start 到   end 之间进行二分查找。 
 */
define("DICT_INT_SIZE", 4);
define("DICT_INDEX_SIZE", DICT_INT_SIZE * 4);
define("DICT_WORD_BASE_SIZE", DICT_INT_SIZE * 3);
define("DICT_CCNUM", 6768);

require_once 'WordItem.php';
class Dict
{
	
	/**
	 * 当前写的字
	 * @var  int
	 */
	private $wordCurrent;

	/**
	 * 最长词的长度
	 * @var int
	 */
	private $maxLen;
	
	private $maxfeq;
	
	/**
	 * 写单词的位置
	 * @var int
	 */
	private $wordPos;
	
	/**
	 * 点前字的词数
	 * @var int
	 */
	private $count;
	
	/**
	 * 一个字的所有词的列表
	 * @var array
	 */
	private $data;
	
	/**
	 * 字典 文件的handle
	 * @var resource 
	 */
	private $dictHandle;
	
	/**
	 *  保存文件的handle
	 * @var resource
	 */
	private $saveHanle;

	function __construct($dictPath)
	{
		$this->dictHandle = fopen($dictPath, 'rb');
		$this->wordCount = DICT_CCNUM;
		
		$this->wordCurrent = -1;
		//set_error_handler(array($this, "error"));
		/**
		 * 
		 * 词的实际 内容写在索引的后面
		 */
		$this->wordPos = DICT_CCNUM * DICT_INDEX_SIZE;
	}

	function error($errno, $errstr, $errfile, $errline)
	{
		echo $this->wordCurrent;
	}

	function __destruct()
	{
		if (is_resource($this->dictHandle))
		{
			fclose($this->dictHandle);
		}
	}
	
	function buildFindDict($savePath)
	{
		$this->saveHanle = fopen($savePath, 'wb');
		while ($this->readOne() !== false)
		{
			$this->writeIndex();
			$this->saveOne();
		}
		fclose($this->saveHanle);
		
		print_r($this->maxfeq);
	}
	
	/**
	 * 读取一个字相关的词信息
	 */
	private function readOne()
	{
		if ($this->wordCurrent == DICT_CCNUM - 1)
		{
			return false;
		}
		
		/**
		 * read...
		 */
		$this->count = $this->readInt32();
		$this->maxLen = 0;
		$this->data = array();
		for ($i = 0; $i < $this->count; $i++)
		{
			$int  = $this->readNInt32(3);
			$feq  = $int[1];
			$len  = $int[2];
			$npos = $int[3];
			if ($len > $this->maxLen)
			{
				$this->maxLen = $len;
			}
			$word = $this->readString($len);
			$this->data[] = new WordItem($word, $npos, $feq);
			if (empty($this->maxfeq)) {
				$this->maxfeq = end($this->data);
			} else {
				$tmp = end($this->data);
				if ($tmp->feq > $this->maxfeq->feq) {
					$this->maxfeq = $tmp;
				}
			}
		}
		$this->wordCurrent++;
		return true;
	}
	
	/**
	 * 保存一个字的相关信息
	 * feq/len/pos/string/null
	 */
	private function saveOne()
	{
		$item_len = $this->maxLen + DICT_WORD_BASE_SIZE;
		fseek($this->saveHanle, $this->wordPos, SEEK_SET);
		$save = "";
		foreach ($this->data as $item)
		{
			$word_len = strlen($item->word);
		    $save .= pack("i3", $item->feq, $word_len , $item->npos) . $item->word . str_repeat(" ", $this->maxLen - $word_len);
			$this->wordPos += $item_len;
		}
		fwrite($this->saveHanle, $save);
	}
	
	/**
	 * 写索引
	 */
	private function writeIndex()
	{
		fseek($this->saveHanle, $this->wordCurrent * DICT_INDEX_SIZE, SEEK_SET);
		$save = pack("i4", $this->wordCurrent, $this->wordPos, $this->count, $this->maxLen + DICT_WORD_BASE_SIZE);
		fwrite($this->saveHanle, $save);
	}

	private function readInt32()
    {
		$arr = unpack("i", fread($this->dictHandle, 4));
		return $arr[1];
	}

	private function readNInt32($number)
	{
		$arr = unpack("i$number", fread($this->dictHandle, 4 * $number));
		return $arr;
	}

	private function readString($length)
	{
		if ($length <= 0) return "";
		return fread($this->dictHandle, $length);
	}
	
}