<?php
/**
 * @desc �������Ҫ�������Ǳ���ʱ��һ��
 * @author cykzl
 *
 */
class WordItem
{
	/**
	 * ������
	 * @var string
	 */
	public $word;

	/**
	 * ����
	 * @var int
	 */
	public $npos;

	/**
	 * ��Ƶ
	 * @var int
	 */
	public $feq;
	
	/**
	 * ���캯��������һ���Զ�����ֵ�ֱ�ֵ
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