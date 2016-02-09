<?php
/*
Template Name: Blog Posts
*/

get_header();

?>

<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">google.load("feeds","1");</script>


<script type="text/javascript">
/*
*  How to find a feed based on a query.
*/

google.load("feeds", "1");

function OnLoad() {
  // Query for president feeds on cnn.com
  var query = 'electronic music, techno, house music, ibiza, bass, richie hawtin, skream, electronica, downtempo, dense & pika, xoyo, dc 10';
  google.feeds.findFeeds(query, findDone);

}

function findDone(result) {
  // Make sure we didn't get an error.
  if (!result.error) {
    // Get content div
    var content = document.getElementById('latest-news');
    var html = '';

    // Loop through the results and print out the title of the feed and link to
    // the url.
    for (var i = 0; i < result.entries.length; i++) {
      var entry = result.entries[i];
      console.log(entry);
      html += '<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">';
      html +=  '<div class="post-preview">';
      html +=  '<h3 class="post-title">';
      html += '<a href=' + entry.link + '>' + entry.title + '</a></h2>';
      html += '<p class="post-subtitle">' + entry.contentSnippet + '</p>';
      html += '</div>';
      html += '<hr>';
      html += '</div>';
    }
    content.innerHTML = html;
  }
}

google.setOnLoadCallback(OnLoad);


</script>

    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 class="brand-heading"> Latest News </h3></a>
                        <p class="intro-text">The latest electronic music news from all over the internet</p><a class=
                        "btn btn-circle page-scroll fa fa-angle-double-down animated"
                        href="#latest" style="font-size:54px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- About Section -->

    <section class="container content-section text-center" id="latest">
        <div class="row">
                <div id="latest-news">
 
                </div>
        </div>
    </section><!-- Footer -->

<?php get_footer(); ?>    
