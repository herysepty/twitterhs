<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  	<meta name="base_url" content="<?=base_url()?>"/>

    <!-- <link rel="icon" href="../../favicon.ico"> -->
    <title>Angular CRUD HS</title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/jumbotron-narrow.css" rel="stylesheet">

	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/angular.min.js"></script>
	<script src="<?=base_url()?>assets/js/angular-route.js"></script>
	<script src="<?=base_url()?>assets/plugins/jvalidation/jquery.validate.min.js"></script>

	<script src="<?=base_url()?>assets/js/validation.custom.js"></script>
	<script src="<?=base_url()?>assets/js/app.js"></script>
	<script src="<?=base_url()?>assets/js/controllers/HomeController.js"></script>
	<script src="<?=base_url()?>assets/js/controllers/DirectiveController.js"></script>
	<script src="<?=base_url()?>assets/js/controllers/UserController.js"></script>
	<script src="<?=base_url()?>assets/js/controllers/TwitterController.js"></script>
	<script src="<?=base_url()?>assets/js/directives/directive.js"></script>
<head>
</head>
	<body ng-app="AppMaster">
		<div class="container">
		  <div class="header clearfix">
		    <nav>
		      <ul class="nav nav-pills pull-right">
		        <li role="presentation" class="active"><a href="#/">Home</a></li>
		        <li role="presentation"><a href="#/user">User</a></li>
		        <li role="presentation">
		        	<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Twitter <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li><a href="#/twitter">Profile</a></li>
	                <li><a href="#/twitter/search/123">Search</a></li>
	               	<li><a href="twitter/login.php">Login</a></li>
	                <li><a href="twitter/logout.php">Logout</a></li>
	                <li role="separator" class="divider"></li>
	                <li class="dropdown-header">Nav header</li>
	                <li><a href="" data-toggle="modal" data-target="#myModal">Modal</a></li>
	              </ul>
		        </li>
		        <li role="presentation" class="dropdown">
	              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Others <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li><a href="#/directive">Directive</a></li>
	                <li role="separator" class="divider"></li>
	                <li class="dropdown-header">Nav header</li>
	                <li><a href="" data-toggle="modal" data-target="#myModal">Modal</a></li>
	              </ul>
	            </li>
		      </ul>
		    </nav>
		    <h3 class="text-muted">Angular</h3>
		  </div>
			<div ng-view></div>
		</div>
	</body>
</html>