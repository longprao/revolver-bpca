<div class="gallery">
    <div id="home_slider" class="flexslider">
        <ul>
            <li>
                <div class="slides">
                    <div class="slides_content">
						<div class="social-block-slider">
							<p><a href="https://twitter.com/bpca_ny" target="_blank" class="social-icon-link"><i class="fa fa-twitter fa-3x"></i></a>&nbsp;&nbsp;<a href="https://www.facebook.com/bpca.ny" target="_blank" class="social-icon-link"><i class="fa fa-facebook fa-3x"></i></a> &nbsp;&nbsp;</p>
							
							<p class="html-slider-text" id="social-slide">Stay in the loop with social media</p>
						</div>
                    </div>
                </div>
            </li>

            <li>
                <div class="slides">
                    <div class="slides_content">
                        <div class="social-block-slider">
	                        <form id="sf_widget_constantcontact_2_form" class="constantcontactwidget_form" onsubmit="return sf_widget_constantcontact_2_submit(this);">
		                        <input type="hidden" value="General Interest" name="grp">
		                        
		                        <input class="input" type="text" placeholder="ENTER EMAIL ADDRESS" name="eml">
		                        
		                        <input type="submit" value="SIGN UP">
	                        </form>
	                        
	                        <p class="html-slider-text" id="news-slide">Stay informed by signing up for our newsletter</p>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="slides">
                    <div class="slides_content">
                        <div class="bpcp-block-slider">
	                        <p><a href="http://bpcparks.org" target="_blank" class="img-swap">&nbsp;</a></p>
	                        
	                        <p class="html-slider-text" id="parks-slide">Check out what's happening in the Parks</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($){
		$('#home_slider').flexslider({
			animation: "slide",
			controlNav: true,
			animationLoop: true,
			slideshow: true,
			itemWidth: '100%',
			itemMargin: 0,
			move: 1,
			startAt: 0,
			minItems: 1,
			maxItems: 1, 
		    start: function(slider){
		        $('.flexslider').resize();
		    }
		});
	});
</script>