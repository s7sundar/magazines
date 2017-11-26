<!DOCTYPE html>
<html>
<head>
	<title>SattaPanchayat::Magazine</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
</head>
</head>
<body class="body-bg">
  <div class="container no-pad">
  		<div class="col-md-1">&nbsp;</div>
  		<div class="col-md-10 pad-top white-bg">
  			<div class="col-md-12" style="border-bottom: 4px solid 	#DC143C; padding-bottom: 2px;">
  			<div class="col-md-8">
  				<img src="<?php echo base_url('assets/images/sattapanchayat-logo.png'); ?>" />
  			</div>
  			<div class="col-md-4">
  				<div class="input-group pad-top">
			      <input type="text" class="form-control" placeholder="Search ...">
			      <span class="input-group-btn">
			        <button class="btn btn-primary" type="button">
			        	<i class="glyphicon glyphicon-search"></i>
			    	</button>
			      </span>
		    	</div><!-- /input-group -->
  			</div>
  			</div>

  			<div class="clear">&nbsp;</div>
  			
  			<?php for($j=1; $j<=2; $j++): ?>

  			<div class="col-md-6">
  				<?php for($i=0; $i<11; $i++): ?>
	  			<div class="media">
				  <div class="media-left">
				    <a href="#">

				      <?php if($i%2==0 && $i >0): ?>
				      	<img class="media-object" src="<?php echo base_url('assets/thumbs/spi_magazine-jun_20174-128.jpg'); ?>" />
				      <?php elseif ($i%3==0): ?>
				      	<img class="media-object" src="<?php echo base_url('assets/thumbs/spi_magazine-jun_201712-128.jpg'); ?>" />
				      <?php else: ?>
				      	<img class="media-object" src="<?php echo base_url('assets/thumbs/spi-magazine-jun-20171-128.jpg'); ?>" />
				      <?php endif; ?>
				      
				    </a>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading">SPI Megazine November 2017</h4>
				    உள்ளாட்சி இனி உங்களாட்சி! கிராம சபைகளை வலுப்படுத்தும் முயற்சியில் சட்டப்பஞ்சாயத்து இயக்கம்  சட்டப்பஞ்சாயத்து இயக்கம்  இயக்கம் 
				    <div class="col-md-12 text-center sattam-border-2px">
				    <button class="btn btn-primary btn-xs">
				    	<i class="glyphicon glyphicon-download"></i> Download
				    </button>
				     <button class="btn btn-default btn-xs">
				    	<i class="glyphicon glyphicon-eye-open"></i> View
				    </button>
				    </div>
				  </div>
				</div>
			<?php endfor; ?>
			</div>

		<?php endfor; ?>
			<div class="clear"> &nbsp; </div>
		</div>
		<div class="col-md-1">&nbsp;</div>
  </div>
</body>
</html>
