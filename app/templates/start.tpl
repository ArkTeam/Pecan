<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<!--{PUBLIC_PATH}-->/i_include/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
<!--
function postChk(){
  var chkid=get_checkbox();
  if(chkid!=1 && chkid!=2 && chkid!=3){
    alert('请选择一种图片来源！');
    return;
  }
  var chkO=document.getElementById('purl'+chkid+'');
  if(chkO.value==''){
    alert('请输入图片URL！');
    chkO.focus();
    return;
  }
  var reg=new RegExp((chkid==1?'.+':'^https?:\/\/.+')+'\.(jpg|gif|png)$','i');
  if(!chkO.value.match(reg)){
    alert('图片URL输入不合法！'+(chkid!=1?'网址以http://开头！':'')+'图片格式限(jpg|gif|png)');
    chkO.focus();
    return;
  }
  document.getElementById('runSub').style.display='block';
  document.getElementById('pform').submit();
  
}

function get_checkbox(){
  var allCheckBox=document.getElementsByName("ptype");
  var article='';
  if(allCheckBox!=null && allCheckBox.length>0){
    for(var i=0;i<allCheckBox.length;i++){
      if(allCheckBox[i].checked==true){
        article=allCheckBox[i].value;
        break;
      }
    }
  }
  return article;
}
-->
</script>
</head>
<body>
<div id="allBox">
  <div id="picBox">
    <div id="runSub">图片上传中……</div>
    <form action="<!--{ACTION_URL}-->/userAction/portrait" method="post" enctype="multipart/form-data" id="pform">
      <div id="picViewOuter"> <b>选择图片来源：</b><br />
          <br />
          <input type="radio" id="p1" name="ptype" value="1" checked="checked" />
          <label for="p1">
        本机上传：<br />
          <div class="sword">
            <input type="file" id="purl1" name="purl1" size="25" class="sinput" onfocus="document.getElementById('p1').checked='checked'" />
          </div>
            </label>
        <input type="radio" id="p2" name="ptype" value="2" />
          <label for="p2">
        网络图片：<br />
        <div class="sword">
          <input type="text" id="purl2" name="purl2" size="25" class="sinput" onfocus="document.getElementById('p2').checked='checked'" /> 图片URL
        </div>
            </label>
<!--
        <input type="radio" id="p3" name="ptype" value="3" />
        <label for="p3">
        网页快照：<br />
        <div class="sword">网页网址
          <input type="text" id="purl3" name="purl3" size="25" class="sinput" onfocus="document.getElementById('p3').checked='checked'" />
        </div>
            </label>
-->
      </div>
      <div style="height:25px; margin-top:5px;">
        <div id="run"><a href="#" onclick="postChk();return false;">提 交</a></div>
      
      </div>
    </form>
  </div>
</div>
</body>
</html>