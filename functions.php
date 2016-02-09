<?php

/* 
* Theme setup 
*/

add_action( 'after_setup_theme', 'wpt_setup' );

    if ( ! function_exists( 'wpt_setup' ) ):

        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );

            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'menus' );

    		// additional image sizes
    		add_image_size( 'song-thumb', 370, 250, true ); //300 pixels wide (and unlimited height)
} endif;

/***************************
* Enqueue scripts and styles
****************************/

function bwd_theme_stylesheets()
  {
    wp_register_style('bootstrap.css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1', 'all' );
		wp_enqueue_style( 'bootstrap.css');
		wp_register_style('ihover.css', get_template_directory_uri() . '/assets/css/ihover.min.css', array(), '1', 'all' );
		wp_enqueue_style( 'ihover.css');
		wp_register_style('loraItalic', 'http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
    wp_enqueue_style( 'loraItalic');
    wp_register_style('montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700');
    wp_enqueue_style( 'montserrat');
    wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );
  }
    
add_action('wp_enqueue_scripts', 'bwd_theme_stylesheets');


function bwd_load_scripts() 
	{
		wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/assets/js/bootstrap.min.js',array('jquery'));
		wp_enqueue_script('jquery-ui',get_template_directory_uri() . '/assets/js/grayscale.js',array('jquery'));
		wp_enqueue_script('canvas-js',get_template_directory_uri() . '/assets/js/jquery.easing.min.js',array('jquery'));
    wp_enqueue_script( 'ajax-implementation.js', get_bloginfo('template_directory') . "/assets/js/ajax-implementation.js", array( 'jquery' ) );	
    wp_enqueue_script('rss-feed',get_template_directory_uri() . '/assets/js/gfeedfetcher.js',array());
	}

	add_action( 'wp_enqueue_scripts', 'bwd_load_scripts' );

	// Register custom navigation walker
  require_once('wp_bootstrap_navwalker.php');


  /*
  * Add a custom bootstrap class to our form, using contact form 7 filter
  */
  add_filter( 'wpcf7_form_class_attr', 'add_custom_form_class' );

	function add_custom_form_class( $class ) {
		$class .= ' form-horizontal';
		return $class;
	}

	// Adapted from https://gist.github.com/toscho/1584783
	add_filter( 'clean_url', function( $url )
	{
	    if ( FALSE === strpos( $url, '.js' ) )
	    {
	        return $url;
	    }
	    return "$url' defer='defer";
	}, 11, 1 );

	/*
	* Add our Google Analytics code to the footer
	*/

	add_action('wp_footer', 'ga_code');

	function ga_code() { ?>

		<script>

		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-61240976-2', 'auto');
		  ga('send', 'pageview');

		</script>

	<?php }


/**
* Create Pagination links for archive page
* @param  integer $pages - the number of pages, obly necessary if using custom loop
* @param  integer $range - sets the number of links to display, how many links before and after
* the current page should be displayed before it shows small arrows
*/

function dem_pagination( $pages = '', $range = 2 ) {

        // The max number of items to display
        // if range is 2, range x 2 + 1 would display 9 items, 
        //the current, 2 either side for the range and 2 either side for arrows
        $showItems = ($range * 2)+1;

        // Access global $paged, this varialbe is used to store which page we are currently viewing
        global $paged;

        // If $paged is empty, set to 1
        if (empty($paged)) $paged = 1;

        // If we aren't using a custom loop, check maximum pages
        if ($pages == '') {

            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }

        // If there is more than 1 page
        if ( $pages != 1 ) {
            echo "<div class='pagination'>";
            if ($paged > 2 && $paged > $range+1 && $showItems < $pages) {
                echo "<a href='".get_pagenum_link(1). '#latest' . "'>&laquo;</a>";
            }
            if($paged > 1 && $showitems < $pages) {
                echo "<a href='".get_pagenum_link($paged - 1). '#latest' ."'>&lsaquo;</a>";
            }
            
            for ($i=1; $i <= $pages; $i++)
              {
                 // Checks to grab the current page we are on
                 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 {
                     echo ($paged == $i) ? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i). '#latest' ."' class='inactive' >".$i."</a>";
                 }
              }

             // Arrow for the next page
             if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1). '#latest' . "'>&rsaquo;</a>"; 
             // Arrow to get to the end of the pages 
             if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages). '#latest' ."'>&raquo;</a>";
             echo "</div>\n";
        } 
    }


// Create the soundcloud short code

    function add_soundcloud_shortcode() {
      wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
    }

    add_action( 'init', 'add_soundcloud_shortcode' );

function get_genres( $pid, $taxonomy ) {

  $genres = wp_get_post_terms( $pid, $taxonomy );

  return $genres;
  
}

// Hooks into the query on our taxonomy page and makes sure we display 20 posts per page

function wpse214084_max_post_queries( $query ) {
   // if the taxonomy is genre display 20 posts, helps with our pagination
   if( is_tax('genre') ){ 
     $query->set('posts_per_page', 20);
   }
}

// use the hook 'pre_get_posts' to call the function before the query is run
add_action( 'pre_get_posts', 'wpse214084_max_post_queries' );

/* 
* Function to grab the artist name from the selected track
* @param ID - the post ID used to query the database
* @return 
* added 20/01/2016
*/

function grab_artist_name($id) {

  // Grab the artist ID from the post meta
  $artist = get_post_meta($id, '_artist');
              
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

  if ($artist_meta) { 
    foreach($artist_meta as $meta) { 
      return $meta . '<br />'; 
    } 
  } else { 
    return $artist_name; 
    } 

  }

?>
