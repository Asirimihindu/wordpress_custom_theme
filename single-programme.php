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
<div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('programme');?>"><i class="fa fa-home" aria-hidden="true"></i>All Programmes</a> <span class="metabox__main"><?php the_title();?></span></p>
 </div>


<div class="generic-content">

<?php  the_content();?> 	

</div>

 <?php 
$relatedProfessors= new WP_Query(array(
        'posts_per_page'=>-1,
        'post_type'=>'professor',
        'orderby'=> 'title',
        'order'=>'ASC',
        // filters
        'meta_query'=> array(
          array(
            'key'=> 'related_programmes',
            'compare'=>'LIKE',
            //bcs of serialization 
            'value'=> '"'.get_the_ID().'"'
          )
        )
        ));
        
        if ($relatedProfessors->have_posts()){

         echo '<hr class="section-break">';
        echo  '<h2 class="headline headline--medium">'. get_the_title().' Professors </h2>';
        //Custom Query 
        while($relatedProfessors->have_posts()){
          //get the data ready for each post 
          $relatedProfessors->the_post();
          ?> 
        
        <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
        <?php }
        }
        // when running multiple custom queries in one page below function must be run in between them 
        wp_reset_postdata();

 //////////////////////////////////////
        //after typing this code permalink update necessary
        $today= date('Ymd');
        $homepageEvents= new WP_Query(array(
        'posts_per_page'=>2,
        'post_type'=>'event',
        'meta_key'=> 'event_date',
        'orderby'=> 'meta_date_num',
        'order'=>'DSC',
        // filters
        'meta_query'=> array(
          array(
            'key'=> 'event_date',
            'compare'=> '>=',
            'value'=> $today,
            'type'=> 'numeric'
          ),
          array(
            'key'=> 'related_programmes',
            'compare'=>'LIKE',
            //bcs of serialization 
            'value'=> '"'.get_the_ID().'"'
          )
        )
        ));
        
        if ($homepageEvents->have_posts()){

         echo '<hr class="section-break">';
        echo  '<h2 class="headline headline--medium">Upcoming '. get_the_title().' Events </h2>';
        //Custom Query 
        while($homepageEvents->have_posts()){
          //get the data ready for each post 
          $homepageEvents->the_post();
          ?> 
        <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month"><?php 
            echo date('M',strtotime(get_field('event_date')));
            //echo $dateTime->format('M');?></span>
            <span class="event-summary__day"><?php 
            echo date('d',strtotime(get_field('event_date')));
            //echo $dateTime->format('M');?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(),18);?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
        <?php }
        }

        ?>
	
 </div>

<?php }?>

<?php get_footer();?>