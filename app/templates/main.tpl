<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<!--{PUBLIC_PATH}-->/i_include/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="allBox">
  <div id="picBox">
    <noscript id="noscript">您的浏览器当前的设置不支持Javascript语言，无法使用此截图程序！请对您的浏览器设置进行调整。</noscript>
    <div id="runSub">图片处理中……</div>
    <div id="picViewOuter">图片载入中……</div>
    <div id="sliderOuter"><div id="run"><a href="#" onclick="subCut();return false;">提交截图</a><a href="#" onclick="startP();return false;">重载图片</a></div><div id="slider"><span id="sliderBlock">100%</span></div></div>
  </div>
</div>




<script type="text/javascript" language="javascript">
<!--
//关于图片处理
var _cutMinW=48; //切片最小宽度
var _cutMinH=48; //切片最小高度
var _imgPath=getCookie('162100screenshotsImg'); //图片路径
 



function getCookie(name){
  var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
  if(arr!=null && arr!=false) return decodeURIComponent(arr[2]);
  return false;
}

function startP(){
  //alert('示例图片已载入，此键暂不必用');
  location.href="start.html";
}

function subCut(){
/*
  alert('\
图片实际宽度为'+Math.ceil(_imgW)+'px\n\
图片实际高度为'+Math.ceil(_imgH)+'px\n\
图片当前宽度为'+Math.ceil(_nowW)+'px\n\
图片当前高度为'+Math.ceil(_nowH)+'px\n\
截图X坐标为'+Math.ceil(_pP.offsetWidth+1-_imgO.offsetLeft)+'px\n\
截图Y坐标为'+Math.ceil(_pP.offsetHeight+1-_imgO.offsetTop)+'px\n\
截图宽度为'+Math.ceil(_pO.offsetWidth-2)+'px\n\
截图高度为'+Math.ceil(_pO.offsetHeight-2)+'px\n\
可将上述参数，转向后台处理。');
*/
  if(!_imgW || !_imgH || _imgO==null){
    alert('图片加载出错！');
    return false;
  }
  var f=document.createElement("form");
  f.action="<!--{ACTION_URL}-->/userAction/portrait";
  f.method="post";
  f.style.display='none';
  f.innerHTML='\
<input type="hidden" name="imgw" value="'+Math.ceil(_imgW)+'" />\
<input type="hidden" name="imgh" value="'+Math.ceil(_imgH)+'" />\
<input type="hidden" name="noww" value="'+Math.ceil(_nowW)+'" />\
<input type="hidden" name="nowh" value="'+Math.ceil(_nowH)+'" />\
<input type="hidden" name="px" value="'+Math.ceil(_pP.offsetWidth+1-_imgO.offsetLeft)+'" />\
<input type="hidden" name="py" value="'+Math.ceil(_pP.offsetHeight+1-_imgO.offsetTop)+'" />\
<input type="hidden" name="pw" value="'+Math.ceil(_pO.offsetWidth-2)+'" />\
<input type="hidden" name="ph" value="'+Math.ceil(_pO.offsetHeight-2)+'" />\
<input type="hidden" name="ptype" value="4" />\
';
  document.body.appendChild(f);
  document.getElementById('runSub').style.display='block';
  f.submit();
}
-->
</script>









<script type="text/javascript" language="javascript">

