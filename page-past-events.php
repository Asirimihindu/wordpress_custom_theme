<?php get_header();?>

<!--page-past-events.php is to show past events -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg');?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>Recap of our past events.</p>
      </div>
    </div>  
  </div>

<div class="container container--narrow page-section">
<?php
//customize the query to show events which were already held
$today= date('Ymd');
        $pastEvents= new WP_Query(array(
        // get information from URL, 1 is the default value 
        'paged'=> get_query_var('paged',1),
        'posts_per_page'=> 2,
        'post_type'=>'event',
        'meta_key'=> 'event_date',
        'orderby'=> 'meta_date_num',
        'order'=>'ASC',
        'meta_query'=> array(
          array(
            'key'=> 'event_date',
            'compare'=> '<',
            'value'=> $today,
            'type'=> 'numeric'
          )
        )
        ));

while ($pastEvents->have_posts()){
  $pastEvents->the_post(); ?> 
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
// this configuration is needed for custom queries 
echo paginate_links(array(
 'total' => $pastEvents->max_num_pages

));


?> 


</div>

<?php get_footer();?>