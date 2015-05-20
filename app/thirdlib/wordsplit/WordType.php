<?php
/**
 * 一个单词的节点
 * 
 * 包括这个单词的类型
 * 
 * ascii  
 * 
 * 汉语
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

define("T_CHINESE", 1);     //中文
define("T_SEP", 1 << 1);    //分割符合
define("T_NUM", 1 << 2);    //数字
define("T_INDEX", 1 << 3);  //索引 1. 2. 3. 4.
define("T_LETTER", 1 << 4); //字母
define("T_WORD", 1 << 5);   //正常单词
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
            A2A0     ⅰ ⅱ ⅲ ⅳ ⅴ ⅵ ⅶ ⅷ ⅸ ⅹ     
            A2B0   ⒈ ⒉ ⒊ ⒋ ⒌ ⒍ ⒎ ⒏ ⒐ ⒑ ⒒ ⒓ ⒔ ⒕ ⒖
            A2C0  ⒗ ⒘ ⒙ ⒚ ⒛ ⑴ ⑵ ⑶ ⑷ ⑸ ⑹ ⑺ ⑻ ⑼ ⑽ ⑾
            A2D0  ⑿ ⒀ ⒁ ⒂ ⒃ ⒄ ⒅ ⒆ ⒇ ① ② ③ ④ ⑤ ⑥ ⑦
            A2E0  ⑧ ⑨ ⑩   ㈠ ㈡ ㈢ ㈣ ㈤ ㈥ ㈦ ㈧ ㈨ ㈩ 
            A2F0   Ⅰ Ⅱ Ⅲ Ⅳ Ⅴ Ⅵ Ⅶ Ⅷ Ⅸ Ⅹ Ⅺ Ⅻ     
          */
         if ($b1 == 162) {
            return $wordType | T_INDEX;

         //-------------------------------------------------------
         //０ １ ２ ３ ４ ５ ６ ７ ８ ９
         } else if ($b1 == 163 && $b2 > 175 && $b2 < 186) {
            return $wordType | T_NUM;

         //-------------------------------------------------------
         //ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ
         //ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ 
         } else if ($b1 == 163 && ($b2 >= 193 && $b2 <= 218 || $b2 >= 225 && $b2 <= 250)) {
            return $wordType | T_LETTER;

         //-------------------------------------------------------
         /*
           code  +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
           A1A0     　 、 。 · ˉ ˇ ¨ 〃 々 — ～ ‖ … ‘ ’
           A1B0  “ ” 〔 〕 〈 〉 《 》 「 」 『 』 〖 〗 【 】
           A1C0  ± × ÷ ∶ ∧ ∨ ∑ ∏ ∪ ∩ ∈ ∷ √ ⊥ ∥ ∠
           A1D0  ⌒ ⊙ ∫ ∮ ≡ ≌ ≈ ∽ ∝ ≠ ≮ ≯ ≤ ≥ ∞ ∵
           A1E0  ∴ ♂ ♀ ° ′ ″ ℃ ＄ ¤ ￠ ￡ ‰ § № ☆ ★
           A1F0  ○ ● ◎ ◇ ◆ □ ■ △ ▲ ※ → ← ↑ ↓ 〓   
                             以下除了字母和数字的部分
           code  +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
           A3A0     ！ ＂ ＃ ￥ ％ ＆ ＇ （ ） ＊ ＋ ， － ． ／
           A3B0                                ： ； ＜ ＝ ＞ ？
           A3C0  ＠ 
           A3D0                                   ［ ＼ ］ ＾ ＿
           A3E0  ｀ 
           A3F0                                   ｛ ｜ ｝ ￣ 
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