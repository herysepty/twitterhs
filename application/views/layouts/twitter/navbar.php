<body>
<div class="container">
  <div class="header clearfix">
    <nav>
      <ul class="nav nav-pills pull-right">
        <li role="presentation" class="active"><a href="<?php echo site_url('/') ?>">Home</a></li>
        <li><a href="<?php echo site_url('username/'.$_SESSION['screen_name'])?>">Profile</a></li>
        <li><a href="#">Search</a></li>
        <li><a href="<?php echo site_url('trend') ?>">Trending topic</a></li>
        <li role="presentation">
        	<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Twitter <span class="caret"></span></a>
          <ul class="dropdown-menu">
           	<li><a href="twitter/login.php">Login</a></li>
            <li role="separator" class="divider"></li>
            <!-- <li class="dropdown-header">Nav header</li> -->
            <li><a href="<?php echo site_url() ?>/logout">Logout</a></li>
            <!-- <li><a href="" data-toggle="modal" data-target="#myModal">Modal</a></li> -->
          </ul>
        </li>
        <!-- <li role="presentation" class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Others <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#/directive">Directive</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="" data-toggle="modal" data-target="#myModal">Modal</a></li>
          </ul>
        </li> -->
      </ul>
    </nav>