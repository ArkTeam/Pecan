<?php
/**
 * ����ű����ڴ���һ����PHP����µĿ��ٲ����ֵ�
 * PHP����һ���ֵ䵽�ڴ���ٶ���Ȼ̫���ˣ����ԣ�ֻ��ֱ�Ӳ����ļ���
 * ��������ļ���������Ƶġ�
 * 
 * 1. ������һ��index ���������ʾͷһ���֣���ӳ�䵽 0 - N
 * 2. �����ṹ���£�int n / int start / int count / int len = 12
 * �������� + ����ֵĿ�ʼλ�� + ����ֵĴ��� + ÿ������ĳ���
 * 3. Ȼ����start ��   end ֮����ж��ֲ��ҡ� 
 */
define("DICT_INT_SIZE", 4);
define("DICT_INDEX_SIZE", DICT_INT_SIZE * 4);
define("DICT_WORD_BASE_SIZE", DICT_INT_SIZE * 3);
define("DICT_CCNUM", 6768);

require_once 'WordItem.php';
class Dict
{
	
	/**
	 * ��ǰд����
	 * @var  int
	 */
	private $wordCurrent;

	/**
	 * ��ʵĳ���
	 * @var int
	 */
	private $maxLen;
	
	private $maxfeq;
	
	/**
	 * д���ʵ�λ��
	 * @var int
	 */
	private $wordPos;
	
	/**
	 * ��ǰ�ֵĴ���
	 * @var int
	 */
	private $count;
	
	/**
	 * һ���ֵ����дʵ��б�
	 * @var array
	 */
	private $data;
	
	/**
	 * �ֵ� �ļ���handle
	 * @var resource 
	 */
	private $dictHandle;
	
	/**
	 *  �����ļ���handle
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
		 * �ʵ�ʵ�� ����д�������ĺ���
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
	 * ��ȡһ������صĴ���Ϣ
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
	 * ����һ���ֵ������Ϣ
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
	 * д����
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