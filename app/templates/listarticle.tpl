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
									<a href="<!--{ACTION_URL}-->/articleAction/showarticles?s=0&o=<!--{pagesize}-->">博客主页</a>
								</li>
								<li>
									<a href="profile.htm">{$username}</a>
								</li>
								<li>
									<img src="{$porpath}"  height="38px" width="38px" align="middle"/>
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
								<a href="projects.htm"><i class="icon-folder-open"></i>撰写文章</a>
							</li>
							<li>
								<a href="<!--{ACTION_URL}-->/articleAction/listarticles"><i class="icon-check"></i> 我的文章</a>
							</li>
							<li>
								<a href="messages.htm"><i class="icon-envelope"></i> Ideas</a>
							</li>
							<li>
								<a href="<!--{ACTION_URL}-->/categoryAction/showCategory"><i class="icon-envelope"></i> 分类管理</a>
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
					<h1>
						我的文章
					</h1>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									标题
								</th>
								<th>
									分类
								</th>
								<th>
									时间
								</th>
								<th>
									仅自己可见
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						     {foreach $articles(key,value)} 
							<tr>
								<td>
									{@value['title']}
								</td>
								<td>
									{@value['category_id']}
								</td>
								<td>
									{@value['posttime']}
								</td>
								<td>
									{if $(f)}
									Yes
									{else}
									No
									{/if}
								</td>
								<td>
									<a href="#" class="view-link">修改</a>
								</td>
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/hideArticle?article_id={@value['id_ark_article']}" class="view-link">隐藏</a>
								</td>
							</tr>
							{/foreach}
							
						</tbody>
					</table>				
					<div class="pagination">
						<ul>
							<li class="disabled">
								<a href="#">&laquo;</a>
							</li>
							<li class="active">
								<a href="#">1</a>
							</li>
							<li>
								<a href="#">2</a>
							</li>
							<li>
								<a href="#">3</a>
							</li>
							<li>
								<a href="#">4</a>
							</li>
							<li>
								<a href="#">&raquo;</a>
							</li>
						</ul>
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