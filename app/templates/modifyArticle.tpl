<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<title>Pecan</title>
		{include file="header.tpl"}
		<script type="text/javascript" src="<!--{PUBLIC_PATH}-->/plugin/ueditor/ueditor.config.js"></script> 
		<script type="text/javascript" src="<!--{PUBLIC_PATH}-->/plugin/ueditor/ueditor.all.js"></script> 
		<script type="text/javascript" src="<!--{PUBLIC_PATH}-->/plugin/myckeditor/ckeditor.js"></script> 
		<script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/adapters/jquery.js"></script>
	    <link type="text/css" rel="stylesheet" href="<!--{PUBLIC_PATH}-->/plugin/shCoreDefault.css"/>
	    <script src="<!--{PUBLIC_PATH}-->/plugin/shCore.js"></script>
	    <script src="<!--{PUBLIC_PATH}-->/plugin/syntaxhighlighter.js"></script>
			
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
				<h5>
					修改文章
				</h5>
					
			    <form class="form-signin" action="<!--{ACTION_URL}-->/articleAction/modifyArticle" method="post" >
			    	  <input type="hidden" name='article_id', value="{#article['id_ark_article']}" />
			    	  <div class="input-prepend">
				         <span class="add-on">标题</span>
				         <input type="text" class="span9" placeholder="标题内容" name='title' value="{#article['title']}">
				      </div>
				      <div class="input-prepend">
				         <span class="add-on">标签</span>
				         <input type="text" class="span9" placeholder="标签内容" name='tags' value="{#article['tags']}">
				      </div>
				      <div class="input-prepend">
				         <span class="add-on">来源</span>
				         <input type="text" class="span9" placeholder="来源内容" name='source' value="{#article['source']}">
				      </div>
				      <div class="input-prepend">
				    	 <div class="controls">
				    	 <span class="add-on">分类</span>
			    	 	 <select id="category_id" name='category_id'> 
								<option value='0'>文章分类</option> 
			    	  			{foreach $categories(key,value)}
									<option name="{@value['category_name']}" value="{@value['id_ark_category']}">{@value['category_name']}</option>
								{/foreach}
						</select>
						  </div>
					  </div>
				<textarea rows="50" cols="30" name="blog_content" id='blog_content'>{#article['blog_content']}</textarea>
				
				</br>
				<button class="btn  btn-primary" type="submit">更改</button>
				<button class="btn" type="button">取消</button>
				</form>
			
			</div>
		</div>
	</div>
	
<script type="text/javascript"> 
//    var editor = new UE.ui.Editor({initialFrameHeight:200,initialFrameWidth:860 }); 
//    editor.render("blog_content");
    //1.2.4以后可以使用一下代码实例化编辑器
    //UE.getEditor('blog_content')
</script> 
<script type="text/javascript">
CKEDITOR.replace( 'blog_content', {
//uiColor: '#14B8C4',
width:860, 
height:200 

});
SyntaxHighlighter.all();
</script>
	</body>
</html>
