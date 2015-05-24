<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
   {include file="header.tpl"}
   
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<style type="text/css">
<!--
body,td,th {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#999999;
}
a { color:#0099FF; }
-->
</style>
<script type="text/javascript" language="javascript">
<!--
function getCookie(name){
  var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
  if(arr!=null && arr!=false) return decodeURIComponent(arr[2]);
  return false;
}
window.onload=function(){
  var screenshotsImg=getCookie('162100screenshotsImgSmall');
  var screenshotsSrc=screenshotsImg!=false?screenshotsImg:'./i_upload/default.gif'
  if(document.getElementById('screenshotsShow')!=null){
    document.getElementById('screenshotsShow').innerHTML='<img src="'+screenshotsSrc+'" />';
  }
}
-->
</script>
 </head>

    <body>
    
    <div class="container">
   
      <form name="register-form" enctype="multipart/form-data" class="form-signin" action="<!--{ACTION_URL}-->/userAction/register" method="post" >
        <h3 class="form-signin-heading" align="center">用户注册</h3>
        <input type="text" class="input-block-level" placeholder="用户名" name='username'>
        <input type="password" class="input-block-level" placeholder="邮箱" name='email'>
        <input type="password" class="input-block-level" placeholder="密码" name='password'>
        <input type="password" class="input-block-level" placeholder="重复密码" name='repassword'>
        <input type="text" class="input-small" placeholder="验证码" name='captcha'><img id='captchaimage' onclick='changecode()' style='margin-left:10px;margin-top:-20px' src='<!--{ACTION_URL}-->/utilAction/getcaptcha'><a href="javascript:changecode();"><span style='margin-left:10px'>换一张</span></a>
      
	    <center>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<table width="100%" border="0" cellspacing="20" cellpadding="0">
			  <tr>
			  	<form action="<!--{ACTION_URL}-->/userAction/start" method="post">
				    <td width="50%" align="right"><iframe src="<!--{ACTION_URL}-->/userAction/start" width="322" height="277" frameborder="0" scrolling="no"></iframe></td>
				    <td width="50%" align="left"><div id=""></div>
			  	</form >
			  </tr>
			</table>
		</center>
        
        
        <button class="btn  btn-primary" type="submit">注册</button>
        <button class="btn  btn-primary" type="button">返回</button></br>
        
                                        
      </form>
    

	</div>
    <script type="text/javascript">
 	function changecode(){
		var img = document.getElementById("captchaimage");
		img.src = "<!--{ACTION_URL}-->/utilAction/getcaptcha";
		return ;
 	}
	</script>    
  </body>
</html>