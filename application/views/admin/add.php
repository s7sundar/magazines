<div class="clear">&nbsp;</div>
<form method="post" enctype="multipart/form-data" action="<?php echo site_url('/admin/save'); ?>" id="mag-form" name="mag-form">
  <?php
  if(isset($msg)):
  	$sClass  = $status?'alert-success':'alert-danger';
  	$sAction = $status?'Success':'Error';
  ?>
  <div class="alert <?php echo $sClass; ?> alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></button>
    <strong><?php echo $sAction; ?>!</strong> <?php echo $msg; ?>
  </div>
  <?php endif; ?>

<table class="table table-striped">
  <tr>
    <td>&nbsp;</td>
    <th><label for="mag_date">Month of Publish</label></th>
    <td><input type="text" value="<?php echo date('Y-m-d'); ?>" name="mag_date" class="form-control datepicker" id="mag_date" ></td>
    <th><label for="mag_eng_name">English Name</label></th>
    <td> <input type="text" name="mag_eng_name" class="form-control" id="mag_eng_name" placeholder="Magazine Eng Name"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <th>
      <label for="mag_tamil_title">Tamil Title</label>
    </th>
    <td>
        <input type="text" name="mag_tamil_title" class="form-control" id="mag_tamil_title" placeholder="Magazine Tamil Title">
    </td>
    <th>
        <label for="mag_tamil_desc">Tamil Description</label>
    </th>
    <td>
        <textarea name="mag_tamil_desc" class="form-control" placeholder="Short Tamil Description" id="mag_tamil_desc" row="3"></textarea>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <th>
      <label for="mag_tamil_cover">Cover Image 242x200</label>
    </th>
    <td>
      <input type="file" name="mag_tamil_cover" class="form-control" id="mag_tamil_cover" placeholder="Magazine Cover Image">
    </td>
    <th>
      <label for="mag_file">PDF / Image</label>
    </th>
    <td>
      <input type="file" name="mag_file" class="form-control" id="mag_file" placeholder="Magazine Cover Image">
    </td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <th>
      <label for="mag_file_path">File Path</label>
    </th>
    <td>
      <input type="text" name="mag_file_path" class="form-control" id="mag_file_path" placeholder="Magazine manual uploaded file path">
    </td>
    <th></th>
    <td class="text-center">
      <button type="submit" class="btn btn-primary" id="saveMag"><i class="glyphicon glyphicon-check"></i> <strong>Upload</strong></button>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
