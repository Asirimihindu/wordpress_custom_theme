<?php get_header();?>

<?php

//Wordpress has lots of pre-built functions , this is to display single post 

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


<div class="generic-content">

<div class="row group">
  <div class="one-third">

    <?php the_post_thumbnail();?> 
    
  </div>
   <div class="two-thirds">

     <?php the_content();?> 
    
  </div>

</div>	

</div>

<?php 
$relatedProgrammes=get_field('related_programmes');
if ($relatedProgrammes) {
echo '<hr class="section-break">';
echo '<h4 class="headline headline--medium">Course(s) Taught</h4>';
echo '<ul class="link-list min-list">';
foreach($relatedProgrammes as $programme){ ?>
<li><a href="<?php echo get_the_permalink($programme); ?>"><?php echo get_the_title($programme);?></a></li>

<?php } 
 echo '</ul>';
}
?> 


	
 </div>

<?php }?>

<?php get_footer();?>