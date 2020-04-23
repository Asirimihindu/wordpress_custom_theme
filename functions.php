<?php

function university_files(){
// load css files using wp_enqueue_style wordpress function ,look for two arguments : nick name , location to the file 
	wp_enqueue_script('main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,'1.0',true);
	wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

// add_action (type of instruction or  hook name (specific) , name of the function we create)
add_action('wp_enqueue_scripts','university_files');

function university_features(){

	add_theme_support('title-tag');
	//Menu Setup first arg. is for the framework , 2nd arg. is for the wordpress dashboard
	register_nav_menu('headerMenuLocation','Header Menu Location');
	register_nav_menu('footerLocation1','Footer Location One');
	register_nav_menu('footerLocation2','Footer Location two');
	add_theme_support('post-thumbnails');


}
function university_adjust_queries($query){
//manipulating defaul URL based Queries 
if (!is_admin() AND is_post_type_archive('programme') AND $query->is_main_query()){
	$query->set('orderby','title');
	$query->set('order','ASC'); 
	$query->set('post_per_page',-1); 

}
if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
	$today= date('Ymd');
	$query->set('meta_key','event_date');
	$query->set('orderby','meta_value_num');
	$query->set('order','ASC'); 
	$query->set('meta_query', array(
          array(
            'key'=> 'event_date',
            'compare'=> '>=',
            'value'=> $today,
            'type'=> 'numeric'
          )
        )



	);


}

}

//took the function & action related to custom post(event) to wp-content/mu-plugins , 



add_action('after_setup_theme','university_features');

add_action('pre_get_posts', 'university_adjust_queries');

// redirect subscriber accounts out of admin onto homepage

add_action('admin_init','redirectSubsToFrontend');

function redirectSubsToFrontend(){
 $ourCurrentUser=wp_get_current_user();

 if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){

  wp_redirect(site_url('/'));
  exit;
 }


}

add_action('wp_loaded','noSubsAdminBar');

function noSubsAdminBar(){
 $ourCurrentUser=wp_get_current_user();

 if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){

  show_admin_bar(false);
 }


}

//Customize Login Screen add the url of homepage to logo
add_filter('login_headerurl','ourHeaderUrl');

function ourHeaderUrl(){

	return esc_url(site_url('/'));

}

add_action('login_enqueue_scripts','ourLoginCSS');

function ourLoginCSS(){

   wp_enqueue_style('university_main_styles', get_stylesheet_uri()); 
   wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

}

// Customize Login title 

add_filter('login_headertitle','ourLoginTitle');

function ourLoginTitle() {

 return get_bloginfo('name');
}


?>