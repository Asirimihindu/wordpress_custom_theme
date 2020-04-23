<?php get_header();?>

<?php

//Wordpress has lots of pre-built functions
// if wordpress function start with get_ then it returns a value ,therefore echo is needed  
// if wordpress function start with 'the_' then it means echo is handled within the function therefore echo is not needed  
//This is to display the page according to url
while (have_posts()) {

	the_post(); ?> 


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg');?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title();?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
<?php
//get_the_ID() returns the ID of the current post  
$theParent= wp_get_post_parent_id(get_the_ID());

if ($theParent) { ?> 
  
 <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title();?></span></p>
    </div>

 <?php } ?>  
 <?php
 $testArray= get_pages(array(
  
       'child_of'=>get_the_ID()
 ));

if($theParent or $testArray){ ?> 
    
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>"><?php echo get_the_title($theParent);?></a></h2>
      <ul class="min-list">
       <?php

       if ($theParent){
       $findChildrenOf=$theParent; 

       } else {

       	$findChildrenOf=get_the_ID(); 

       }
       wp_list_pages(array( 
          'title_li'=> NuLL,
           'child_of'=> $findChildrenOf,
           'sort_column'=> 'menu_order'

       ));

       ?>
      </ul>
    </div>
 
 <?php } ?> 

    <div class="generic-content">
    <?php the_content();?> 
    </div>

  </div>



<?php }?>

<?php get_footer();?>