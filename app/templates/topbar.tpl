<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Pecan</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active">
									<a href="<!--{ACTION_URL}-->/utilAction/logout">首页</a>
								</li>
							
								
							</ul>
							<form class="navbar-search pull-left" action="">
								<input type="text" class="search-query span2" placeholder="搜索" />
							</form>
							<ul class="nav pull-right">
								<li>
									<a href="<!--{ACTION_URL}-->/articleAction/showarticles?s=0&o=<!--{pagesize}-->">博客主页</a>								</li>
								<li>
									<a href="<!--{ACTION_URL}-->/userAction/profile">{$username}</a></li>
								
								<li><img height="37"  src="{$porpath}"  style="border-radius: 50px;margin-top:5px" width="40" /></li>
								
								<li>
									<a href="<!--{ACTION_URL}-->/utilAction/logout">退出后台</a>								</li>
							</ul>
						</div>
					</div>
				</div>