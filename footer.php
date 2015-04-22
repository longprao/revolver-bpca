			<div id="footer" class="wrapper">
				<div class="row three-column">
					<div class="col-md-4 col">
						<div class="content resources">
							<h3>Resources:</h3>
							<?php wp_nav_menu( array( 
								'menu' => 'resources',
								// do not fall back to first non-empty menu
								'theme_location' => '__no_such_location',
								// do not fall back to wp_page_menu()
								'fallback_cb' => false,
							) ); ?>
						</div>
					</div>

					<div class="col-md-4 col">
						<div class="content newsletter">
							<h3>Newsletter:</h3>

							<?php //echo do_shortcode( '[constantcontactapi formid="1"]' ); ?>
							<?php gravity_form( 2, false, false, true, array(), true, 999, true ); ?>

							<div class="clear"></div>
						</div>
					</div>

					<div class="col-md-4 col">
						<ul>
							<?php dynamic_sidebar( 'footer-right-widget-area' ); ?>
						</ul>
					</div>
				</div>
			</div>

			<!--<a href="#top" class="go-top" style="display: inline;">Go to top of page</a>-->
        </div>

		<div class="symbol wrapper"></div>

		<div class="copyright wrapper">Site created by Copyright &copy; <?php echo date('Y'); ?> /
<a href="http://www.revolverstudios.com" target="_blank"> <span style="font-family: 'proxima_nova_ltsemibold',Arial,Helvetica,sans-serif;" >  REVOLVER STUDIOS </span> </a>

</div>



		<!--<footer>
        	<div class="wrapper">
				<div class="logo"></div>

				<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer', 'menu_class' => 'menu' ) ); ?>

				<div class="clear"></div>
			</div>
     	</footer>-->

     	<div id="nygov-universal-footer" class="nygov-universal-container">
		    <noscript>
		        <iframe id="nygov-universal-footer-frame" class="nygov-universal-container" width="100%" height="200px" src="//static-assets.ny.gov/load_global_footer/ajax?iframe=true" data-updated="2014-11-07 08:30" frameborder="0" style="border:none; overflow:hidden; width:100%; height:200px;" scrolling="no">
		            Your browser does not support iFrames
		        </iframe>
		    </noscript>
		</div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
