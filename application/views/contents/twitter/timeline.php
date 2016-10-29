	    	<h3 class="text-muted">Twitter HS</h3>
	  	</div>
	 	<div class="row">
			<div class="col-md-12">
				<?php
					foreach ($timelines as $key => $value) {
						echo "<p>".$value->user->screen_name." ".$value->text."</p>";		
					}
						// echo "<pre>";
						// print_r($timelines);
						// echo "</pre>";
				?>
			</div>
	  	</div>
	</div>
</body>