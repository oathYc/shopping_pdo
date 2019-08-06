<?php
    if(!isset($_SESSION['admin']) || !isset($_SESSION['adminId']) || !$_SESSION['admin'] == 'admin' || !$_SESSION['adminId'] == 1){
        header("Location:login.php");
//        var_dump($_SESSION['admin'],$_SESSION['adminId']);die;
    }
?>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
	<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			栏目
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">切换导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#" style="font-size:24px">
				后台管理	</a>		</div>

<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown ">
<a href="#">设置</a></li>
        <li><a href="logout.php">注销</a></li>
	</ul>
	  </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>