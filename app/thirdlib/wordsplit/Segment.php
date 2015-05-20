<?php
/**
 * Segment 分词算法接口
 * 这个部分实现的是最简单的分词算法。最大匹配算法。
 * 
 * 1. 没有考虑任何的词频问题
 * 2. 没有考虑任何的歧义消除的问题
 * 
 * 在我的计划里面，我将会实现下面的分词算法：
 * 
 * 1. 简单最大匹配算法
 * 2. 复杂最大匹配算法
 * 3. N-最短路径算法
 * 
 * 当然，分词除了初步的分词以外，还得引入歧义消除的问题。这样，最终每种分词方法都会做一些调整。
 * 然后是自动词性标注的功能。这个功能，用统计学方法比较好处理。
 * 
 * 最近我一直在思考的问题是，不同语言的设计思想。所以，要理解这些差异，我觉得最简单的方法就是，
 * 同一个问题，用不同的语言都实现一遍，看看每种语言在设计的时候，取舍到底有什么不同。
 * 
 * 1. C。显然，这是一种中层语言的代表。它实际上是在硬件上面做了一层的封装，这个封装，能让我看到语句就很容易转换到汇编。
 * 同时又消除了各种机器在汇编层的差异。
 * 
 * 2. C++。虽然，这种语言非常的有争议。但是，非常明显，从某种角度来说，它是要归类到 C# 和 Java 这类语言的阵营的。而不是
 *    和C语言是同类。与C兼容只是C++的一种策略，而不是语言的本质。
 *    
 * 3. PHP。脚本语言的代表，同时又是web时代的语言。显然，在动态性来说，要比编译型的语言要好的多，但是性能要差一些。
 * 
 * 
 * 除了这个PHP版本外，我还会实现C版本，C++版本。
 * 
 * 当然，实现这些东西不是我的目的。我是想比较一下，不同的语言，设计理念不同，
 * 应用目标也会不同，虽然算法完全一样，构造整个软件的思路还是有很大的不同。
 * 
 * 
 */

require_once 'DictQuery.php';
require_once 'WordType.php';

class Segment
{
	/**
	 * 字典查询类
	 * @var  DictQuery
	 */
	private $dictQuery;
	
	function __construct($dictQuery)
	{
		$this->dictQuery = $dictQuery;
	}

	function toWordArray($str)
	{
		$len = strlen($str);
		$wordlist = array();
		
		$word = '';
		for ($i = 0; $i < $len; $i++)
		{
			if (ord($str[$i]) < 128) {//ascii
				
				array_push($wordlist, new WordNode($str[$i], false));
			} else if ($this->isChinese($str, $i)){
				array_push($wordlist, new WordNode(substr($str, $i, 2), true));
				$i++;
			} else {//其他的直接忽略
				//do nothing.
			}
		}
		return $wordlist;
	}

	function isChinese($word, $offset)
	{
		$word = ord($word[$offset]);
		return $word > 159 && $word < 248;
	}
	
	function segment($str)
	{
		$str = preg_replace("/\s+/", " ", $str);
	    $wordArray = $this->toWordArray($str);
		$wordArray = $this->sepSentence($wordArray);
		//开始分词
		$segment = array();
		foreach ($wordArray as $key => $part)
		{
			if ($part[0]->wordType & T_SEP) {
				$segment[] = $this->segmentSep($part);
			} else if ($part[0]->wordType & T_CHINESE) {
				$segment[] = $this->segmentChinese($part);
			} else {
				$segment[] = $this->segmentEnglish($part);
			}
		}
		$result = array();
		foreach ($segment as $part)
		{
			foreach ($part as $atom)
			{
				$result[] = $atom;
			}
		}
		$this->dictQuery->clearCache();
		return $result;
	}
	
