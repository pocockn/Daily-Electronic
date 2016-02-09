
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
 

    <title>Daily Electronic Music</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javaScript">

    //var myObject = 'archive-header.jpg';

    //console.log(myObject);
    // A $( document ).ready() block.
    // jQuery that gets the url for the image and then dynamically changes the background.
    // We can use this to make each page header image dynmaic in wordpress
    //$( document ).ready(function() {
    // $('.intro').css('background', 'url(img/archive-header.jpg) no-repeat bottom center scroll');
    //});    

    </script>

    <?php wp_head();  ?>
</head>

<body data-spy="scroll" data-target=".navbar-fixed-top" id="page-top">
    <!-- Navigation -->

    <nav class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle fa fa-bars hidden-lg hidden-md" data-target=".navbar-main-collapse" data-toggle="collapse" style="font-style: italic" type="button"></button> <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-play-circle"></i> <span class="light">Daily</span>Electronic</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class=
            "collapse navbar-collapse navbar-right navbar-main-collapse">
				<?php /* Primary navigation */
				wp_nav_menu( array(
				  'menu' => 'top_menu',
				  'depth' => 2,
				  'container' => false,
				  'menu_class' => 'nav navbar-nav',
				  //Process nav menu using our custom nav walker
				  'walker' => new wp_bootstrap_navwalker())
				);
				?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- Intro Header -->
