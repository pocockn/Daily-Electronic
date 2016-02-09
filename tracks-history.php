<?php

/*

Template Name: Archive

*/

//Protect against arbitrary paged values
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1; 

get_header();

$args = array(
        'post_type' => array( 'songs', 'throwbacks' ),
        'posts_per_page' => 20,
        'orderby' => 'date',
        'order' =>  'DESC',
        'paged' => $paged
);

$archive_songs_query = new WP_Query( $args );

?>
<header class="intro-archive">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Archive</h1>

                        <p class="intro-text">An archive of all the tracks posted on the site</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated" href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        
        <?php 
        $j = 0;

        if ( $archive_songs_query->have_posts() ) : while ( $archive_songs_query->have_posts() ) : $archive_songs_query->the_post();  

              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, '370x250' );
              $thumb_url = $thumb_url_array[0];

              $id = get_the_ID();

              $artist_name = grab_artist_name($id);
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
                                    <h3><?php echo $artist_name; ?></h3>
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
                  <?php dem_pagination($archive_songs_query->max_num_pages); 
                  ?>
               </div>
            </div>
        </section><!-- Footer -->

    <?php get_footer(); ?>   
