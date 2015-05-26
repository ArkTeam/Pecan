<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
    <head>
        <title>ArkBlog</title>
        {include file="header.tpl"}
        <script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/ckeditor.js"></script>
        <script src="<!--{PUBLIC_PATH}-->/plugin/ckeditor/adapters/jquery.js"></script>

        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        
        <style type="text/css">

      .form-add {
        max-width: 67.5%;
        padding: 19px 29px 29px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-add input[type="text"]{
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
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
                  	       修改分类
                    </h1>
              		<div class="container">
              		<form class="form-add" action="<!--{ACTION_URL}-->/categoryAction/updateCategory">
	       				<input class="input-block-level" type="text"  placeholder="类名" name='categoryname'/>
	              		<input class="btn  btn-primary" type="submit" value="确定"/>
              		</form>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">

</script>
    </body>
</html>