
 <!DOCTYPE HTML>
<html >
<head>
  <meta charset="UTF-8">
  
    <title>Simple</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, minimum-scale=1">
    
    <meta name="author" content="Ark Lee">
    
    <meta name="description" content="Enjoy it.">
    

    <link rel="icon" href="<?php echo $this->_config['PUBLIC_PATH'];?>/img/favicon.ico">
    
    
    <link rel="apple-touch-icon" href="img/Tinny.jpg">
    <link rel="apple-touch-icon-precomposed" href="img/Tinny.jpg">
    
    <link rel="stylesheet" href="<?php echo $this->_config['PUBLIC_PATH'];?>/css/style.css" type="text/css">

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
						<li><a href="<?php echo $this->_config['ACTION_URL'];?>/userAction/admin">后台</a></li>
						
						<li><a href="/">关于我</a></li>
					
					<li>
					
					</li>
                <li><div class="closeaside"><a class="closebutton" href="#" title="Hide Sidebar"></a></div></li>

				</ul>
			</nav>	
</div>

    </header>
    <div id="container" class="clearfix">
      <div id="main">
    <?php foreach ($this->_vars['articles'] as $key=>$value) { ?> 
  <section class="post" itemscope itemprop="blogPost">
    
  <article>
    <h1 itemprop="name">
      
        <a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showanarticle?article_id=<?php echo $value['id_ark_article']?>" title="Hadoop 入门" itemprop="url">
      
       <?php echo $value['title']?>
      </a>
    </h1>
    
     
<p itemprop="description" >
<?php echo $value['blog_content']?>
 </p>
        
    
    <p class="article-more-link">
      <time datetime="<?php echo $value['posttime']?>" itemprop="datePublished"><?php echo $value['posttime']?></time>
      
          <a href="<?php echo $this->_config['ACTION_URL'];?>/articleAction/showanarticle?article_id=<?php echo $value['id_ark_article']?>">阅读更多&raquo;</a>
    </p>

  </article>
</section>
      
<?php } ?>
 

<nav id="page-nav" class="clearfix">
    <a class="extend prev" rel="prev" href="/page/2/">« Prev</a><span class="page-number current">1</span><a class="page-number" href="/page/2/">2</a><a class="page-number" href="/page/3/">3</a><span class="space">…</span><a class="page-number" href="/page/5/">5</a><a class="extend next" rel="next" href="/page/2/">Next »</a>
</nav>
</div>

<div id="asidepart">
<div id="authorInfo">
	
		<div class="author-logo"></div>		

	 <section class="author-info">
    
      <p> 缘起性空</p>
    
   </section>

	<div class="social-font" class="clearfix">

		<a href="http://weibo.com/arkphp" target="_blank" title="weibo"></a>

    <a href="https://github.com/lfzark" target="_blank" title="github"></a>
		
		
		
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
		
			<li><a href="tags/Hadoop/" title="Hadoop">Hadoop<sup>1</sup></a></li>
		
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







  </body>
 </html>
