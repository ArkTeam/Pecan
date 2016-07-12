<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>ArkBlog</title>
		{include file="header.tpl"}
		<script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/ckeditor.js"></script>
		<script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/adapters/jquery.js"></script>

		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				{include file="topbar.tpl"}
			</div>
			<div class="row">
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						{include file="slidebar.tpl"}
					</div>
				</div>
					<div class="span9">
				
					<form id="edit-profile" class="form-horizontal">
						<fieldset>
							<legend>我的信息</legend>
							<div class="control-group">
								<label class="control-label" for="input01">用户名</label>
								<div class="controls">
									<input type="text" onfocus=this.blur(); class="input-xlarge" id="username" name="username" value="{$username}">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">手机</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="phone" name="phone"  value="{$phone}"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">电子邮箱</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="email" name="email" value="{$email}"/>
								</div>
							</div>
							<div class="control-group" style="display: none">
								<label class="control-label" for="fileInput">头像</label>
								<div class="controls"><center>
                                        <table width="100%" border="0" cellspacing="20" cellpadding="0" style="display: none">
                                        <tr>

                        <form action="<!--{ACTION_URL}-->/userAction/start" method="post" style="display: none">
                                                    <td width="50%" align="left">
                                                        <iframe src="<!--{ACTION_URL}-->/userAction/start" width="322" height="277" frameborder="0" scrolling="no"></iframe></td>
                                                    <td width="50%" align="left"><div id=""></div>
                        </form >-->
                                            </tr>
                                        </table>
                                    </center>
			  </div>
							</div>						
							<div class="control-group">
								<label class="control-label" for="textarea">简介</label>
								<div class="controls">
									<textarea class="input-xlarge" id="textarea" rows="4" name="Biography"  ">{$Biography}</textarea>
								</div>
							</div>
							<!--<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Public Profile</label>
								<div class="controls">
									<input type="checkbox" id="optionsCheckbox" value="option1" checked="checked">
								</div>
							</div>-->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary" formaction="<!--{ACTION_URL}-->/userAction/update_profile">保存</button> <button class="btn">Cancel</button>
							</div>
						</fieldset>
					</form>
				</div>
					
							
				
				</div>
			</div>
		</div>

<script type="text/javascript">
CKEDITOR.replace( 'blog_content', {
//uiColor: '#14B8C4',
width:700, 
height:200 

});
</script>
	</body>
</html>