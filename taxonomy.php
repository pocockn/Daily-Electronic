<?php

/*

Template Name: Genre

*/

//Protect against arbitrary paged values
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1; 

get_header();

$object = get_queried_object();

$taxonomy = "genre"; // can be category, post_tag, or custom taxonomy name

// Using Term Slug
$term_slug = $object->slug;
$term = get_term_by('slug', $term_slug, $taxonomy);

// Fetch the count
$number = $term->count / 20;


?>
<header class="intro-archive">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading"><?php echo $object->name; ?></h1>

                        <p class="intro-text">An archive of all the <?php echo strtolower( $object->name ); ?> posted on the site</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated" href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        
        <?php 
        $j = 0;
        $num_songs = 0;

         if ( have_posts() ) : while ( have_posts() ) : the_post(); // standard WordPress loop.

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
       
                endwhile; endif;
        
                ?>
               <div class="col-md-12">
                  <?php dem_pagination($number); ?>
               </div>
            </div>
        </section><!-- Footer -->

    <?php get_footer(); ?>   
