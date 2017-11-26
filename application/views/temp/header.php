<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $this->config->item('company_name'); ?></title>
    <script type="text/javascript"> var base_url = '<?php echo base_url(); ?>'</script>

    <?php echo view_css(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="border-bottom:3px solid #ef3939;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo current_url(); ?>">
          <span class="label label-danger"><i class="glyphicon glyphicon-send"></i></span> <strong>
          <?php echo $this->config->item('project_name'); ?></strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">          
          <?php top_menu(); ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="top-pad">&nbsp;</div>
    <div class="col-md-2 left-menu">
      <?php left_menu(); ?>
    </div>
    <div class="col-md-10">
    <div class="col-md-12">
      <div class="col-md-9"><font size="+2"><?php echo $title; ?></font></div>
      <div class="col-md-3 text-right">
        <?php 
          if(!isset($hideAddNew)): 
            $sAddClass = $sActive=='add'?'btn-primary':'btn-default';
            $sViewClass = $sActive!='add'?'btn-primary':'btn-default';
        ?>
        <div class="btn-group">
          <a href="<?php echo $sURLAdd; ?>" class="btn <?php echo $sAddClass; ?> btn-sm"><strong><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add&nbsp;</strong></a>
          <a href="<?php echo $sURLView; ?>"  class="btn <?php echo $sViewClass; ?> btn-sm"><strong><i class="glyphicon glyphicon-list"></i>&nbsp;List&nbsp;</strong></a>
        </div>
        <?php endif;  ?>
      </div>
    </div>