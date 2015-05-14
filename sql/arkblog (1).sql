-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 14 日 06:17
-- 服务器版本: 5.6.17
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `arkblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `ark_article`
--

CREATE TABLE IF NOT EXISTS `ark_article` (
  `id_ark_article` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `tags` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `blog_content` text,
  `is_verify` int(1) DEFAULT '0',
  `is_private` int(1) DEFAULT '0',
  `posttime` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_article` (`id_ark_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ark_article`
--

INSERT INTO `ark_article` (`id_ark_article`, `title`, `author`, `author_id`, `tags`, `category_id`, `source`, `blog_content`, `is_verify`, `is_private`, `posttime`, `d_tag`) VALUES
(2, 'php中$_SERVER的参数及说明', 'sven', NULL, 'php', 0, '', '<p><span style="font-size:14px"><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;PHP_SELF&#39;] #当前正在执行脚本的</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">文件</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">名，与 document root相关。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;argv&#39;] #传递给该脚本的参数。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;argc&#39;] #包含传递给</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">程序</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">的命令行参数的个数（如果运行在命令行模式）。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;GATEWAY_INTERFACE&#39;] #服务器使用的 CGI 规范的版本。例如，&ldquo;CGI/1.1&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_NAME&#39;] #当前运行脚本所在服务器主机的名称。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_SOFTWARE&#39;] #服务器标识的字串，在响应请求时的头部中给出。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_PROTOCOL&#39;] #请求</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">页面</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">时通信协议的名称和版本。例如，&ldquo;HTTP/1.0&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;REQUEST_METHOD&#39;] #</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">访问</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">页面时的请求方法。例如：&ldquo;GET&rdquo;、&ldquo;HEAD&rdquo;，&ldquo;POST&rdquo;，&ldquo;PUT&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;QUERY_STRING&#39;] #</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">查询</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">(query)的</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">字符</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">串。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;DOCUMENT_ROOT&#39;] #当前运行脚本所在的文档根目录。在服务器配置文件中定义。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_ACCEPT&#39;] #当前请求的 Accept: 头部的内容。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_ACCEPT_CHARSET&#39;] #当前请求的 Accept-Charset: 头部的内容。例如：&ldquo;iso-8859-1,*,utf-8&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_ACCEPT_ENCODING&#39;] #当前请求的 Accept-Encoding: 头部的内容。例如：&ldquo;gzip&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_ACCEPT_LANGUAGE&#39;]#当前请求的 Accept-Language: 头部的内容。例如：&ldquo;en&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_CONNECTION&#39;] #当前请求的 Connection: 头部的内容。例如：&ldquo;Keep-Alive&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_HOST&#39;] #当前请求的 Host: 头部的内容。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_REFERER&#39;] #链接到当前页面的前一页面的 URL 地址。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTP_USER_AGENT&#39;] #当前请求的 User_Agent: 头部的内容。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;HTTPS&#39;] &mdash; 如果通过https访问,则被设为一个非空的值(on)，否则返回off</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;REMOTE_ADDR&#39;] #正在浏览当前页面用户的 IP 地址。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;REMOTE_HOST&#39;] #正在浏览当前页面用户的主机名。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;REMOTE_PORT&#39;] #用户连接到服务器时所使用的端口。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SCRIPT_FILENAME&#39;] #当前执行脚本的绝对路径名。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_ADMIN&#39;] #管理员信息</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_PORT&#39;] #服务器所使用的端口</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SERVER_SIGNATURE&#39;] #包含服务器版本和虚拟主机名的字符串。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;PATH_TRANSLATED&#39;] #当前脚本所在文件</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">系统</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">（不是文档根目录）的基本路径。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;SCRIPT_NAME&#39;] #包含当前脚本的路径。这在页面需要指向自己时非常有用。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;REQUEST_URI&#39;] #访问此页面所需的 URI。例如，&ldquo;/index.</span><span style="color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">html</span><span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">&rdquo;。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;PHP_AUTH_USER&#39;] #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;PHP_AUTH_PW&#39;] #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码。</span><br />\r\n<span style="background-color:rgb(221, 237, 251); color:rgb(102, 102, 102); font-family:hiragino sans gb,microsoft yahei,微软雅黑,stheiti,wenquanyi micro hei,simsun,sans-serif">$_SERVER[&#39;AUTH_TYPE&#39;] #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认证的类型。</span></span></p>\r\n', 0, 0, 1429615422, 0),
(3, 'PHP Sessions', NULL, NULL, 'php', 0, 'http://www.w3school.com.cn/', '<p><strong>PHP session 变量用于存储有关用户会话的信息，或更改用户会话的设置。Session 变量保存的信息是单一用户的，并且可供应用程序中的所有页面使用。</strong></p>\r\n\r\n<p>PHP Session 变量</p>\r\n\r\n<p>当您运行一个应用程序时，您会打开它，做些更改，然后关闭它。这很像一次会话。计算机清楚你是谁。它知道你何时启动应用程序，并在何时终止。但是在因特网上，存在一个问题：服务器不知道你是谁以及你做什么，这是由于 HTTP 地址不能维持状态。</p>\r\n\r\n<p>通过在服务器上存储用户信息以便随后使用，PHP session 解决了这个问题（比如用户名称、购买商品等）。不过，会话信息是临时的，在用户离开网站后将被删除。如果您需要永久储存信息，可以把数据存储在数据库中。</p>\r\n\r\n<p>Session 的工作机制是：为每个访问者创建一个唯一的 id (UID)，并基于这个 UID 来存储变量。UID 存储在 cookie 中，亦或通过 URL 进行传导。</p>\r\n\r\n<p>开始 PHP Session</p>\r\n\r\n<p>在您把用户信息存储到 PHP session 中之前，首先必须启动会话。</p>\r\n\r\n<p><strong>注释：</strong>session_start() 函数必须位于 &lt;html&gt; 标签之前：</p>\r\n\r\n<p>&lt;?php session_start(); ?&gt; &lt;html&gt; &lt;body&gt; &lt;/body&gt; &lt;/html&gt;</p>\r\n\r\n<p>上面的代码会向服务器注册用户的会话，以便您可以开始保存用户信息，同时会为用户会话分配一个 UID。</p>\r\n\r\n<p>存储 Session 变量</p>\r\n\r\n<p>存储和取回 session 变量的正确方法是使用 PHP $_SESSION 变量：</p>\r\n\r\n<p>&lt;?php session_start(); // store session data $_SESSION[&#39;views&#39;]=1; ?&gt; &lt;html&gt; &lt;body&gt; &lt;?php //retrieve session data echo &quot;Pageviews=&quot;. $_SESSION[&#39;views&#39;]; ?&gt; &lt;/body&gt; &lt;/html&gt;</p>\r\n\r\n<p>输出：</p>\r\n\r\n<p>Pageviews=1</p>\r\n\r\n<p>在下面的例子中，我们创建了一个简单的 page-view 计数器。isset() 函数检测是否已设置 &quot;views&quot; 变量。如果已设置 &quot;views&quot; 变量，我们累加计数器。如果 &quot;views&quot; 不存在，则我们创建 &quot;views&quot; 变量，并把它设置为 1：</p>\r\n\r\n<p>&lt;?php session_start(); if(isset($_SESSION[&#39;views&#39;])) $_SESSION[&#39;views&#39;]=$_SESSION[&#39;views&#39;]+1; else $_SESSION[&#39;views&#39;]=1; echo &quot;Views=&quot;. $_SESSION[&#39;views&#39;]; ?&gt;</p>\r\n\r\n<p>终结 Session</p>\r\n\r\n<p>如果您希望删除某些 session 数据，可以使用 unset() 或 session_destroy() 函数。</p>\r\n\r\n<p>unset() 函数用于释放指定的 session 变量：</p>\r\n\r\n<p>&lt;?php unset($_SESSION[&#39;views&#39;]); ?&gt;</p>\r\n\r\n<p>您也可以通过 session_destroy() 函数彻底终结 session：</p>\r\n\r\n<p>&lt;?php session_destroy(); ?&gt;</p>\r\n\r\n<p><strong>注释：</strong>session_destroy() 将重置 session，您将失去所有已存储的 session 数据。</p>\r\n', 0, 0, 1431318410, 0),
(4, 'arkphp  assign', NULL, NULL, 'arkphp', 0, '', '<pre class="brush:php;">\r\n	//assign()方法，用于注入变量\r\n	public function assign($_var, $_value) {\r\n		if (isset ( $_var ) &amp;&amp; ! empty ( $_var )) {\r\n			//$this-&gt;_vars[&#39;name&#39;]\r\n			$this-&gt;_vars [$_var] = $_value;\r\n				\r\n		} else {\r\n			exit ( &#39;ERROR：PLZ SET TPL VARS&#39; );\r\n		}\r\n	}</pre>\r\n\r\n<p>&nbsp;</p>\r\n', 0, 0, 1431333035, 0),
(5, 'ark php', NULL, NULL, 'foreach', 0, '', '<pre class="brush:php;">\r\n\r\n嵌套循环\r\n\r\n{foreach $articles(key,value)} \r\n	{foreach #value(v_key,v_value)} \r\n		{@v_value}\r\n	{/foreach}\r\n{/foreach}\r\n\r\n\r\n{foreach $articles(key,value)} \r\n	{foreach #value(v_key,v_value)} \r\n		{@v_value[&#39;title&#39;]}\r\n	{/foreach}\r\n{/foreach}\r\n\r\n{foreach $articles(key,value)} \r\n \r\n		{@value[&#39;title&#39;]}\r\n\r\n{/foreach}\r\n\r\n{foreach $categories(key,value)}   / /没有键，像普通数组一样{[0],[1],[2].....}\r\n                \r\n               {@value}\r\n{/foreach}\r\n</pre>\r\n', 0, 0, 1431333254, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ark_category`
--

CREATE TABLE IF NOT EXISTS `ark_category` (
  `id_ark_category` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `category_name` varchar(20) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_catetory` (`id_ark_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ark_category`
--

INSERT INTO `ark_category` (`id_ark_category`, `parent_id`, `category_name`, `d_tag`) VALUES
(1, NULL, 'java', NULL),
(2, NULL, 'php', NULL),
(3, NULL, 'python', NULL),
(4, NULL, 'c', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ark_update_file`
--

CREATE TABLE IF NOT EXISTS `ark_update_file` (
  `id_ark_update_file` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(20) DEFAULT NULL,
  `path` varchar(20) DEFAULT NULL,
  `upload_time` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_update_file` (`id_ark_update_file`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ark_upload_pic`
--

CREATE TABLE IF NOT EXISTS `ark_upload_pic` (
  `id_ark_upload_pic` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `path` varchar(20) DEFAULT NULL,
  `upload_time` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_upload_pic` (`id_ark_upload_pic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ark_user`
--

CREATE TABLE IF NOT EXISTS `ark_user` (
  `id_ark_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `portraitpath` varchar(100) NOT NULL,
  `regtime` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_user` (`id_ark_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `ark_user`
--

INSERT INTO `ark_user` (`id_ark_user`, `username`, `password`, `portraitpath`, `regtime`, `d_tag`) VALUES
(1, 'sven', '123', '', NULL, NULL),
(28, '11', '11', '7788', 1431411611, 0),
(29, '', '', '/.', 1431411625, 0),
(31, 'qwe', '123', 'http://localhost/Pecan/app/public/i_upload/screenshots_5d41402abc4b2a76b9719d911017c592_small.jpg', 1431523807, 0),
(32, 'qqq', '11', 'http://localhost/Pecan/app/public/i_upload/screenshots_qwe_small.jpg', 1431581781, 0),
(33, 'ww', '12', 'http://localhost/Pecan/app/public/i_upload/screenshots_qwe_small.jpg', 1431581943, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
