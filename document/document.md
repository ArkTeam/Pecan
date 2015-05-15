配置安装以及开发文档
--------------------
* 简介
* 标签

标签
----
* 对象
* 循环
* 嵌套循环
* 循环嵌套 if-else

```PHP
对象
----
//对象成员变量
{#value['title']}

循环
----

//循环变量
{foreach $articles(key,value)} 
		{@value}
{/foreach}

//循环对象成员变量
{foreach $articles(key,value)} 
		{@value['title']}
{/foreach}



嵌套循环
--------
//嵌套循环变量
{foreach $articles(key,value)} 
	{foreach #value(v_key,v_value)} 
		{@v_value}
	{/foreach}
{/foreach}

//嵌套循环对象成员变量
{foreach $articles(key,value)} 
	{foreach #value(v_key,v_value)} 
		{@v_value['title']}
	{/foreach}
{/foreach}



嵌套循环if-else
---------------
{foreach $articles(key,value)} 
		{if @value['title'] }
		{else}
		{/if}
{/foreach}


```
