<?php
/**
 * һ�����ʵĽڵ�
 * 
 * ����������ʵ�����
 * 
 * ascii  
 * 
 * ����
 * 
 * @author cykzl
 *
 */
class WordNode
{
	/**
	 * a word 
	 * 
	 * @var string
	 */
	public $word;
	
	/**
	 * word type
	 * 
	 * @var int
	 */
	public $wordType;
	
	function __construct($word, $ischinese)
	{
		$this->word = $word;
		if ($ischinese)
		{
			$this->wordType = WordType::getChineseType($word);
		} else {
			$this->wordType = WordType::getEnglistType($word);
			
		}
	}
}

define("T_CHINESE", 1);     //����
define("T_SEP", 1 << 1);    //�ָ����
define("T_NUM", 1 << 2);    //����
define("T_INDEX", 1 << 3);  //���� 1. 2. 3. 4.
define("T_LETTER", 1 << 4); //��ĸ
define("T_WORD", 1 << 5);   //��������
define("T_OTHER", 1 << 6);
class WordType
{
     static  $englist_sep = array("!", "?", ":", ";", "*", ",", "(", ")", "[", "]", "{", "}", "=");

     static function getChineseType($word)
     {	
         $wordType = 0;
         $wordType |= T_CHINESE;
     	 $b1 = ord($word[0]);
         $b2 = ord($word[1]);
     	 //-------------------------------------------------------
         /*
            code  +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
            A2A0     �� �� �� �� �� �� �� �� �� �� �f �g �h �i �j
            A2B0  �k �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
            A2C0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
            A2D0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
            A2E0  �� �� �� �l �m �� �� �� �� �� �� �� �� �� �� �n
            A2F0  �o �� �� �� �� �� �� �� �� �� �� �� �� �p �q   
          */
         if ($b1 == 162) {
            return $wordType | T_INDEX;

         //-------------------------------------------------------
         //�� �� �� �� �� �� �� �� �� ��
         } else if ($b1 == 163 && $b2 > 175 && $b2 < 186) {
            return $wordType | T_NUM;

         //-------------------------------------------------------
         //���£ãģţƣǣȣɣʣˣ̣ͣΣϣУѣңӣԣգ֣ףأ٣�
         //��������������������������������� 
         } else if ($b1 == 163 && ($b2 >= 193 && $b2 <= 218 || $b2 >= 225 && $b2 <= 250)) {
            return $wordType | T_LETTER;

         //-------------------------------------------------------
         /*
           code  +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
           A1A0     �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A1B0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A1C0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A1D0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A1E0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A1F0  �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��   
                             ���³�����ĸ�����ֵĲ���
           code  +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
           A3A0     �� �� �� �� �� �� �� �� �� �� �� �� �� �� ��
           A3B0                                �� �� �� �� �� ��
           A3C0  �� 
           A3D0                                   �� �� �� �� ��
           A3E0  �� 
           A3F0                                   �� �� �� �� 
          */
         } else if ($b1 == 161 || $b1 == 163) {
            return $wordType | T_SEP;

         } else if ($b1 >= 176 && $b1 <= 247) {
            return $wordType | T_WORD;
         } else {
            return $wordType | T_OTHER;
         }
     }
 
     static function getEnglistType($word)
     {
     	$code = ord($word[0]);
     	if (in_array($word, self::$englist_sep))
     	{
     		return T_SEP;
     	} else if ($code >= 48 && $code <= 57) {
     		return T_NUM;
     	} else if ($code >= 65 && $code <= 90 || $code >= 97 && $code <= 122) {
     		return T_LETTER;
     	} else {
     		return T_OTHER;
     	}
     	$code = ord($word[0]);
     }
}