<?php

/*

Template Name: Mix

*/

get_header();

$args = array(
        'post_type' => 'mix',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' =>  'DESC'
);

$mix_song_query = new WP_Query( $args );

?>
<header class="intro-mix">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Mix of the Month</h1>

                        <p class="intro-text">A great mix each month</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated" href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        <div class="row">
        <?php if ( $mix_song_query->have_posts() ) : while ( $mix_song_query->have_posts() ) : $mix_song_query->the_post();  

            $song_name = get_post_meta( get_the_ID(), '_song_name' );

            $media_link = get_post_meta( get_the_ID(), '_video_link' );
            $buy_link = get_post_meta( get_the_ID(), '_buy_link' );

         ?> 
            <div class="col-md-12">
                <h3><?php the_title(); ?> <?php echo $song_name[0]; ?></h3>
                <?php the_content();?>
            </div>
        </div>
    </section><!-- Footer -->

    <?php endwhile; ?>
    <!-- end of loop -->
            
    <? wp_reset_postdata(); ?>

    <?php else:  ?>
        <p><?php _e( 'Sorry, no mix has been posted' ); ?></p>
    <?php endif; ?>
    </div>
</section><!-- Footer -->

<?php get_footer(); ?>   
