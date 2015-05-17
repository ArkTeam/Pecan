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
               {include file="topbar.tpl"}
            </div>
            <div class="row">
                <div class="span3">
                    <div class="well" style="padding: 8px 0;">
                        {include file="slidebar.tpl"}
                    </div>
                </div>
                    <div class="span9">
                    <h1>
                         文章分类
                    </h1>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    类别
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
                          
                             {foreach $categories(key,value)} 
                         	 <tr>
                                <td>
                                    {@value}
                                </td>
                                <td>
                                    Yes
                                </td>
                                <td>
                                    <a href="#" class="view-link">修改</a>
                                </td>
                                <td>
                                    <a href="" class="view-link">删除</a>
                                </td>
                            </tr>
                            {/foreach}
                            <tr>
                            	<td colspan=4><a href="<!--{ACTION_URL}-->/categoryAction/add">添加新分类</a></td>
                            </tr>
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

</script>
    </body>
</html>