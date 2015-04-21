
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <title><?php wp_title( '' ); ?></title>

    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/flexslider.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>?cache=890" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/tablet.css?cache=234" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/mobile.css?cache=123" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/grid.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/calendar.css" />
    <!-- OakWorks over-ride css for any global elements -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/last.css" />
    <link rel="stylesheet" type="text/css" href="/wp-content/plugins/ai-twitter-feeds/css/aitwitter.css" />
    <!-- Mikes over-ride css for any global elements -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/mike.css" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
		<link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome">

    <?php wp_head(); ?>
    <!-- Lukes over-ride css for any global elements -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/luke.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/long.css" />

    <script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.mmenu.min.all.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script type="text/javascript">
		// This is NOT how I'd normally do this but in the interest of time...
	var bpca_script = {
		'theme_url': '<?php echo get_template_directory_uri(); ?>',
		'site_url': '<?php echo get_site_url(); ?>'
	};
	</script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/script.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/bpca-grid.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.ba-bbq.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/simplecalendar.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/filter.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/downloadable-items.js" type="text/javascript"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/accordion.js" type="text/javascript"></script>

    <script type="text/javascript">
		jQuery(function($) {
			$('p:empty').remove();

			$('nav#mobile-menu').mmenu({
				position: 'right'
			});
		});
	</script>
</head>

<body <?php body_class( $class ); ?>>
<body>

	<div id="wrapper">
    	<header class="sticky">
        	<!--<div class="top-navigation">
                <div class="wrapper">
                    <div class="new-york-state"></div>

                    <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'top', 'menu_class' => 'top' ) ); ?>

                    <div class="clear"></div>
                </div>
         	</div>-->
         	<div class="wrapper">
             <div id="nygov-universal-navigation" class="nygov-universal-container" data-iframe="true" data-updated="2014-11-07 08:30">
    <noscript>
        <iframe width="100%" height="86px" src="//static-assets.ny.gov/load_global_menu/ajax?iframe=true" frameborder="0" style="border:none; overflow:hidden; width:100%; height:86px;" scrolling="no">
            Your browser does not support iFrames
        </iframe>
    </noscript>
    <script type="text/javascript">
        var _NY = {
            HOST: "static-assets.ny.gov",
            BASE_HOST: "www.ny.gov",
            hideSettings: true,
            hideSearch: false
        };
        (function (document, bundle, head) {
            head = document.getElementsByTagName('head')[0];
            bundle = document.createElement('script');
            bundle.type = 'text/javascript';
            bundle.async = true;
            bundle.src = "//static-assets.ny.gov/sites/all/widgets/universal-navigation/js/dist/global-nav-bundle.js";
            head.appendChild(bundle);
        }(document));
    </script>
</div>
			</div>

            <div class="wrapper">
            	<div class="identity">
                    <div class="logo"><a href="<?php bloginfo( 'home' ); ?>/"><span>HUGH L. CAREY</span><span>BATTERY PARK CITY<br />AUTHORITY</span></a></div>
                </div>

                <div class="top-action">
                    <nav id="mobile-menu">
                        <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary' ) ); ?>
                    </nav>

                    <nav id="menu">
                        <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary' ) ); ?>
                    </nav>

                    <a href="#mobile-menu" class="mmenu"><span></span></a>
                </div>

                <div class="clear"></div>
            </div>
        </header>

        <div id="main">
