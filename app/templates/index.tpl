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
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Pecan</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active">
									<a href="index.html">首页</a>
								</li>
							
								
							</ul>
							<form class="navbar-search pull-left" action="">
								<input type="text" class="search-query span2" placeholder="搜索" />
							</form>
							<ul class="nav pull-right">
								<li>
									<a href="<!--{ACTION_URL}-->/articleAction/showarticles?s=0&o=<!--{pagesize}-->">博客主页</a>
								</li>
								<li>
									<a href="profile.htm">{$username}</a>
								</li>
								
								<li>
									<img height="30"  src="{$porpath}"  style="border-radius: 50px;margin-top:5px" width="30" />
								</li>
								
								<li>
									<a href="login.htm">退出后台</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
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
				    	 <input type="text" class="input-block-level" placeholder="标题" name='title'>
				    	  <input type="text" class="input-block-level" placeholder="标签" name='tags'>
				    	  <input type="text" class="input-block-level" placeholder="来源" name='source'>
				    	  <div class="controls">
				    	 	 <select id="category_id" name='category_id'> 
									<option value='0'>文章分类</option> 
				    	  			{foreach $categories(key,value)}

										<option>{@value}</option> 

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
width:700, 
height:200 

});
</script>
	</body>
</html>