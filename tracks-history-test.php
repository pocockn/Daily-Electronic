<?php

/*

Template Name:Archive Test

*/

get_header();

$args = array(
        'post_type' => 'songs',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'order' =>  'DESC'
);

$archive_songs_query = new WP_Query( $args );

$genres = get_terms( 'genre', array( 'hide_empty' => 0 ) );


?>
<header class="intro-archive">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Archive</h1>

                        <p class="intro-text">A archive of all the tracks posted on the site</p><a class="btn btn-circle page-scroll fa fa-angle-double-down animated"href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="archive-tracks">
        <div class="row ">
        <?php if ( $archive_songs_query->have_posts() ) : while ( $archive_songs_query->have_posts() ) : $archive_songs_query->the_post();  

              $song_name = get_post_meta( get_the_ID(), '_song_name' );

              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, '370x250' );
              $thumb_url = $thumb_url_array[0];

         ?> 
         <div class="col-md-3 col-sm-12" style="margin-top:100px;">
                <div class="ih-item square effect3 bottom_to_top">
                    <a href="<?php the_permalink(); ?>">
                    <div class="img"><img alt="" class="image-responsive" src=
                    "<?php echo $thumb_url ?>"></div>

                    <div class="info">
                        <h3><?php the_title(); ?></h3>

                        <p><?php echo $song_name[0]; ?></p>
                    </div></a>
                </div>
            </div>

        <?php  

         endwhile; endif;?>
         <div class="col-md-12">
         <?php dem_pagination($archive_songs_query->max_num_pages); 
          var_dump($archive_songs_query->max_num_pages);
         ?>
         </div>
         
     
        </div>
    </section><!-- Footer -->
   <!-- SCM Music Player http://scmplayer.net -->
