<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>Pecan</title>
		{include file="header.tpl"}
		<script src="<!--{PUBLIC_PATH}-->/plugin/myckeditor/ckeditor.js"></script>
		<script src="<!--{PUBLIC_PATH}-->/plugin/myckeditor/adapters/jquery.js"></script>
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
	

					<h2>
						发表文章
					</h2>
					
				    <form class="form-signin" action="<!--{ACTION_URL}-->/articleAction/postarticle" method="post" >
				    	 <input type="text" class="input-block-level" placeholder="标题"  name='title'>
				    	  <input type="text" class="input-block-level" placeholder="标签" name='tags'>
				    	  <input type="text" class="input-block-level" placeholder="来源" length='100' name='source'>
				    	  <div class="controls">
				    	 	 <select id="category_id" name='category_id'> 
									<option value='0'>默认分类</option> 
				    	  			{foreach $categories(key,value)}

										<option name="{@value['category_name']}" value="{@value['id_ark_category']}">{@value['category_name']}</option> 

									{/foreach}
								
							</select>
						  </div>
					<textarea rows="50" cols="30" name="blog_content" id='blog_content' ></textarea>
					</br>
	 				<button class="btn  btn-primary" type="submit">发布</button>
					</form>
					<ul class="pager">
						<li class="next">
							<a href="activity.htm">了解更多 &rarr;</a>
						</li>
					</ul>
                    <ul class="pager">
						 
					</ul>
				</div>
			</div>
		</div>

<script type="text/javascript">
CKEDITOR.replace( 'blog_content', {
//uiColor: '#14B8C4',
width:900, 
height:200 
});
</script>
	</body>
</html>