	function getKeyword($segment_result, $num = 10)
	{

		$data = array();
		$max_feq = 500000;
		foreach ($segment_result as $item)
		{
			$item->word=strip_tags($item->word);

			if (strlen(trim($item->word)) > 2 )
			{	 
				$feq = $item->feq;
				if ($feq == 0) $feq = 1;
				if (!isset($data[$item->word])) {
					$data[$item->word] = 0;
				}

				$data[$item->word] += log10($max_feq/$feq);
			}
		}
		arsort($data, SORT_NUMERIC);
		$result = array();
		$i = 0;
		foreach ($data as $key => $value)
		{
			$i++;
			$result[$key] = round($value, 4);
			if ($i >= $num) {
				break;
			}
		}
		return $result;
	}
	
	/**
	 * 切割句子，分成中文部分，和英文部分。并按照分隔符号进行切分。
	 * @param array $wordArray
	 */
	function sepSentence($wordArray)
	{
		
		//分隔符号，对句子进行分类
        $arr = $this->_sepSentence($wordArray, T_SEP);
		//对每个部分，按照中文，英文进行分割
		$wordList = array();
		foreach ($arr as $part)
		{
			$tmp = $this->_sepSentence($part, T_CHINESE);
			foreach ($tmp as $segment_atom)
			{
				$wordList[] = $segment_atom;
			}
		}
		return $wordList;
	}

	function _sepSentence($wordArray, $sepType)
	{
	    $arr = array();
		$prev = -1;
		$part = array();
		foreach ($wordArray as $wordNode)
		{
			$current = $wordNode->wordType & $sepType;
			if($prev != $current && !empty($part)) {
				array_push($arr, $part);
				$part = array();
			}
			array_push($part, $wordNode);
			$prev = $current;
		}
		//处理最后一部分
		if (!empty($part)) {
			array_push($arr, $part);
		}
		return $arr;
	}

	function segmentChinese($segment)
	{
		//正向最大匹配算法
		$result = array();
		$word = "";
		$prev = null;
		$count = count($segment);
		for ($i = 0; $i < $count - 1; $i++)
		{
			$word .= $segment[$i]->word;
			$next = $word . $segment[$i+1]->word;
			if(($rs = $this->dictQuery->likeHas($next)) == false)
			{
				$result[] = $this->_getWordItem($word);
				$word = "";
			}
		}
		//处理最后一个字,如果word为空，那么最后一次查询时false，那么最后一个字是不和前面的字组成词的。
		if (empty($word)) 
		{
			$word = $segment[$i]->word;
			$result[] = $this->_getWordItem($word);
		} else {
			$result[] = $this->_getWordItem($next);
		}
		return $result;
	}

	function _getWordItem($word)
	{
		$data = $this->dictQuery->find($word);
		if ($data == false) {
			return new WordItem($word, -2, 0);
		} else {
			return $data[0];
		}
	}

	function segmentEnglish($segment)
	{
		$word = "";
		$arr = array();
		//english 的词性是 -1 词频是0
		//分割符号的 词性是 -2 词频是0
		foreach ($segment as $part)
		{
			//根据空格进行切分
			
			//如果.在末尾，那就分成两个块,所以加了一个判断
			$prev = "";
			if ($part->word == " ") {
				if ($word != "") $arr[] = new WordItem($word, -1, 0);
				$word == "";
				continue;
			}
			$word .= $part->word;
		}
		if (!empty($word)) {
			$arr[] = new WordItem($word, -1, 0);
		}
		$result = array();
		foreach ($arr as $part)
		{
			if (substr($part->word, -1, 1) == ".") {
				preg_match("/\.+$/", $part->word, $match);
				$dot = $match[0];
				$word = preg_replace("/\.+$/", "", $part->word);
				if (!empty($word)) {
					$result[] = new WordItem($word, -1, 0);
				}
				$result[] = new WordItem($dot, -2, 0);
			} else {
				$result[] = $part;
			}
		}
		return $result;
	}

	function segmentSep($segment)
	{
		$result = array();
		foreach ($segment as $part)
		{
			$result[] = new WordItem($part->word, -2, 0);
		}
		return $result;
	}
}
?>