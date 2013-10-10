<?php


/**
 * 
 */

define('ABSPATH', '/Applications/MAMP/htdocs/');
define('SITEURL', 'http://localhost:8888/');
define('SITEASSETS', '.sbconfig/assets/');

function get_project_dirs(){
	$projects = new RecursiveDirectoryIterator( ABSPATH );
	foreach ($projects as $project){
		$dir = $project->isDir();
		if($dir){
			$sites[] = $project->getFileInfo(); 
		}
	}
	return $sites;
}

function list_projects(){
	
	$projects = new RecursiveDirectoryIterator( ABSPATH );

	echo '<ul>';
	
	foreach ($projects as $project){
		
		$dir = $project->isDir();
		
		if($dir){
			
			echo '<li class="col-md-4">';
			
			echo '<a class="project-url" href="'. SITEURL . $project->getFileName().'">';

			check_icon( $project->getRealPath() );
			
			echo  '<span class="project-title">' . $project->getFileName() . '</span>';

			echo '</a>';
			
			check_wp( $project->getRealPath() );

			echo '</li>'; 
		
		}
	}
	
	echo '</ul>';
}

function check_icon( $path ){
	
	$icons = array('apple-touch-icon.png', 'favicon.ico');
	
	foreach($icons as $icon){
		
		$file = $path . '/' . $icon;
		
		$dir = basename($path);

		if( file_exists( $file ) ){
			
			echo '<img class="site-icon" src="'. SITEURL . $dir .'/'. $icon . '" />';
			
			return;

		} else {

			echo '<img class="site-icon" src="'. SITEURL . SITEASSETS .'img/apple-touch-icon.png" />';

			return;

		}
	}
}

function check_wp($path){
	
	$wp = $path . '/wp-admin';
	
	$dir = basename($path);

	if( is_dir( $wp ) ){
		
		echo '<a class="cms-url" href="' . SITEURL . $dir .'/wp-admin/"><img class="cms-logo" src="' . SITEURL . SITEASSETS . 'img/wordpress.png" /></a>';
	
	}
}



