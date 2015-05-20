<?php
/**
 * 用于查询字典，查询支持两个接口，
 * 一个是find
 * 一个是likeFind
 * @author cykzl
 *
 */
require_once 'Dict.php';
require_once 'MFile.php';

class DictQuery
{
	/**
	 * 查找文件的handle
	 * @var resource
	 */
	private $findHandle;
	
	/**
	 * 查询缓存，一篇文章查完之后，就清除缓存。
	 *
	 * @var unknown_type
	 */
	private $cache;

	function __construct($dictPath)
	{	
		$this->findHandle = new MFile($dictPath);
	}

	function preProcessing($word)
	{
		
		if (!@$word[1]) {
			return false;
		}
		$index = $this->CCID($word);
		if ($index >= DICT_CCNUM || $index < 0) {
		    return false;
		}
		$this->findHandle->fseek($index * DICT_INDEX_SIZE, SEEK_SET);
		return unpack("i4", $this->findHandle->fread(4 * DICT_INT_SIZE));
	}

	function find($word)
	{
		return $this->_find($word, 0, true);
	}
	
	function has($word)
	{
		return $this->_find($word, 0, false) !== false;
	}

	function likeFind($word)
	{
		return $this->_find($word, 1, true);
	}
	
	function likeHas($word)
	{
		return $this->_find($word, 1, false) !== false;
	}

	function _find($word, $match_type, $return_all)
	{
		$find_key = $word . "_" . $match_type . "_" . $return_all;
		if (isset($this->cache[$find_key])) return $this->cache[$find_key];
		
	    $arr = $this->preProcessing($word);
		if(!$arr) {
		    $this->cache[$find_key] = false;
		    return false;
		}
		list(,,$start, $count, $pack_len) = $arr;
		$end = $start + ($count - 1) * $pack_len;
		
		//对word进行截断
		$prefix = substr($word, 0, 2);
		$word = substr($word, 2);
		$pos = $this->binSearch($word, $start, $count, $pack_len, $match_type);
		if (!$return_all) {
		    if ($pos == false) {
		        $this->cache[$find_key] = false;
		        return false;
		    } else {
		        $data = array($pos, $pack_len);
		        $this->cache[$find_key] = $data;
		        return $data;
		    }
		}
		if ($pos === false) {
		    $data = array();
		    $this->cache[$find_key] = $data;
			return $data;
		}
		$res = $this->getResult($word, $pos, $start, $end, $pack_len, $match_type);
		
		foreach ($res as &$wordItem)
		{
			$wordItem->word = $prefix . $wordItem->word;
		}
		
		$this->cache[$find_key] = $res;
		return $res;
	}
	
	function clearCache()
	{
	    $this->cache = array();
	}

	function getResult($word, $pos, $start, $end, $pack_len, $match_type)
	{
		//向前查找，第一个匹配的单词
		$old_pos = $pos;
		$result = array();
		while ($start < $pos) 
		{
			$data = $this->getOneResult($pos - $pack_len, $word, $pack_len, $match_type);
			if ($data == false) {
				break;
			} else {
				$pos -= $pack_len;
				array_unshift($result, $data);
			}
		}
		//向后查找，取出所有的结果
		$pos = $old_pos;
		while ($pos <= $end)
		{
			$data = $this->getOneResult($pos, $word, $pack_len, $match_type);
			if ($data == false) {
				break;
			} else {
				$pos += $pack_len;
				array_push($result, $data);
			}
		}
		return $result;
	}

	function binSearch($word, $start, $count, $pack_len, $match_type = 0)
	{
		if (!@$word[0]) {//空字符串
			return $start;
		}
		
		$begin = 0;
		$end = $count - 1;
		while ($begin <= $end)
		{
			$mid = $begin + ($end - $begin)/2;
			$mid = (int)$mid;
			$cmp = $this->compare($mid * $pack_len + $start, $word, $pack_len, $match_type);
			if ($cmp == 0) {
				return $mid * $pack_len + $start;
			} else if ($cmp < 0) {
				$begin = $mid + 1;
			} else {
				$end = $mid - 1;
			}
		}
		return false;
	}

	function compare($start, $word, $pack_len, $match_type, &$data = -1)
	{
	    $this->findHandle->fseek($start, SEEK_SET);
	    list(,$feq, $len, $npos) = unpack("i3", $this->findHandle->fread(3 * DICT_INT_SIZE));
	    $str = "";
	    if ($len) {
	    	$str = $this->findHandle->fread($len);
	    }
	    if ($data != -1)
	    {
	        $data = new WordItem($str, $npos, $feq);
	    }
	    if ($match_type) {
	    	return strncmp($str, $word, strlen($word));
	    } else {
	    	return strcmp($str, $word);
	    }
	}
	
	function readOne($start, $pack_len)
	{
	    $this->findHandle->fseek($start, SEEK_SET);
	    list(,$feq, $len, $npos) = unpack("i3", $this->findHandle->fread(3 * DICT_INT_SIZE));
	    $str = "";
	    if ($len) {
	    	$str = $this->findHandle->fread($len);
	    }
	    return new WordItem($str, $npos, $feq);
	}

	function getOneResult($start, $word, $pack_len, $match_type)
	{
		$data = null;
		$cmp = $this->compare($start, $word, $pack_len, $match_type, $data);   
	    if ($cmp == 0) {
	    	return $data;
	    } else {
	    	return false;
	    }
	}

	function CCID($word)
	{
		$ch1 = ord($word[0]);
		$ch2 = ord($word[1]);
		return ($ch1 - 176)*94 + ($ch2 - 161);
	}
}