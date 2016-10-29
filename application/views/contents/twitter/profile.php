		    <h3 class="text-muted">Twitter HS</h3>
		  </div>
		  <div class="jumbotron">
			    <h1><?php echo $_SESSION['screen_name'] ?></h1>
			    <p class="lead"><?php echo $_SESSION['location'] ?></p>
			    <p><small><?php echo $_SESSION['description'] ?></small></p>
			    <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
			</div>
			<div class="row marketing">
				<div class="col-lg-2">
					<p>Followings <?php echo $_SESSION['friends_count'] ?></p>
				</div>
				<div class="col-lg-2">
					<p>Followers <?php echo $_SESSION['followers_count'] ?></p>
				</div>
				<div class="col-lg-3">
					<button class="btn btn-md btn-info" href="#" role="button" ng-click="unfollowBooster()">Unfollow booster</button>
				</div>
			</div>
		</div>
	</body>