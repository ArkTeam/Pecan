{foreach $articles(key,value)} 	
<div class="bloglist">
      <div class="newblog">
        <ul>
          <h3><a href="/">{@value['title']}</a></h3>
          <div class="autor"><span>作者：{@value['author']}</span><span>分类：[<a href="/">{@value['category_id']}</a>]</span><span>浏览（<a href="/">459</a>）</span><span>评论（<a href="/">30</a>）</span></div>
          <p>{@value['blog_content']}</p> <a href="/" target="_blank" class="readmore">全文</a></p>
        </ul>
        <figure><img src="images/001.jpg"></figure>
        <div class="dateview">{@value['posttime']}</div>
      </div>
      
{/foreach}