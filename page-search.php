<?php get_header();?>

<?php

//this the template which shows the search bar in differnet page. user comes here from front-page.php
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
    <form class="search-form" method="get" action="<?php echo esc_url(site_url('/'));?>">
      <div class="search-form-row">
      <input placeholder="What are you looking for" class="s" type="search" name="s">
      <input class="search-submit" type="submit" value="Search">
      </div>
      

    </form>
    </div>

  </div>



<?php }?>

<?php get_footer();?>