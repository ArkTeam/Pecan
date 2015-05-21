<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>ArkBlog</title>
		{include file="header.tpl"}
		<script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/ckeditor.js"></script>

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
				
				<div class="span11">
					<h5>
						我的文章
					</h5>
					<div class="span8" style="padding:0 8px 8px 0" align=right>
						<a href="<!--{ACTION_URL}-->/articleAction/listarticles?s_type=0" class="view-link" style="padding:0 0 0 4px">全部</a>
						<a href="<!--{ACTION_URL}-->/articleAction/listarticles?s_type=1" class="view-link" style="padding:0 0 0 4px">已公开</a>
						<a href="<!--{ACTION_URL}-->/articleAction/listarticles?s_type=2" class="view-link" style="padding:0 0 0 4px">已隐藏</a>
						<a href="<!--{ACTION_URL}-->/articleAction/listarticles?s_type=3" class="view-link" style="padding:0 0 0 4px">回收站</a>
					</div>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="35%">
									标题
								</th>
								<th>
									分类
								</th>
								<th>
									更新时间
								</th>
								<th>
									仅自己可见
								</th>
								<th colspan="3">
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						
						     {foreach $articles(key,value)} 
							<tr>
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/showAnArticle?article_id={@value['id_ark_article']}" class="view-link">{@value['title']}</a>
								</td>
								<td>
									{@value['category_id']}
								</td>
								<td>
									{@value['updatetime']}
								</td>
								<td>
									{if @value['is_private'] == 1}
									Yes
									{else}
										No
									{/if}
								</td>
								{if $delmode}
								<td>
								<a href="<!--{ACTION_URL}-->/articleAction/showModifyArticle?article_id={@value['id_ark_article']}" class="view-link">修改</a>
								</td>
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/restoreDelArticle?article_id={@value['id_ark_article']}" class="view-link">恢复</a>
								</td>
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/delArticleCompletely?article_id={@value['id_ark_article']}" class="view-link">彻底删除</a>
								</td>
								{else}
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/showModifyArticle?article_id={@value['id_ark_article']}" class="view-link">修改</a>
								</td>
								<td>
								{if @value['is_private']}
									<a href="<!--{ACTION_URL}-->/articleAction/addHiddenArticle?article_id={@value['id_ark_article']}" class="view-link">公开</a>
								{else}
									<a href="<!--{ACTION_URL}-->/articleAction/hideArticle?article_id={@value['id_ark_article']}" class="view-link">隐藏</a>
								{/if}
								</td>
								<td>
									<a href="<!--{ACTION_URL}-->/articleAction/delArticle?article_id={@value['id_ark_article']}" class="view-link">放入回收站</a>
								</td>
								{/if}
							</tr>
							{/foreach}
							
						</tbody>
					</table>				
					<div class="pagination">
						<ul>
							<li class="disabled">
								<a href="<!--{ACTION_URL}-->/articleAction/prePage?pages={$pages}">&laquo;</a>
							</li>
							{foreach $counts(key,value)}
							<li class="active">
								<a href="<!--{ACTION_URL}-->/articleAction/listArticles?pages={@value}">{@value}</a>
							</li>
							{/foreach}
							<li>
								<a href="<!--{ACTION_URL}-->/articleAction/nextPage?pages={$pages}">&raquo;</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
