<?php get_header();?>

<!--if search.php is not there, wordpress will generate search results using the template index.php -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg');?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Search Results</h1>
      <div class="page-banner__intro">
        <p>You Search for <?php echo '"'.get_search_query().'"' ;?></p>
      </div>
    </div>  
  </div>

<div class="container container--narrow page-section">
<?php
if (have_posts()) {
while (have_posts()){
  the_post(); 
 

  ?> 

  <div>
    <!--the_permalink() echos out the permalink of the current post to the frontend-->
    <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"> <?php the_title();?></a></h2>
  </div>

  <div class="metabox">
    <p>Posted by <?php the_author_posts_link();?> on <?php the_time('n-j-y');?> in <?php echo get_the_category_list(', ');?> </p>
  </div>

  <div class="generic-content">

    <?php the_excerpt();?>

    <p><a class="btn btn--blue" href="<?php the_permalink();?>">Continue Reading &raquo</a></p>
    
  </div>

<?php } 
// echo paginatione links 
echo paginate_links();
} else {

  echo '<h2 class="headline headline--small-plus ">No search match that search. </h2>';
}

?> 


</div>

<?php get_footer();?>