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
                    <h5>
                         文章分类
                    </h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
 
                                <th>
                                    类别
                                </th>
                                 <th>
                                    文章数目
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
                                    {@value['category_name']}
                                </td>
	                                <td>
	                                    {@value['artcounts']}
	                                </td>
                                <td>
                                    Yes
                                </td>
                                <td>
                                    <a href="<!--{ACTION_URL}-->/categoryAction/update?category_id={@value['id_ark_category']}" >修改</a>
                                </td>
                                <td>
                                    <a href="<!--{ACTION_URL}-->/categoryAction/del?category_id={@value['id_ark_category']}" class="view-link">删除</a>
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
                        {if $is_prev}
                            <li class="disabled">
                                <a href="<!--{ACTION_URL}-->/categoryAction/showCategory?pages={$pages - 1}">&laquo;</a>
                            </li>
                         {/if}
                            {foreach $counts(key,value)}
                            <li class="active">
                                <a href="<!--{ACTION_URL}-->/categoryAction/showCategory?pages={@value}">{@value}</a>
                            </li>
                           {/foreach}
                          {if $is_next}
                            <li>
                                <a href="<!--{ACTION_URL}-->/categoryAction/showCategory?pages={$pages + 1}">&raquo;</a>
                            </li>
                           {/if}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">

</script>
    </body>
</html>