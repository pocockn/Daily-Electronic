<?php

/*

Template Name: artists

*/

//Protect against arbitrary paged values
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1; 

get_header();

// Grab the artist ID we posted through the URL. This will allow us to retrieve all their tracks
$artist_id = $_GET['id'];

// grab the artists name from the database with the ID variable.
// Outside the loop so we use $wpdb to interact with the database, returns an associate array
$artist_details = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->posts where ID = %s", $artist_id ), ARRAY_A );

$args = array(
        'post_type' => 'songs',
        'posts_per_page' => 20,
        'orderby' => 'date',
        'order' =>  'DESC',
        'paged' => $paged,
        'meta_key'  => '_artist',
        'meta_value'  => $artist_id

);

$artists_songs_query = new WP_Query( $args );

?>
<header class="intro-archive">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading"><?php echo $artist_details[0]['post_title']; ?></h1>

                        <p class="intro-text">An archive of all the <?php echo $artist_details[0]['post_title']; ?> tracks posted on the site</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated" href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        
        <?php 
        $j = 0;

        if ( $artists_songs_query->have_posts() ) : while ( $artists_songs_query->have_posts() ) : $artists_songs_query->the_post();  

              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, '370x250' );
              $thumb_url = $thumb_url_array[0];

              // Grab the artist ID from the post meta
              $artist = get_post_meta(get_the_ID(), '_artist');
              
              // seperate each artist id
              $explodeArray = array_filter(explode(' ', $artist[0]));

              $arrayLength = count($explodeArray);

              $i = 0;
              
              // If there is more than one artist attached to song loop through
              if ($arrayLength > 1) {
                foreach ($explodeArray as $array) {
                  $artist_meta[$i] = get_the_title($array);
                  $i++; 
                }
              } else {
                $artist_name = get_the_title($explodeArray[0]);
              }

              // If the current counter dividied by 4 leaves no remainder add a row
              // This splits our archive into rows with 4 elements in
              if($j % 4 == 0) { ?> 

              <div class="row ">

              <?php } ?>

                  <div class="col-md-3 col-sm-12" style="margin-top:100px;">
                        <div class="ih-item square effect3 bottom_to_top">
                            <a href="<?php the_permalink(); ?>">
                                <div class="img">
                                    <img alt="" class="image-responsive" src="<?php echo $thumb_url ?>">
                                </div>
                                <div class="info">
                                    <h3><?php if ($artist_meta) { foreach($artist_meta as $meta) { echo $meta; echo '<br />'; } } else { echo $artist_name; } ?></h3>
                                    <p><?php the_title(); ?></p>
                                </div>
                            </a>
                        </div>
                   </div>

               <?php 
                $j++;

                if ( $j != 0 && $j % 4 == 0 ) { ?>

                </div><!--/.row-->
                <?php 
                }
               
                endwhile; endif;?>
               <div class="col-md-12">
                  <?php dem_pagination($artists_songs_query->max_num_pages); 
                  ?>
               </div>
            </div>
        </section><!-- Footer -->

    <?php get_footer(); ?>   
