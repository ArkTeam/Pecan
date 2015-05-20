<?php
/**
 * Segment �ִ��㷨�ӿ�
 * �������ʵ�ֵ�����򵥵ķִ��㷨�����ƥ���㷨��
 * 
 * 1. û�п����κεĴ�Ƶ����
 * 2. û�п����κε���������������
 * 
 * ���ҵļƻ����棬�ҽ���ʵ������ķִ��㷨��
 * 
 * 1. �����ƥ���㷨
 * 2. �������ƥ���㷨
 * 3. N-���·���㷨
 * 
 * ��Ȼ���ִʳ��˳����ķִ����⣬���������������������⡣����������ÿ�ִַʷ���������һЩ������
 * Ȼ�����Զ����Ա�ע�Ĺ��ܡ�������ܣ���ͳ��ѧ�����ȽϺô���
 * 
 * �����һֱ��˼���������ǣ���ͬ���Ե����˼�롣���ԣ�Ҫ�����Щ���죬�Ҿ�����򵥵ķ������ǣ�
 * ͬһ�����⣬�ò�ͬ�����Զ�ʵ��һ�飬����ÿ����������Ƶ�ʱ��ȡ�ᵽ����ʲô��ͬ��
 * 
 * 1. C����Ȼ������һ���в����ԵĴ�����ʵ��������Ӳ����������һ��ķ�װ�������װ�������ҿ������ͺ�����ת������ࡣ
 * ͬʱ�������˸��ֻ����ڻ���Ĳ��졣
 * 
 * 2. C++����Ȼ���������Էǳ��������顣���ǣ��ǳ����ԣ���ĳ�ֽǶ���˵������Ҫ���ൽ C# �� Java �������Ե���Ӫ�ġ�������
 *    ��C������ͬ�ࡣ��C����ֻ��C++��һ�ֲ��ԣ����������Եı��ʡ�
 *    
 * 3. PHP���ű����ԵĴ���ͬʱ����webʱ�������ԡ���Ȼ���ڶ�̬����˵��Ҫ�ȱ����͵�����Ҫ�õĶ࣬��������Ҫ��һЩ��
 * 
 * 
 * �������PHP�汾�⣬�һ���ʵ��C�汾��C++�汾��
 * 
 * ��Ȼ��ʵ����Щ���������ҵ�Ŀ�ġ�������Ƚ�һ�£���ͬ�����ԣ�������ͬ��
 * Ӧ��Ŀ��Ҳ�᲻ͬ����Ȼ�㷨��ȫһ�����������������˼·�����кܴ�Ĳ�ͬ��
 * 
 * 
 */

require_once 'DictQuery.php';
require_once 'WordType.php';

class Segment
{
	/**
	 * �ֵ��ѯ��
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
			} else {//������ֱ�Ӻ���
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
		//��ʼ�ִ�
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
	 * �и���ӣ��ֳ����Ĳ��֣���Ӣ�Ĳ��֡������շָ����Ž����з֡�
	 * @param array $wordArray
	 */
	function sepSentence($wordArray)
	{
		
		//�ָ����ţ��Ծ��ӽ��з���
        $arr = $this->_sepSentence($wordArray, T_SEP);
		//��ÿ�����֣��������ģ�Ӣ�Ľ��зָ�
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
		//�������һ����
		if (!empty($part)) {
			array_push($arr, $part);
		}
		return $arr;
	}

	function segmentChinese($segment)
	{
		//�������ƥ���㷨
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
		//�������һ����,���wordΪ�գ���ô���һ�β�ѯʱfalse����ô���һ�����ǲ���ǰ�������ɴʵġ�
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
		//english �Ĵ����� -1 ��Ƶ��0
		//�ָ���ŵ� ������ -2 ��Ƶ��0
		foreach ($segment as $part)
		{
			//���ݿո�����з�
			
			//���.��ĩβ���Ǿͷֳ�������,���Լ���һ���ж�
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