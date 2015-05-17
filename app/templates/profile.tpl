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
								<label class="control-label" for="input01">昵称</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="John Smith">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Phone</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="555 555 555">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Email</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="john.smith@example.org">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">Photo</label>
								<div class="controls">
									<input class="input-file" id="fileInput" type="file">
								</div>
							</div>						
							<div class="control-group">
								<label class="control-label" for="textarea">Biography</label>
								<div class="controls">
									<textarea class="input-xlarge" id="textarea" rows="4">Web technology junkie who writes innovative and bestselling technical books. Also enjoys Sunday bicycle rides and all "good" comedy.</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Public Profile</label>
								<div class="controls">
									<input type="checkbox" id="optionsCheckbox" value="option1" checked="checked">
								</div>
							</div>						
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button> <button class="btn">Cancel</button>
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