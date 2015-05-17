<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>Pecan</title>
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
				<h2>
					修改文章
				</h2>
					
			    <form class="form-signin" action="<!--{ACTION_URL}-->/articleAction/modifyArticle" method="post" >
			    	 <input type="hidden" name='article_id', value={#article['id_ark_article']} />
			    	 <p>标题：</p><input type="text" class="input-block-level" placeholder="标题" name='title' value={#article['title']}>
			    	 <p>标签：</p><input type="text" class="input-block-level" placeholder="标签" name='tags' value={#article['tags']}>
			    	 <p>来源：</p><input type="text" class="input-block-level" placeholder="来源" name='source' value={#article['source']}>
			    	 <div class="controls"><p>分类：</p>
			    	 	 <select id="category_id" name='category_id'> 
								<option value='0'>文章分类</option> 
			    	  			{foreach $categories(key,value)}
									<option>{@value}</option> 
								{/foreach}
						</select>
					  </div>
				<textarea rows="50" cols="30" name="blog_content" id='blog_content'>{#article['blog_content']}</textarea>
				</br>
				<button class="btn  btn-primary" type="submit">更改</button>
				<button class="btn" type="button">取消</button>
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
width:700, 
height:200 

});
</script>
	</body>
</html>