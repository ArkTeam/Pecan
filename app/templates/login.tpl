<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    {include file="header.tpl"}
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
 </head>
 
    <body>
    <div class="container">
      <form class="form-signin" action="<!--{ACTION_URL}-->/userAction/login" method="post" >
        <h3 class="form-signin-heading" align="center">Pecan</h3>
        <input type="text" class="input-block-level" placeholder="用户名" name='username'>
        <input type="password" class="input-block-level" placeholder="密码" name='password'>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 记住我
        </label>
 
        <button class="btn  btn-primary" type="submit">登录</button>
        <a href='<!--{ACTION_URL}-->/Index/register'><button class="btn  btn-primary" type="button">注册</button></A>
      </form>


      </div>
  </body>
</html>