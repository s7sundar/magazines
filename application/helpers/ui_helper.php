<?php

function view_css()
{
	$CI = &get_instance();
	$config = array(
        'script_dir' => 'assets/js/',
        'style_dir'  => 'assets/css/',
        'cache_dir'  => 'assets/cache/',
        'base_uri'   => base_url(),
        'combine'    => TRUE,
        'minify_css' => FALSE,
        'dev'        => $CI->config->item('disable_compress')
    );

    $CI->carabiner->config($config);
    $combine = $CI->config->item('combine');
    $CI->carabiner->group('combinecss', array('css'=>$combine['css']));

    //display css file
    $CI->carabiner->display('combinecss');


    $minify = $CI->config->item('minify');
    $aCss = $minify['css']['common'];

    $config = array(
        'script_dir' => 'assets/js/',
        'style_dir'  => 'assets/css/',
        'cache_dir'  => 'assets/cache/',
        'base_uri'   => base_url(),
        'combine'    => TRUE,
        'minify_css' => TRUE,
        'dev'        => $CI->config->item('disable_compress')
    );

    $CI->carabiner->config($config);
    $CI->carabiner->group('minifycss', array('css'=>$aCss));

    //display css
    $CI->carabiner->display('minifycss');
}

function view_js()
{
	$CI = &get_instance();
	$config = array(
      'script_dir' => 'assets/js/',
      'style_dir'  => 'assets/css/',
      'cache_dir'  => 'assets/cache/',
      'base_uri'   => base_url(),
      'combine'    => TRUE,
      'minify_js'  => FALSE,
      'dev'        => $CI->config->item('disable_compress')
	);

	$CI->carabiner->config($config);
	$combine = $CI->config->item('combine');
	$CI->carabiner->group('combinejs', array('js'=>$combine['js']));
	$CI->carabiner->display('combinejs');

	$sFolder = $CI->uri->segment(1);
	$sController = $CI->uri->segment(2);
	$sMethod = $CI->uri->segment(3);
	$minify = $CI->config->item('minify');
	$aJs = $minify['js']['common'];

	$config = array(
	    'script_dir' => 'assets/js/',
	    'style_dir'  => 'assets/css/',
	    'cache_dir'  => 'assets/cache/',
	    'base_uri'   => base_url(),
	    'combine'    => TRUE,
	    'minify_js'  => TRUE,
	    'dev'        => $CI->config->item('disable_compress')
	);

	if(isset($minify['js'][$sFolder][$sController]))
	   $aJs = array_merge($aJs, $minify['js'][$sFolder][$sController]);
	else if(isset($minify['js'][$sController]))
	   $aJs = array_merge($aJs, $minify['js'][$sController]);
	else if(isset($minify['js'][$sFolder]))
			$aJs = array_merge($aJs, $minify['js'][$sFolder]);

	$CI->carabiner->config($config);
	$CI->carabiner->group('minifyjs', array('js'=>$aJs));
	$CI->carabiner->display('minifyjs');
}

function left_menu()
{
	$aArray = array();
	
	$aArray['admin'] = array(
		array('label'=>'Admin', 'name'=>'admin', 'link'=>site_url('admin/add'), 'role'=>''),
	);
	
	$CI = &get_instance();
	$sFolder = $CI->uri->segment(1);
	$sController = $CI->uri->segment(2);
	$sFolder = strtolower($sFolder);
	$sController = strtolower($sController);
	$aItems = isset($aArray[$sFolder])?$aArray[$sFolder]:array();

	$sHtml  = '';
	if(!empty($aItems)) {
		$sHtml = '<ul class="nav nav-pills nav-stacked ">';
		foreach ($aItems as $aItem) {
			$sActive = $sController==$aItem['name']?'active':'';
			$sActiveColor = $sController==$aItem['name']?'white':'black';
			$sHtml .= '<li class="border-menu-color '.$sActive.'">';
			$sHtml .= '<a href="'.$aItem['link'].'" class="'.$sActiveColor.'">'.$aItem['label'].'</a>';
		}
		$sHtml .= '</ul>';
	}
	echo $sHtml;
}

function top_menu()
{
	$aArray = array();
	$aArray[] = array('label'=>'Admin','name'=>'admin','link'=>site_url('admin/add'), 'role'=>'');	
	$aArray[] = array('label'=>'Logout','name'=>'logout','link'=>site_url('login/logout'), 'role'=>'');

	$CI = &get_instance();
	$sFolder = $CI->uri->segment(1);
	$sController = $CI->uri->segment(2);
	$menu = '<ul class="nav navbar-nav navbar-right">';

	foreach ($aArray as $aRow) {
		$class = '';
		if($aRow['name']==$sFolder || $aRow['name']==$sController)
			$class='class="active"';


		$menu .= '<li '.$class.'>';
		$menu .= '<a href="'.$aRow['link'].'">'.$aRow['label'].'</a>';
		$menu .= '</li>';
	}
    $menu .= '</ul>';

    echo $menu;
}

function financial_year($date)
{
	$aDate = explode('-', $date);
	$start = $aDate[0];
	$end = $aDate[0];
	if($aDate[1] <= 3) {
		$start = $aDate[0]-1;
	}
	else {
		$end  = $aDate[0]+1;
	}
	return $start.'-'.$end;
}

function financial_year_app($date)
{
	$aDate = explode('/', $date);
	$start = $aDate[2];
	$end = $aDate[2];
	if($aDate[1] <= 3) {
		$start = $aDate[2]-1;
	}
	else {
		$end  = $aDate[2]+1;
	}
	return $start.'-'.$end;
}