<script type="text/javascript" src="http://dailyelectronicmusic.com/test/script.js" 
data-config="{'skin':'skins/simpleBlack/skin.css','volume':50,'autoplay':false,'shuffle':false,'repeat':1,'placement':'bottom','showplaylist':false,'playlist':[{'title':'Scuba - Drift','url':'https://www.youtube.com/watch?v=7kedWTqUbtU'},{'title':'Synkro - Changes','url':'https://www.youtube.com/watch?v=PXiE1p_LaLc'},{'title':'Alan Fitzpatrick - Truant','url':'https://www.youtube.com/watch?v=Mi2WUUWY_eU'},{'title':'Sam Pigani - Rave','url':'https://www.youtube.com/watch?v=WWuDiwr30SI'},{'title':'Adam Beyer - Spaceman','url':'https://www.youtube.com/watch?v=Sallure_WgQ'},{'title':'Dense & Pika - Move Your Body Back','url':'https://www.youtube.com/watch?v=39FBffVCE0Y'},{'title':'Kollektiv Turmstrase - Last Day (David August Remix)','url':'https://www.youtube.com/watch?v=-ADk4auAbYs'},{'title':'Bjarki - I Wanna Go Bang','url':'https://www.youtube.com/watch?v=pvEdwl88J2U'},{'title':'Shall Ocin - The Cliff','url':'https://www.youtube.com/watch?v=ugAujakbWfc'},{'title':'Nicolas Jaar - Fight','url':'https://www.youtube.com/watch?v=JM6lRdPO7So'},{'title':'Dibiza (Joseph Capriati Remix)','url':'https://www.youtube.com/watch?list=RDtgXOd_gBUt4&v=tgXOd_gBUt4'},{'title':'St Germain - Real Blues','url':'https://www.youtube.com/watch?v=Uf-W9YkWISU'},{'title':'Matthias Adler - Dirty Ride','url':'https://www.youtube.com/watch?v=VV0_8y_qvPU'},{'title':'Howling - %27Signs%27 (R%F8dh%E5d Remix)','url':'https://www.youtube.com/watch?v=RHjKY1fVbxI'},{'title':'Blond:ish - Shy Grass','url':'https://www.youtube.com/watch?v=rWiYCEx3MQI'},{'title':'Tale Of Us - Astral ','url':'https://www.youtube.com/watch?v=N83Rzpc0lyg'},{'title':'Platinum Doug - Play With Me','url':'https://www.youtube.com/watch?v=GAxbYQGexx0'},{'title':'Richie Hawtin - Exhale (Dixon%27s Version)','url':'https://www.youtube.com/watch?v=_4krxwGqmbU'},{'title':'Andrea Bertolini - Improvvisazione #4','url':'https://www.youtube.com/watch?v=1enReL2iTq4'},{'title':'Hummingbirds - Crawl','url':'https://www.youtube.com/watch?v=OuhxPxx83bg'},{'title':'Dominik Eulberg, Extrawelt - A Little Further (Not On A Map )','url':'https://www.youtube.com/watch?v=_pYilp_phS8'},{'title':'Monoloc - Singularity','url':'https://www.youtube.com/watch?v=5Es7Du4R0Rs'},{'title':'Lando + Xavier - The Switch','url':'https://www.youtube.com/watch?v=-aA2sWWBw58'},{'title':'Four Tet - Opus','url':'https://www.youtube.com/watch?v=47nIoXraa_Q'},{'title':'Glimpse - Train in Austria','url':'https://www.youtube.com/watch?v=Yh-d5FA0e7s'},{'title':'Paul Woolford - MDMA','url':'https://www.youtube.com/watch?list=RDzqop270eh-0&v=pZi4EYrO9bo'},{'title':'Sepalcure - Fight For Us','url':'https://www.youtube.com/watch?v=CkeIdY5QxvY'},{'title':'Robert Hood - Shaker','url':'https://www.youtube.com/watch?v=VT9OiFKYTAc'},{'title':'Alan Fitzpatrick - Tribe','url':'https://www.youtube.com/watch?v=QebOl4XRYDU'},{'title':'Dubfire - Fratello (Dubfire Remix)','url':'https://www.youtube.com/watch?v=GjFq7nhSw6g'},{'title':'Tycho - Plains (Baio Remix)','url':'https://www.youtube.com/watch?v=PX1C3uCtvnY'},{'title':'Christian Smith - Turn Down The Lights','url':'https://www.youtube.com/watch?v=JUnhN7ki1q8'},{'title':'Caribou - Can%27t Do Without You','url':'https://www.youtube.com/watch?v=DA0NG3c3I-o'},{'title':'Lapsley - Station','url':'https://www.youtube.com/watch?v=uD7_Vt5q2q8'},{'title':'Green Velvet - When Is Now','url':'https://www.youtube.com/watch?v=DFlaCVFijgM'},{'title':'Enrico Sangiuliano - Can You Hear Me','url':'https://www.youtube.com/watch?v=1bMPFgZCoEA'},{'title':'Julian Jeweil - Lizard King','url':'https://www.youtube.com/watch?v=JJlTnPCo_Ac'},{'title':'Dele Sosimi & Afrobeat Orchestra - Too Much Information (Laolu Remix)','url':'https://www.youtube.com/watch?v=IYumekd1VMg'},{'title':'Khen - Secret Shining','url':'https://www.youtube.com/watch?v=AHGE8DrVZpQ'},{'title':'I Get Deep (Late Nite Tuff Guy Remix - Emanuel Satie Rework)','url':'https://www.youtube.com/watch?v=0rMAr1JsKHc'},{'title':'Fatima Yamaha - What%27s a Girl to Do','url':'https://www.youtube.com/watch?v=OZr-9I9VtLU'},{'title':'Solee - Maercheninsel (Original Mix)','url':'https://www.youtube.com/watch?v=CDCVgL_v4iU'},{'title':'Mark Reeves - Run Back','url':'https://www.youtube.com/watch?v=gmYZV8vZAHk'},{'title':'Oliver Koletzki - Iy%E9waye (Hatzler Remix)','url':'https://www.youtube.com/watch?v=b76sx-mF2Zg'},{'title':'Chemical Brothers - Wide Open (K%F6lsch Remix)','url':'https://www.youtube.com/watch?v=jKbyNZmXY4g'},{'title':'Matthew Herbet - It%27s Only (DJ Koze Remix)','url':'https://www.youtube.com/watch?v=cxz8qJ2B8Ug'},{'title':'DJ Le Roi - You Don%27t Know (Original Mix)','url':'https://www.youtube.com/watch?v=OjTnZKLsMBU'}]}" ></script>
<!-- SCM Music Player script end -->



<?php get_footer(); ?>   
