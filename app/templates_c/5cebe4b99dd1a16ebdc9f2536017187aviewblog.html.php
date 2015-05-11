
 <!DOCTYPE HTML>
<html >
<head>
  <meta charset="UTF-8">
  
    <title>Hello World | Simple</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, minimum-scale=1">
    
    <meta name="author" content="Ark Lee">
    
    <meta name="description" content="Welcome to Hexo! This is your very first post. Check documentation for more info. If you get any problems when using Hexo, you can find the answer in ">
    
    
    
    
    
    <link rel="icon" href="<?php echo $this->_config['PUBLIC_PATH'];?>/img/favicon.ico">
    
    
    <link rel="apple-touch-icon" href="<?php echo $this->_config['PUBLIC_PATH'];?>/img/Tinny.jpg">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $this->_config['PUBLIC_PATH'];?>/img/Tinny.jpg">
    
    <link rel="stylesheet" href="<?php echo $this->_config['PUBLIC_PATH'];?>/css/style.css" type="text/css">
    <link type="text/css" rel="stylesheet" href="<?php echo $this->_config['PUBLIC_PATH'];?>/plugin/shCoreDefault.css"/>
    <script src="<?php echo $this->_config['PUBLIC_PATH'];?>/plugin/shCore.js"></script>
    <script src="<?php echo $this->_config['PUBLIC_PATH'];?>/plugin/syntaxhighlighter.js"></script>
</head>

  <body>
    <header>
      <div>
		
			<div id="textlogo">
				<h1 class="site-name"><a href="/" title="Simple">Simple</a></h1>
				<h2 class="blog-motto"></h2>
			</div>
			<div class="navbar"><a class="navbutton navmobile" href="#" title="Menu">
			</a></div>
			<nav class="animated">
				<ul>
                    <ul>
					 
						<li><a href="<?php echo $this->_config['ACTION_URL'];?>">首页</a></li>
					
						<li><a href="/archives">归档</a></li>
					
						<li><a href="http://www.cnblogs.com/lfzark/">博客园</a></li>
					
						<li><a href="http://lfzark.github.io/">Page</a></li>
					
						<li><a href="/">关于我</a></li>
					
					<li>
					
					</li>
                <li><div class="closeaside"><a class="closebutton" href="#" title="Hide Sidebar"></a></div></li>

				</ul>
			</nav>	
</div>

    </header>
    <div id="container" class="clearfix">
      <div id="main" class="post" itemscope itemprop="blogPost">
	<article itemprop="articleBody"> 
		<header class="article-info clearfix">
  <h1 itemprop="name">
    
      <a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showanarticle?article_id=<?php echo $this->_vars['article']->id_ark_article;?>" title="Hello World" itemprop="url"><?php echo $this->_vars['article']->title;?></a>
  </h1>
  <p class="article-author">By
    
      <a href="#" title="Ark Lee"><?php echo $this->_vars['article']->author;?></a>
    </p>
  <p class="article-time">
    <time datetime="2014-08-27T08:22:01.000Z" itemprop="datePublished"><?php echo $this->_vars['article']->posttime;?></time>
    Updated:<time datetime="2014-08-27T08:22:01.000Z" itemprop="dateModified"><?php echo $this->_vars['article']->posttime;?></time>
    
  </p>
</header>
	<div class="article-content">
		<?php echo $this->_vars['article']->blog_content;?><footer class="article-footer clearfix">




<div class="article-share" id="share">

  <div data-url="http://yoursite.com/2014/08/27/hello-world/" data-title="Hello World | Simple" data-tsina="null" class="share clearfix">
  </div>

</div>
</footer>   	       
	</article>
	
<nav class="article-nav clearfix">
 <?php if ($this->_vars['is_prev']) {?>
 <div class="prev" >
 <a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showanarticle?article_id=<?php echo $this->_vars['prev_article']->id_ark_article;?>" <?php echo $this->_vars['prev_article']->title;?>">
  <strong>PREVIOUS:</strong><br/>
  <span>
  <?php echo $this->_vars['prev_article']->title;?></span>
</a>
</div>
	
 <?php } ?>
 
 <?php if ($this->_vars['is_next']) {?>
 <div class="next" >
 <a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showanarticle?article_id=<?php echo $this->_vars['next_article']->id_ark_article;?>" title="<?php echo $this->_vars['next_article']->title;?>">
  <strong>NEXT:</strong><br/>
  <span>
  <?php echo $this->_vars['next_article']->title;?></span>
</a>
</div>
	
 <?php } ?>

</nav>

	
</div>  
      
  <div id="toc" class="toc-aside">
  <strong class="toc-title">Contents</strong>
  <ol class="toc"><li class="toc-item toc-level-2"><a class="toc-link" href="#Quick_Start"><span class="toc-number">1.</span> <span class="toc-text">Quick Start</span></a><ol class="toc-child"><li class="toc-item toc-level-3"><a class="toc-link" href="#Create_a_new_post"><span class="toc-number">1.1.</span> <span class="toc-text">Create a new post</span></a></li><li class="toc-item toc-level-3"><a class="toc-link" href="#Run_server"><span class="toc-number">1.2.</span> <span class="toc-text">Run server</span></a></li><li class="toc-item toc-level-3"><a class="toc-link" href="#Generate_static_files"><span class="toc-number">1.3.</span> <span class="toc-text">Generate static files</span></a></li><li class="toc-item toc-level-3"><a class="toc-link" href="#Deploy_to_remote_sites"><span class="toc-number">1.4.</span> <span class="toc-text">Deploy to remote sites</span></a></li></ol></li></ol>
  </div>

