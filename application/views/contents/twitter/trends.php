	    	<h3 class="text-muted">Twitter HS</h3>
	  	</div>
	 	<div class="row">
			<div class="col-md-4">
				<h1><?php echo $trends[0]->locations[0]->name ?></h1>
				<?php
					foreach ($trends[0]->trends as $key => $value) {
						echo "<p>".$value->name."</p>";		
					}
				?>
			</div>
			<div class="col-md-4">
				<h1><?php echo $trends_jakarta[0]->locations[0]->name ?></h1>
				<?php
					foreach ($trends_jakarta[0]->trends as $key => $value) {
						echo "<p>".$value->name."</p>";		
					}
				?>
			</div>
			<div class="col-md-4">
				<h1><?php echo $trends_indonesia[0]->locations[0]->name ?></h1>
				<?php
					foreach ($trends_indonesia[0]->trends as $key => $value) {
						echo "<p>".$value->name."</p>";		
					}
				?>
			</div>
	  	</div>
	</div>
</body>