<?php
/**
 * @desc 这个类主要的作用是保存词表的一行
 * @author cykzl
 *
 */
class WordItem
{
	/**
	 * 词名称
	 * @var string
	 */
	public $word;

	/**
	 * 词性
	 * @var int
	 */
	public $npos;

	/**
	 * 词频
	 * @var int
	 */
	public $feq;
	
	/**
	 * 构造函数，用于一次性对三个值分别赋值
	 * @param string $word
	 * @param int $npos
	 * @param int $feq
	 */
	function __construct($word = "", $npos = 0, $feq = 0)
	{
		$this->word = $word;
		$this->npos = $npos;
		$this->feq = $feq;	
	}
}
?>