<div id="asidepart">
<div id="authorInfo">
	
		<div class="author-logo"></div>		
	
	
	<div class="social-font" class="clearfix">
		
		
		
		
	</div>
</div>
<aside class="clearfix">


  

  
  <div class="archiveslist">
    <p class="asidetitle"><a href="/archives">Archives</a></p>
      <ul class="archive-list"><li class="archive-list-item"><a class="archive-list-link" href="/archives/2014/09">September 2014</a><span class="archive-list-count">1</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2014/08">August 2014</a><span class="archive-list-count">1</span></li></ul>
  </div>


  
<div class="tagslist">
	<p class="asidetitle">Tags</p>
		<ul class="clearfix">
		
			<li><a href="/tags/Hadoop/" title="Hadoop">Hadoop<sup>1</sup></a></li>
		
		</ul>
</div>


</aside>
</div>
    </div>
    <footer><div id="footer" >

</div>
</footer>
    <script src="<?php echo $this->_config['PUBLIC_PATH'];?>/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
  //back to top
  function backToTop(){
    var buttonHTML = $("<a href=\"#top\" id=\"back-top\">" + "<span>Back to Top</span></a>");
    buttonHTML.appendTo($("body"));
    var buttonToTop = $("#back-top");
    // hide #back-top first
    buttonToTop.hide();

    // fade in #back-top
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                buttonToTop.fadeIn();
            } else {
                buttonToTop.fadeOut();
            }
        });
        // scroll body to 0px on click
        buttonToTop.click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
  }
  backToTop();

  $('.navbar').click(function(){
    $('header nav').toggleClass('shownav');
  });
  var myWidth = 0;
  function getSize(){
    if( typeof( window.innerWidth ) == 'number' ) {
      myWidth = window.innerWidth;
    } else if( document.documentElement && document.documentElement.clientWidth) {
      myWidth = document.documentElement.clientWidth;
    };
  };
  var m = $('#main'),
      a = $('#asidepart'),
      c = $('.closeaside'),
      ta = $('#toc.toc-aside');
  $(window).resize(function(){
    getSize(); 
    if (myWidth >= 1024) {
      $('header nav').removeClass('shownav');
    }else
    {
      m.removeClass('moveMain');
      a.css('display', 'block').removeClass('fadeOut');
      
      $('#toc.toc-aside').css('display', 'none');
        
    }
  });

  var show = true;
  c.click(function(){
    if(show == true){
        a.addClass('fadeOut').css('display', 'none');
        ta.css('display', 'block').addClass('fadeIn');
        m.addClass('moveMain');  
    }else{
        a.css('display', 'block').removeClass('fadeOut').addClass('fadeIn');     
        ta.css('display', 'none'); 
        m.removeClass('moveMain');
        $('#toc.toc-aside').css('display', 'none');
    }
    show = !show;
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){ 
  var ai = $('.article-content>iframe'),
      ae = $('.article-content>embed'),
      t  = $('#toc'),
      h  = $('article h2')
      ah = $('article h2'),
      ta = $('#toc.toc-aside'),
      o  = $('.openaside'),
      c  = $('.closeaside');
  if(ai.length>0){
    ai.wrap('<div class="video-container" />');
  };
  if(ae.length>0){
   ae.wrap('<div class="video-container" />');
  };
  if(ah.length==0){
    t.css('display','none');
  }else{

    $(window).scroll(function(){
      ta.css("top",Math.max(140,240-$(this).scrollTop()));
    });
  };
});
</script>


<script type="text/javascript">
$(document).ready(function(){ 
  var $this = $('.share'),
      url = $this.attr('data-url'),
      encodedUrl = encodeURIComponent(url),
      title = $this.attr('data-title'),
      tsina = $this.attr('data-tsina');
  var html = [
  '<a href="#" class="overlay" id="qrcode"></a>',
  '<div class="qrcode clearfix"><span>扫描二维码分享到微信朋友圈</span><a class="qrclose" href="#share"></a><strong>Loading...Please wait</strong><img id="qrcode-pic" data-src="http://s.jiathis.com/qrcode.php?url=' + encodedUrl + '"/></div>',
  '<a href="#textlogo" class="article-back-to-top" title="Top"></a>',
  '<a href="https://www.facebook.com/sharer.php?u=' + encodedUrl + '" class="article-share-facebook" target="_blank" title="Facebook"></a>',
  '<a href="#qrcode" class="article-share-qrcode" title="QRcode"></a>',
  '<a href="https://twitter.com/intent/tweet?url=' + encodedUrl + '" class="article-share-twitter" target="_blank" title="Twitter"></a>',
  '<a href="http://service.weibo.com/share/share.php?title='+title+'&url='+encodedUrl +'&ralateUid='+ tsina +'&searchPic=true&style=number' +'" class="article-share-weibo" target="_blank" title="Weibo"></a>',
  '<span title="Share to"></span>'
  ].join('');
  $this.append(html);
  $('.article-share-qrcode').click(function(){
    var imgSrc = $('#qrcode-pic').attr('data-src');
    $('#qrcode-pic').attr('src', imgSrc);
    $('#qrcode-pic').load(function(){
        $('.qrcode strong').text(' ');
    });
  });
});     
</script>






  </body>
</html>
