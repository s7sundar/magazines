<?php

$config['company_name'] = 'TROFEO SOLUTIONS';
$config['project_name'] = 'SATTAM ORG';
$config['version'] = '1.0';
$config['disable_compress'] = true;

$config['combine']  =array(
		'js' => array(
				array('jquery.min.js'),
				array('bootstrap.min.js'),
				array('jquery.dataTables.min.js'),
				array('jquery-ui.min.js'),
				array('jquery.validate.min.js'),
			//	array('app.min.js'),
			//	array('demo.js'),
				//array('angular.min.js'),
		),
		'css' => array(
				array('bootstrap.min.css'),
				array('jquery-ui.min.css'),
				array('DataTables/css/jquery.dataTables.min.css'),
			//	array('ionicons.css'),
			//	array('ionicons.min.css'),
		)
);

$config['minify']['css'] = array(
		'common'=>array(
				array('style.css'),
				array('colorbox.css'),
		),
		'dashboard'=>array(
				array('adminlte.min.css'),
				array('all-skins.min.css'),
		),
);

$config['minify']['js'] = array(
		'common'=> array(
				array('jquery.colorbox.js'),
				/*array('jquery.newsTicker.js'),*/
				array('config.js'),
				/*array('sidebar.js')*/
		),
		'masters' => array(
			//contoller js files
			/*'controller' => array(array('js files')),*/
		),
		//controller names
		'controller'=>array(
			array('js files')
		),
		'admin'=>array(
			array('admin.js')
		)
);
