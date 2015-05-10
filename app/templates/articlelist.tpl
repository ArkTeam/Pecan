<html><head>
<meta charset="utf-8">
<title>ArkBlog</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link href="<!--{PUBLIC_PATH}-->/css/base.css" rel="stylesheet">
<link href="<!--{PUBLIC_PATH}-->/css/style.css" rel="stylesheet">
<link href="<!--{PUBLIC_PATH}-->/css/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="<!--{PUBLIC_PATH}-->/js/modernizr.js"></script>
<![endif]-->

<body>
<div class="ibody">
  <header>
    <h1>Ark Blog</h1>
    <h2>专注于技术和艺术。 Knowledge is a treasure, but practice is the key to it</h2>
    
    <nav id="topnav"><a href="<!--{ACTION_URL}-->/articleAction/showarticles">首页</a><a href="<!--{ACTION_URL}-->/articleAction/showarticles" id="topnav_current">Blogs</a>
    <a href="<!--{ACTION_URL}-->/userAction/admin" >进入后台</a>
    </nav>
  </header>
  <article>
  
    <h2 class="about_h">您现在的位置是：<a href="/">首页</a>&gt;<a href="<!--{ACTION_URL}-->/articleAction/showarticles">慢生活</a></h2>
    <div class="bloglist">
     {foreach $articles(key,value)} 	
	<div class="bloglist">
      <div class="newblog">
        <ul>
          <h3><a href="<!--{ACTION_URL}-->/articleAction/showanarticle?article_id={@value['id_ark_article']}">{@value['title']}</a></h3>
          <div class="autor"><span>作者：{@value['author']}</span><span>分类：[<a href="/">{@value['category_id']}</a>]</span><span>浏览（<a href="/">459</a>）</span><span>评论（<a href="/">30</a>）</span></div>
          <p>{@value['blog_content']}</p> <a href="/" target="_blank" class="readmore">全文</a></p>
        </ul>
        <figure><img src="<!--{PUBLIC_PATH}-->/img/001.jpg"></figure>
        <div class="dateview">{@value['posttime']}</div>
      </div>
      
{/foreach}
    <div class="page"><a title="Total record"><b>&lt;&lt;</b></a><b>1</b><a href="/">2</a><a href="/">3</a><a href="/">4</a><a href="/">5</a><a href="/">&gt;</a><a href="/">&gt;&gt;</a></div>
  </article>
  <aside>
    
    <div class="copyright">
      <ul>
        Powered By ArkPHP
        <p></p>
      </ul>
    </div>
  </aside>
  <script src="js/silder.js"></script>
  <div class="clear"></div>
 
</div>


</body></html>