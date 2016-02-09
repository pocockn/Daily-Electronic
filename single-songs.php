<?php

get_header();

$pid = get_the_ID();

$song_name = get_post_meta( $pid, '_song_name' );
$media_link = get_post_meta( $pid, '_video_link' );
$buy_link = get_post_meta( $pid, '_buy_link' );
$artist = get_post_meta($pid, '_artist');

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


// Lets grab all the genres associated with each song
$all_genres = get_genres( $pid, 'genre' );

?>

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
  
    ?>

    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <?php if ($artist_meta) { 
                        		foreach($artist_meta as $meta) {  ?>
                        		<h1> <?php echo $meta; echo '<br />'; ?> </h1> <?php } 
                        		} else { ?>
                        			<a href="<?php echo esc_url( home_url( '/' ) ); ?>artists?id=<?php echo $artist[0]; ?>"><h3 class="brand-heading"> <?php echo $artist_name; ?> </h3></a>
                        		<?php } ?>
                        <p class="intro-text"><?php the_title(); ?></p><a class=
                        "btn btn-circle page-scroll fa fa-angle-double-down animated"
                        href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        <div class="row">
            <div class="col-md-12">
            <?php $find_id = preg_match('([^/]+$)', $media_link[0], $matches);

            ?>

                <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '450',
          width: '100%',
          videoId: '<?php echo $matches[0]; ?>',
          events: {
            'onStateChange': onPlayerStateChange
          }
        });
      }

      console.log(YT.SCMYoutube);

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.

      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
          SCM.pause();
        } 
      }


      function stopVideo() {
        player.stopVideo();
      }
    </script>


                <ol id="song-genres">
                <?php foreach ( $all_genres as $genre ) {
                    // Grab the link to genre archive page 
                    $genre_link = get_term_link( $genre );
                ?>
                <li class = "single-song-genre"><i class="fa fa-tag"></i><a href="<?php echo $genre_link; ?>"><?php echo $genre->name; ?></a></li>
                <?php } ?>
                </ol>
                <?php if ( $buy_link[0] ) { ?>
                    <p class="buy-now">Support the artist, <a href="<?php echo $buy_link[0]?>" target="_blank">buy here</a></p>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="previous pull-left">
                    <?php previous_post_link(); ?> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="previous pull-right">
                    <?php next_post_link(); ?>
                </div>
            </div>
        </div>
    </section><!-- Footer -->

<?php 

endwhile; 

wp_reset_postdata(); ?>


<?php get_footer(); ?>    
