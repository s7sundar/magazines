<!DOCTYPE html>
<html>
<head>
	<title>SattaPanchayat::Magazine</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
	  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.min.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
	<script type="text/javascript">var base_url = '<?php echo base_url(); ?>'; </script>
</head>
</head>
<body>
  <div class="container body-bg no-pad">
  		<div class="col-md-3 sattam-bg hidden-xs hidden-sm">
		  	<div class="input-group pad-top">
		      <input type="text" id="search" class="form-control search" placeholder="Search ...">
		      <span class="input-group-btn">
		        <button class="btn btn-default searchBtn" id="searchBtn" type="button">
		        	<i class="glyphicon glyphicon-search"></i>
		    	</button>
		      </span>
		    </div><!-- /input-group -->
		   <div class="clear">&nbsp;</div>
  			<ul class="sattam-ul">
					<?php foreach ($result as $row): ?>
						<li class="sattam-li">
  						<a href="<?php echo site_url('home/download/'.$row['mag_id'].'/'.$token); ?>"
								 class="link-style"><i class="glyphicon glyphicon-download"></i></a>
  						| <a href="<?php echo base_url($row['mag_file_path']); ?>"
								target="_blank" class="link-style"><i class="glyphicon glyphicon-eye-open"></i></a> |
  						<?php echo $row['mag_eng_name'];  ?>
  					</li>
					<?php endforeach; ?>
  			</ul>
  		</div>
			<div class="col-md-3 sattam-bg-color visible-xs visible-sm hidden-md hidden-lg">
				<div class="input-group pad-top sattam-bg-color">
		      <input type="text" id="search" class="form-control search input-lg" placeholder="Search ...">
		      <span class="input-group-btn">
		        <button class="btn btn-default searchBtn btn-lg" id="searchBtn" type="button">
		        	<i class="glyphicon glyphicon-search"></i>
		    	</button>
		      </span>
		    </div><!-- /input-group -->
			</div>
  		<div class="col-md-9 pad-top">
				<!-- magazines -->
				<?php
						$i=0;
				 		foreach ($result as $row):
				?>
					<div class="col-sm-6 col-xs-12 col-md-4">
				   <div class="thumbnail">
				      <img src="<?php echo base_url($row['mag_tamil_cover']); ?>" >
				      <div class="caption">
				      	 <h3><?php echo $row['mag_eng_name']; ?></h3>
				         <h4><?php echo $row['mag_tamil_title']; ?></h4>
				         <p><?php echo $row['mag_tamil_desc']; ?></p>
				         <p class="text-center">
									 <a href="<?php echo site_url('home/download/'.$row['mag_id'].'/'.$token); ?>"
										 class="btn btn-primary" role="button">
				         	<i class="glyphicon glyphicon-download"></i> Download
								</a> <a href="<?php echo base_url($row['mag_file_path']); ?>"
									target="_blank" class="btn btn-default" role="button">
				         	<i class="glyphicon glyphicon-eye-open"></i> View
				         </a></p>
				      </div>
				   </div>
				</div>
				<?php
						$i++;
						if($i==12):
							break;
						endif;
					endforeach;
				?>
				<!-- magazines end -->
		</div>
  </div>

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/home.js'); ?>"></script>
</body>
</html>
