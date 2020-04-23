<?php 
if (!is_user_logged_in()){
wp_redirect(site_url('/'));
exit;

}
?>

<?php get_header();?>

<?php

//Wordpress use this tepmlate to generate my Notes page
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
  
  <ul class="min-list link-list" id="my-notes">
    <?php 
    // Custom Query 
    $userNotes= new WP_Query(array(
      'post_type'=>'note',
       'post_per_page'=>-1,
       'author'=> get_current_user_id()

    ));
   while ($userNotes->have_posts()) {

        $userNotes->the_post(); ?>

        <li>
          <input class="note-title-field" value="<?php echo esc_attr(get_the_title());?>">
          
          <span class="edit-note"><i class="fa fa-pencil" aria-hidden="ture"></i>Edit </span>
          <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="ture"></i>Delete </span>
          <div class="note-body-field">
           <?php the_content();?>
          </div> 
         

        </li>

      <?php } ?> 


  </ul>

  </div>



<?php }?>

<?php get_footer();?>