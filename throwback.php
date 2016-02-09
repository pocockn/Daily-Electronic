<?php

/*

Template Name: Throwback

*/

get_header();

$args = array(
        'post_type' => 'throwbacks',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' =>  'DESC',
);

$throwback_song_query = new WP_Query( $args );

?>
<header class="intro-throwback">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Throwback</h1>

                        <p class="intro-text">One from the vaults</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated" href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        <div class="row">
        <?php if ( $throwback_song_query->have_posts() ) : while ( $throwback_song_query->have_posts() ) : $throwback_song_query->the_post(); 

            $id = get_the_ID();
            $artist_name = grab_artist_name($id);

            $media_link = get_post_meta( get_the_ID(), '_video_link' );
            $buy_link = get_post_meta( get_the_ID(), '_buy_link' );

         ?> 
            <div class="col-md-12">
                <h3><?php echo $artist_name . ' -';?> <?php echo the_title(); ?></h3>
                <iframe id="youtube-iframe" src="<?php echo $media_link[0]; ?>" frameborder="0" allowfullscreen></iframe>
                <?php if ( $buy_link[0] ) { ?>
                    <p class="buy-now">Support the artist, <a href="<?php echo $buy_link[0]?>" target="_blank">buy here</a></p>
                <?php } ?>
            </div>
        </div>
    </section><!-- Footer -->

    <?php endwhile; ?>
    <!-- end of loop -->
            
    <? wp_reset_postdata(); ?>

    <?php else:  ?>
        <p><?php _e( 'Sorry, no songs have been posted' ); ?></p>
    <?php endif; ?>
    </div>
</section><!-- Footer -->

<?php get_footer(); ?>   
