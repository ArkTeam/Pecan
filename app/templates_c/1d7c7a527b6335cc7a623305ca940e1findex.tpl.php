<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>ArkBlog</title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script src="<?php echo $this->_config['PUBLIC_PATH'];?>/js/jquery.min.js"></script>
    <script src="<?php echo $this->_config['PUBLIC_PATH'];?>/js/bootstrap.min.js"></script>
    <link href="<?php echo $this->_config['PUBLIC_PATH'];?>/css/bootstrap.min.css" rel="stylesheet" media="screen">


		<script src="<?php echo $this->_config['PUBLIC_PATH'];?>/plugin/ckeditor/ckeditor.js"></script>
		<script src="<?php echo $this->_config['PUBLIC_PATH'];?>/plugin/ckeditor/adapters/jquery.js"></script>

		
		

		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">ArkBlog</a>
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
									<a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showarticles?s=0&o=<?php echo $this->_config['pagesize'];?>">博客主页</a>
								</li>
								<li>
									<a href="profile.htm"><?php echo $this->_vars['username'];?></a>
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
						<ul class="nav nav-list">
							<li class="nav-header">
								Ark Blog
							</li>
							<li class="active">
								<a href="index.htm"><i class="icon-white icon-home"></i> 统计</a>
							</li>
							<li>
								<a href="<?php echo $this->_config['ACTION_URL'];?>/userAction/login"><i class="icon-folder-open"></i>撰写文章</a>
							</li>
							<li>
								<a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/listarticles"><i class="icon-check"></i> 我的文章</a>
							</li>
							<li>
								<a href="messages.htm"><i class="icon-envelope"></i> Ideas</a>
							</li>
							<li>
								<a href="<?php echo $this->_config['ACTION_URL'];?>/categoryAction/showCategory"><i class="icon-envelope"></i> 分类管理</a>
							</li>
							<li>
								<a href="files.htm"><i class="icon-file"></i> 文件管理</a>
							</li>
							<li>
								<a href="activity.htm"><i class="icon-list-alt"></i> 其他</a>
							</li>
							<li class="nav-header">
								我的账号
							</li>
							<li>
								<a href="profile.htm"><i class="icon-user"></i> 个人资料</a>
							</li>
							<li>
								<a href="settings.htm"><i class="icon-cog"></i> 系统设置</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="help.htm"><i class="icon-info-sign"></i> 帮助</a>
							</li>
						
						</ul>
					</div>
				</div>
				<div class="span9">
	

					<h2>
						发表文章
					</h2>
				    <form class="form-signin" action="<?php echo $this->_config['ACTION_URL'];?>/articleAction/postarticle" method="post" >
				    	 <input type="text" class="input-block-level" placeholder="标题" name='title'>
				    	  <input type="text" class="input-block-level" placeholder="标签" name='tags'>
				    	  <input type="text" class="input-block-level" placeholder="来源" name='source'>
				    	  <div class="controls">
									<select id="category_id" name='category_id'> <option value='0'>默认分类</option> <option>Bad Robot</option> <option>Evil Genius</option> <option>Monsters Inc</option> </select>
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