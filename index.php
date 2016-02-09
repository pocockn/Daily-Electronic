<?php

/*

Template Name: default

*/

get_header(); 

$args = array(
        'post_type' => array( 'songs', 'throwbacks' ),
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' =>  'DESC'
);

$latest_songs_query = new WP_Query( $args );

?>

    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Daily Electronic</h1>

                        <p class="intro-text">A site dedicated to electronic
                        music</p><a class=
                        "btn btn-circle page-scroll fa fa-angle-double-down animated"
                        href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        <div class="row">
            <div class="col-lg-12">
                <h2>Latest Tracks</h2>
            </div>
        </div>
        <?php $j = 0; ?>
         <?php if ( $latest_songs_query->have_posts() ) : while ( $latest_songs_query->have_posts() ) : $latest_songs_query->the_post();  

            $song_name = get_post_meta( get_the_ID(), '_song_name' );

            $artist = get_post_meta(get_the_ID(), '_artist');
              
			$explodeArray = array_filter(explode(' ', $artist[0]));

			$arrayLength = count($explodeArray);

			$i = 0;
			  
			if ($arrayLength > 1) {
				foreach ($explodeArray as $array) {
					$artist_meta[$i] = get_the_title($array);
					$i++;	
				}
			} else {
				$artist_name = get_the_title($explodeArray[0]);
			}


            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, '370x250' );
            $thumb_url = $thumb_url_array[0];

            if($j % 3 == 0) { ?> 

            <div class="row">

            <?php } ?>

            <div class="col-md-4 col-sm-12" style="margin-top:75px;">
                <div class="ih-item square effect3 bottom_to_top">
                    <a href="<?php the_permalink(); ?>">
                    <div class="img"><img alt="" class="image-responsive" src=
                    "<?php echo $thumb_url ?>"></div>

                    <div class="info">
                        <h3><?php if ($artist_meta) { foreach($artist_meta as $meta) { echo $meta; echo '<br />'; } } else { echo $artist_name; } ?></h3>

                        <p><?php echo the_title(); ?></p>
                    </div></a>
                </div>
            </div>
        <?php $j++; 
      if($j != 0 && $j % 3 == 0) { ?>
        </div><!--/.row-->
        <?php } ?>
          <?php endwhile; wp_reset_postdata(); endif; ?>
    </section><!-- Footer -->


<?php get_footer(); ?>    