var _cutMinW=_cutMinW||48;var _cutMinH=_cutMinH||48;if(document.all){window.attachEvent('onload',_picLoad);}else{window.addEventListener('load',_picLoad,false);}if(typeof $!='function'){var $=function(o){return document.getElementById(o);}}$("allBox").onselectstart=function(){return false};var _imgO,_imgW,_imgH,_nowW,_nowH,_nowL,_nowT,_imgMinW,_imgMinH;var _pP=null;var _pO=null;var __M=0;$('noscript').style.display='none';$('picViewOuter').innerHTML='<table id="picMask" border="0" cellspacing="0" cellpadding="0"><tr><td id="pP">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td id="pO"><div id="pC"></div></td><td>&nbsp;</td></tr><tr><td height="225">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table><img src="'+_imgPath+'" border="0" id="sourceimg" />';var _dragStr1='';var _dragStr2='';var _ds={'tl':[1,1,-1,-1],'tm':[0,1,0,-1],'tr':[0,1,1,-1],'ml':[1,0,-1,0],'mr':[0,0,1,0],'bl':[1,0,-1,1],'bm':[0,0,0,1],'br':[0,0,1,1]};for(var k in _ds){_dragStr1+='<table id="dm_'+k+'" class="dm" border="0" cellspacing="0" cellpadding="0"><tr><td></td></tr></table>';_dragStr2+='$(\'dm_'+k+'\').onmousedown=function(e){dragsChange(e,\''+k+'\')}\n';}$('pC').innerHTML=_dragStr1;eval(_dragStr2);_ds['tO']=[1,1,0,0];$('pO').onmousedown=function(e){dragsChange(e,'tO')};function dragsChange(e,k){var e=window.event||e;e.cancelBubble=true;var _piccutX=e.clientX;var _piccutY=e.clientY;_pP=$('pP');_pO=$('pO');var evalStr='var _pX='+_pP.offsetWidth+'+'+_ds[k][0]+'*_posX-2;var _pY='+_pP.offsetHeight+'+'+_ds[k][1]+'*_posY-2;var _pW='+_pO.offsetWidth+'+'+_ds[k][2]+'*_posX;var _pH='+_pO.offsetHeight+'+'+_ds[k][3]+'*_posY;var _oldW=_pX+_pW;var _oldH=_pY+_pH;';if(_ds[k][0]!=0)evalStr+='_pP.style.width=_pW<=_cutMinW?_oldW-_cutMinW:_pX+\'px\';';if(_ds[k][1]!=0)evalStr+='_pP.style.height=_pW<=_cutMinH?_oldH-_cutMinH:_pY+\'px\';';if(_ds[k][2]!=0)evalStr+='_pO.style.width=$(\'pC\').style.width=(_pW>=290?290:(_pW<=_cutMinW?_cutMinW:_pW))+\'px\';';if(_ds[k][3]!=0)evalStr+='_pO.style.height=$(\'pC\').style.height=(_pH>=215?215:(_pH<=_cutMinH?_cutMinH:_pH))+\'px\';';document.onmousemove=function(e){var e=window.event||e;var _posX=e.clientX-_piccutX;var _posY=e.clientY-_piccutY;try{eval(evalStr);}catch(err){}try{eval(chkSize('X','W','L','width','left',0,2,300));}catch(err){}try{eval(chkSize('Y','H','T','height','top',1,3,225));}catch(err){}document.onmouseup=function(){document.onmousemove=null};}};function _picLoad(){_imgO=$('sourceimg');if(_imgO==null){alert('没有载入源图片，无法截图，请载入图片！');return;}_nowW=_imgW=_imgO.offsetWidth;_nowH=_imgH=_imgO.offsetHeight;_nowL=(300-_nowW)/2;_nowT=(225-_nowH)/2;_imgO.style.left=_nowL+'px';_imgO.style.top=_nowT+'px';_pP=$('pP');_pO=$('pO');if(_pO.offsetWidth>200 || _pO.offsetHeight>200){alert('切片初始尺寸太大了！宽、高都不能超过200px');_pO.style.width=$('pC').style.width='78px';_pO.style.height=$('pC').style.height='78px';}if(_nowW<=_pO.offsetWidth){_pP.style.width=_nowL-1+'px';_pO.style.width=$('pC').style.width=_nowW+'px';}if(_nowH<=_pO.offsetHeight){_pP.style.height=_nowT-1+'px';_pO.style.height=$('pC').style.height=_nowH+'px';}/*计算最小图片值*/if(_nowW<_cutMinW || _nowH<_cutMinH){_imgMinW=_nowW;_imgMinH=_nowH;}else{if(_cutMinW/_cutMinH>_nowW/_nowH){_imgMinW=_cutMinW;_imgMinH=_nowH*_cutMinW/_nowW;}else{_imgMinW=_nowW*_cutMinH/_nowH;_imgMinH=_cutMinH;}}}$('sliderBlock').onmousedown=function(e){var e=window.event||e;var _scrO=this;var _imgX=e.clientX-_scrO.offsetLeft;document.onmousemove=function(e){var e=window.event||e;var _posX=e.clientX-_imgX;_posX=_posX<0?0:_posX;_posX=_posX>124-24?124-24:_posX;_scrO.style.left=_posX+"px";_scrO.innerHTML=_posX*2+'%';_nowW=_imgW*(_posX/50);_nowH=_imgH*(_posX/50);if(_nowW<=_imgMinW || _nowH<=_imgMinH){_nowW=_imgMinW;_nowH=_imgMinH;}_nowL=(300-_nowW)/2;_nowT=(225-_nowH)/2;_imgO.style.width=_nowW+'px';_imgO.style.height=_nowH+'px';_imgO.style.left=_nowL+'px';_imgO.style.top=_nowT+'px';_pP=$('pP');_pO=$('pO');if(_nowW<=_pO.offsetWidth){_pP.style.width=_nowL-1+'px';_pO.style.width=$('pC').style.width=_nowW+'px';}if(_nowH<=_pO.offsetHeight){_pP.style.height=_nowT-1+'px';_pO.style.height=$('pC').style.height=_nowH+'px';}var _pX=_pP.offsetWidth-2;var _pY=_pP.offsetHeight-2;var _pW=_pO.offsetWidth;var _pH=_pO.offsetHeight;__M=1;try{eval(chkSize('X','W','L','width','left',0,2,300));}catch(err){}try{eval(chkSize('Y','H','T','height','top',1,3,225));}catch(err){}__M=0;document.onmouseup=function(){document.onmousemove=null;}}};function chkSize(X,W,L,w,l,i,j,n){return 'if(_now'+W+'<=_cutMin'+W+'){_pP.style.'+w+'=_now'+L+'-1+\'px\';_pO.style.'+w+'=$(\'pC\').style.'+w+'=_now'+W+'+\'px\';}else if(_now'+W+'>='+n+'){var _nN=((_p'+X+'+_p'+W+'/2)/'+n/2+')*_now'+L+';if(_nN>=0){_nN=0;}if(_nN<='+n+'-_now'+W+'){_nN='+n+'-_now'+W+';}_imgO.style.'+l+'=_nN+\'px\';if(_p'+X+'<=4){_pP.style.'+w+'=\'4px\';}if(_p'+X+'+_p'+W+'+2+4>='+n+'){if(_ds[k]['+i+']==0){_pO.style.'+w+'=$(\'pC\').style.'+w+'='+n+'-_p'+X+'-8+\'px\';}if(_ds[k]['+j+']==0){_pP.style.'+w+'='+n+'-_p'+W+'-4+\'px\';}}}else{if(_p'+X+'<=_now'+L+'){_pP.style.'+w+'=_now'+L+'-1+\'px\';if(_ds[k]['+i+']!=0 && _ds[k]['+j+']!=0){var _old'+W+'=_p'+X+'+_p'+W+';_pO.style.'+w+'=$(\'pC\').style.'+w+'=_old'+W+'-_now'+L+'+1+\'px\';}}if(_p'+X+'+2+_p'+W+'>=_now'+W+'+_now'+L+'){if(_ds[k]['+i+']==0){if(__M!=1){_pO.style.'+w+'=$(\'pC\').style.'+w+'=_now'+L+'+_now'+W+'-_p'+X+'-3+\'px\';}else{_pP.style.'+w+'=_now'+L+'+_now'+W+'-_p'+W+'+1+\'px\';}}if(_ds[k]['+j+']==0){_pP.style.'+w+'=_now'+L+'+_now'+W+'-_p'+W+'+1+\'px\';}}}';};


</script>




</body>
</html>