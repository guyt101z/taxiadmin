<?php if ( ( get_option('flow_featured_slideshow') == 0 && is_front_page() && wp_count_posts('slideshow')->publish >= 1 ) || ( $_SERVER['SERVER_NAME'] == 'themes.devatic.com' && $_GET['featured'] ) ) { ?>
	<script type="text/javascript">
		var featuredScroll;
		var current_slide = 0; // Initial slide is always 0
		var number_of_slides; // each slide has id="slide_0", id="slide_1" etc.
		var autoplayTime = 4000; // False or Integer (ms)
		var autoplayTimeoutHandle = false;
		var mouseWheel = false; // False or Integer (0 = enabled, 1 = disabled)
		var slideshowWidth = jQuery(window).width();
		var newVals = [];
		
		/**
		 * Setup iScroll 4
		 * @return {void} Updates featuredScroll variable 
		 */
		function setup_iscroll(){
			featuredScroll = new iScroll('featured_slideshow_wrapper', {
				snap: 'li',
				bounce: false,
				bounceLock: false,
				momentum: false,
				hScrollbar: false,
				vScrollbar: false,
				hScroll: true,
				vScroll: false,
				wheelAction: 'scroll',
				onScrollMove: function(){ },
				onScrollEnd: function(){
					featuredHideArrows();
					featuredAddCurrentClass();
					featuredPlayPauseVideos();
					autoplay_flow();
			
					if(jQuery('#slide_' + featuredScroll.currPageX).attr('data-cursor-color') == 'featured-cursor-black'){
						jQuery('.konzept_arrow_left, .konzept_arrow_right, .featured-close').addClass('featured-cursor-black');
					}else{
						jQuery('.konzept_arrow_left, .konzept_arrow_right, .featured-close').removeClass('featured-cursor-black');
					}
				},
				onRefresh: function(){ },
			});
			number_of_slides = featuredScroll.pagesX.length;
			featuredHideArrows();
			return;
		}
		document.addEventListener('DOMContentLoaded', setup_iscroll, false);

		// Pause all videos
		function featuredPauseAllVideos(){
			jQuery('.featured_slideshow-slide video').each(function(){
				if(this.pause){
					this.pause();
				}
			});
		}
		
		// Play/Pause videos
		function featuredPlayPauseVideos(){
			featuredPauseAllVideos();
			playVideos(featuredScroll.currPageX);
		}
		
		// Add featured-current-slide CSS class
		function featuredAddCurrentClass(){
			jQuery('.featured_slideshow-slide').removeClass('featured-current-slide');
			jQuery('.featured_slideshow-slide').eq(featuredScroll.currPageX).addClass('featured-current-slide');
		}
		
		// Controls
		function featuredHideArrows(){
			if(featuredScroll.currPageX == (featuredScroll.pagesX.length - 1)){
				jQuery('.konzept_arrow_right').addClass('konzept_arrow_right-hide');
			}else{
				jQuery('.konzept_arrow_right').removeClass('konzept_arrow_right-hide');
			}
			if(featuredScroll.currPageX == 0){
				jQuery('.konzept_arrow_left').addClass('konzept_arrow_left-hide');
			}else{
				jQuery('.konzept_arrow_left').removeClass('konzept_arrow_left-hide');
			}
		}
		
		/**
		 * Scroll left or right.
		 * @TODO(Flow): invent better name and method for handling this.
		 * @return {void}
		 */
		function scrollSlides(){
			if(featuredScroll === 'undefined'){
				return;
			}
			if(jQuery('#slide_' + current_slide).attr('data-cursor-color') == 'featured-cursor-black'){
				jQuery('.konzept_arrow_left, .konzept_arrow_right, .featured-close').addClass('featured-cursor-black');
			}else{
				jQuery('.konzept_arrow_left, .konzept_arrow_right, .featured-close').removeClass('featured-cursor-black');
			}

			featuredScroll.scrollToPage(current_slide, 0, 300);
			
			return;
		}
		
		function isInt(number){
			var intRegex = /^\d+$/;
			if(intRegex.test(number)){
				return true;
			}
			return false;
		}
		function slideshow_next_slide(){
			current_slide = featuredScroll.currPageX + 1;
			if(featuredScroll.currPageX == (featuredScroll.pagesX.length - 1)){
				current_slide = 0;
			}

			scrollSlides();
		}
		function slideshow_prev_slide(){
			current_slide = featuredScroll.currPageX - 1;
			if(featuredScroll.currPageX == 0){
				current_slide = featuredScroll.pagesX.length - 1;
			}

			scrollSlides();
		}
		function autoplay_flow(){
			if(autoplayTime){
				if(!isInt(autoplayTime) || autoplayTime == 0){
					autoplayTime = 12000;
				}
				if(autoplayTimeoutHandle){
					clearTimeout(autoplayTimeoutHandle);
				}
				autoplayTimeoutHandle = setTimeout(function(){
					slideshow_next_slide();
					autoplayTimeoutHandle = false;
					autoplay_flow();
				}, autoplayTime);
			}
		}
		
		/**
		 * Utility functions.
		 */
		function pauseVideos(current_slide){
			if(jQuery('#slide_' + current_slide + ' video').get(0)){
				if(jQuery('#slide_' + current_slide + ' video').get(0).pause){
					jQuery('#slide_' + current_slide + ' video').get(0).pause();
				}
			}
		}	
		function playVideos(current_slide){
			if(jQuery('#slide_' + current_slide + ' video').get(0) && !jQuery('html').hasClass('mod-touch')){
				if(jQuery('#slide_' + current_slide + ' video').get(0).play){
					jQuery('#slide_' + current_slide + ' video').get(0).play();
				}
			}
		}
		
	function featuredCenterImages(){
		jQuery('.slide-img').each(function(){
			var image = jQuery(this);
			var image_dom = jQuery(this).get(0);
			jQuery('<img />').attr('src', image.attr('src')).load(function(){
				image.attr('data-real-width', jQuery(this).get(0).width);
				image.attr('data-real-height', jQuery(this).get(0).height);
				var realWidth = image.attr('data-real-width');
				var realHeight = image.attr('data-real-height');
				var currentWidth = image.width();
				var currentHeight = image.height();
				var windowWidth = jQuery(window).width();
				var windowHeight = jQuery(window).height();
				var screen_ratio = windowWidth / windowHeight;
				var image_ratio = realWidth / realHeight;
				
				// Fullscreen
				if(image_ratio < screen_ratio){ // vertical like 1:3 < 4:3
					image.css({'width' : '100%', 'max-width' : 'none', 'height' : 'auto', 'max-height' : 'none'});
					var currentHeight = image.height();
					if(currentHeight > windowHeight){
						var top = -((currentHeight - windowHeight)/2);
						image.css({'top' : top, 'left' : 0});
					}
				}else{ // horizontal
					image.css({'width' : 'auto', 'max-width' : 'none', 'height' : '100%', 'max-height' : 'none'});
					var currentWidth = image.width();
					if(currentWidth > windowWidth){
						var left = -((currentWidth - windowWidth)/2);
						image.css({'top' : 0, 'left' : left});
					}
				}
				image.closest('.featured_slideshow-slide').addClass('featured_slideshow-slide-visible');
			});
		});
	}
	
	/**
	 * This positions <video> in the middle.
	 * It is suitable only when video doesn't have controls and has to look nice rather than be very functional.
	 */
	function featuredCenterVideos(){
		jQuery('#featured_thelist video').on('loadedmetadata', function(){
			var video = jQuery(this);
			var videoDOM = this;
			var windowWidth = jQuery(window).width();
			var windowHeight = jQuery(window).height();
			var videoWidth = videoDOM.videoWidth,
				videoHeight = videoDOM.videoHeight;
			var video_ratio = videoWidth / videoHeight;
			var screen_ratio = windowWidth / windowHeight;
			
			jQuery(this).attr('data-real-width', videoWidth);
			jQuery(this).attr('data-real-height', videoHeight);
			
			jQuery(window).on('resize.featuredslideshowvideo', function(){
				var windowWidth = jQuery(window).width();
				var windowHeight = jQuery(window).height();
				var screen_ratio = windowWidth / windowHeight;
				// Fullscreen
				video.removeClass('video-width-auto');
				video.removeClass('video-height-auto');
				if(video_ratio < screen_ratio){ // vertical like 1:3 < 4:3
					video.addClass('video-height-auto');
					//video.css({'width' : '100%', 'max-width' : 'none', 'height' : 'auto', 'max-height' : 'none'});
					var currentHeight = video.height();
					if(currentHeight > windowHeight){
						var top = -((currentHeight - windowHeight)/2);
						video.css({'margin-top' : top, 'margin-left' : 0});
					}
				}else{ // horizontal
					video.addClass('video-width-auto');
					//video.css({'width' : 'auto', 'max-width' : 'none', 'height' : '100%', 'max-height' : 'none'});
					var currentWidth = video.width();
					if(currentWidth > windowWidth){
						var left = -((currentWidth - windowWidth)/2);
						video.css({'margin-top' : 0, 'margin-left' : left});
					}
				}
			}).trigger('resize');
			video.closest('.featured_slideshow-slide').addClass('featured_slideshow-slide-visible');
		}).trigger('loadedmetadata');
	}
	
	/**
	 * Setups <video> tag for slides.
	 * This function prevents slideshow from working temporarily and enables "watching video" mode.
	 */
	function setupFeaturedVideos(){
		if(Modernizr.touch){
			jQuery('.featured-slideshow-video').each(function(){
				jQuery(this).remove();
			});
			return;
		}
		/* jQuery('.featured_slideshow-slide-video').each(function(){
			var slide = jQuery(this);
			var playButton = slide.find('.play');
			var videoContainer = slide.find('.video-wrapper');
			var description = slide.find('.description');
			var exit = videoContainer.find('.exit');
			var mainExit = slide.closest('#featured_slideshow').find('.featured-close');
			
			var videoCodeMp4 = videoContainer.attr('data-video-mp4');
			var videoCodeOgg = videoContainer.attr('data-video-ogg');
			var videoCodeWebm = videoContainer.attr('data-video-webm');
			var videoCodePoster = videoContainer.attr('data-video-poster');
			var videoMp4 = jQuery('<source type="video/mp4"></source>').attr('src', videoCodeMp4);
			var videoOgg = jQuery('<source type="video/ogg; codecs=&quot;theora, vorbis&quot;"></source>').attr('src', videoCodeOgg);
			var videoWebm = jQuery('<source type="video/webm; codecs=&quot;vp8, vorbis&quot;"></source>').attr('src', videoCodeWebm);
			var video = jQuery('<video type="text/html" controls="" preload="auto">').attr('poster', videoCodePoster).append(videoMp4).append(videoOgg).append(videoWebm);
				
			// Fullscreen Poster Image before video
			var poster = jQuery('<img class="" />').attr('src', videoCodePoster).load(function(){
				var poster_img = this;
				centerVideoPoster(poster_img);
				jQuery(window).resize(function(){
					centerVideoPoster(poster_img);
				});
			});
			videoContainer.append(poster);
			
			playButton.on('click', function(){
			
				if(moved){
					return;
				}
				
				// Project arrows
				if(jQuery('.project-arrow-left').hasClass('project-arrow-left-visible')){
					var projectLeftHadClass = true;
					jQuery('.project-arrow-left').removeClass('project-arrow-left-visible');
				}else{
					var projectLeftHadClass = false;
				}
				if(jQuery('.project-arrow-right').hasClass('project-arrow-right-visible')){
					var projectRightHadClass = true;
					jQuery('.project-arrow-right').removeClass('project-arrow-right-visible');
				}else{
					var projectRightHadClass = false;
				}
				
				// Portfolio arrows
				if(jQuery('.portfolio-arrowleft').hasClass('hide-arrow')){
					var portfolioLeftHadClass = true;
				}else{
					var portfolioLeftHadClass = false;
					jQuery('.portfolio-arrowleft').addClass('hide-arrow');
				}
				if(jQuery('.portfolio-arrowright').hasClass('hide-arrow')){
					var portfolioRightHadClass = true;
				}else{
					var portfolioRightHadClass = false;
					jQuery('.portfolio-arrowright').addClass('hide-arrow');
				}
				
				myScroll.disable();
				videoContainer.append(video);
				video.get(0).play();
				slide.addClass('watching-video');
				playButton.hide();
				description.hide();
				poster.hide();
				mainExit.hide();
				exit.addClass('exit-visible');
				exit.on('click', closeVideoOnEnd);
				video.on('ended', closeVideoOnEnd);
				
				function closeVideoOnEnd(){
					// Project arrows
					if(projectLeftHadClass){
						jQuery('.project-arrow-left').addClass('project-arrow-left-visible');
					}
					if(projectRightHadClass){
						jQuery('.project-arrow-right').addClass('project-arrow-right-visible');
					}
					
					// Portfolio arrows
					if(!portfolioLeftHadClass){
						jQuery('.portfolio-arrowleft').removeClass('hide-arrow');
					}
					if(!portfolioRightHadClass){
						jQuery('.portfolio-arrowright').removeClass('hide-arrow');
					}
					slide.removeClass('watching-video');
					myScroll.enable();
					playButton.show();
					video.remove();
					video = jQuery('<video type="text/html" controls="" preload="auto">').attr('poster', videoCodePoster).append(videoMp4).append(videoOgg).append(videoWebm);
					description.show();
					poster.show();
					mainExit.show();
					exit.removeClass('exit-visible');
					exit.unbind('click');
				}
			});
		}); */
	}
	jQuery(document).ready(function(){
		setupFeaturedVideos();
	});

	jQuery(document).ready(function(){
		jQuery("body").addClass("has-featured-slideshow");
	
		jQuery('.pf_nav li a').on('click', function(e){
			jQuery("body").removeClass("has-featured-slideshow");
			
			// Pause all videos
			jQuery('#featured_thelist video').each(function(){
				if(this.pause){
					this.pause();
				}
			});
			
			// Remove the slideshow
			featuredScroll.destroy();
			jQuery('#featured_thelist').remove();
			jQuery(window).unbind('resize.featuredslideshowvideo');
			jQuery(".konzept_arrow_left").unbind('click.featuredslideshow');
			jQuery(".konzept_arrow_right").unbind('click.featuredslideshow');
			jQuery("#featured_slideshow").unbind('mousewheel.featuredslideshow');
			jQuery(window).unbind('keydown.featuredslideshow');
			jQuery(window).unbind("resize.resizefeaturedSlideshow");
		});

		jQuery('.featured-close').on('click', function(){
			jQuery("body").removeClass("has-featured-slideshow");
			jQuery('.pf_nav li a').removeClass('selected');
			jQuery('.pf_nav li:first-child a').addClass('selected');
			var categorySelector = '*';
			jQuery('.thtitled-thtitle, .konzept-thumbnail').addClass('thumb-inactive');
			jQuery(categorySelector).removeClass('thumb-inactive');
			
			jQuery('body').addClass('viewing-portfolio-grid');
			jQuery('.portfolio-container').css({'margin-top' : ''});
			
			// Pause all videos
			jQuery('#featured_thelist video').each(function(){
				if(this.pause){
					this.pause();
				}
			});
			
			// Remove the slideshow
			featuredScroll.destroy();
			jQuery('#featured_thelist').remove();
			jQuery(window).unbind('resize.featuredslideshowvideo');
			jQuery(".konzept_arrow_left").unbind('click.featuredslideshow');
			jQuery(".konzept_arrow_right").unbind('click.featuredslideshow');
			jQuery("#featured_slideshow").unbind('mousewheel.featuredslideshow');
			jQuery(window).unbind('keydown.featuredslideshow');
			jQuery(window).unbind("resize.resizefeaturedSlideshow");
		});

		// Set dimensions
		jQuery(".featured_slideshow-slide").css({ 'width' : jQuery(window).width() });
		jQuery('#featured_thelist').css({ 'width' : (jQuery('.featured_slideshow-slide').length * jQuery(window).width()) });

		// Window resizing adjustments
		function resizeSlideshow(){
			jQuery(".featured_slideshow-slide").css({ 'width' : jQuery(window).width() });
			
			jQuery('.featured_slideshow-slide.fit').each(function(index, element){
				var fitToWidth = jQuery(this).find('img').width();
				jQuery(this).css({ 'max-width' : fitToWidth });
			});
			setTimeout(function (){
				// This is used in featuredScroll.maxScrollX
				var totalWidth = 0;
				jQuery('.featured_slideshow-slide').each(function(){
					totalWidth += jQuery(this).width();
				});
				jQuery('#featured_thelist').css({ 'width' : totalWidth });
				
				// Refresh!
				featuredScroll.refresh();
				
				// Make sure to center the slideshow in the correct place after resize
				featuredScroll.scrollTo(featuredScroll.pagesX[featuredScroll.currPageX], 0, 0);
			}, 0);
			
		}
		jQuery(window).bind("resize.resizefeaturedSlideshow", function(){
			resizeSlideshow();
			featuredCenterImages();
		});
		featuredCenterImages();
		featuredCenterVideos();
		
		// Autoplay
		autoplay_flow();
		
		// Create controls (keyboard, mousewheel, mouse click)
		// Mouse click
		jQuery(".konzept_arrow_left").on('click.featuredslideshow', function(){
			slideshow_prev_slide();
		});
		jQuery(".konzept_arrow_right").on('click.featuredslideshow', function(){
			slideshow_next_slide();
		});
		
		// Mousewheel
		if(mouseWheel != 1){
			jQuery("#featured_slideshow").on('mousewheel.featuredslideshow', function(event, delta){
				var dir = delta > 0 ? slideshow_prev_slide() : slideshow_next_slide();
				event.preventDefault();
			});
		}
		
		// Keyboard
		/* jQuery(window).on('keydown.featuredslideshow', function(e){
			if(e.keyCode == 37 || e.keyCode == 38){
				slideshow_prev_slide();
			}else if(e.keyCode == 39 || e.keyCode == 40){
				slideshow_next_slide();
			}
		}); */
	});
	</script>
	<div id="featured_slideshow">
		<div id="featured_slideshow_wrapper">
			<div id="featured_scroller">
				<ul id="featured_thelist">
					<?php 
					$args = array('post_type' => 'slideshow', 'posts_per_page' => -1);
					$recent = new WP_Query($args);
					while($recent->have_posts()){ $recent->the_post();
						
						// Slide link
						if(get_post_meta($post->ID, 'slide-link', true)){
							$slide_link = get_post_meta($post->ID, 'slide-link', true);
						}else{
							$slide_link = get_permalink();
						}
						
						// Slide link name
						if(get_post_meta($post->ID, 'slide-link-name', true)){
							$slide_link_name = get_post_meta($post->ID, 'slide-link-name', true);
						}else{
							$slide_link_name = '';
						}
						
						// Title
						if(get_post_meta($post->ID, 'flow_post_title', true)){
							$page_title = get_post_meta($post->ID, 'flow_post_title', true); 
						}else if(get_post_meta($post->ID, 'Title', true)){
							$page_title = get_post_meta($post->ID, 'Title', true);
						}else{
							$page_title = get_the_title();
						}
						
						// Description
						if(get_post_meta($post->ID, 'flow_post_description', true)){
							$page_description = get_post_meta($post->ID, 'flow_post_description', true); 
						}else if(get_post_meta($post->ID, 'Description', true)){
							$page_description = get_post_meta($post->ID, 'Description', true); 
						}else{ 
							$page_description = '';
						}
						
						// Slide image
						if(get_post_meta($post->ID, 'slide-image', true)){
							$slide_image = get_post_meta($post->ID, 'slide-image', true);
						}else{
							$slide_image = '';
						}
						
						$slide_button_text_color = '';
						if($button_color = get_post_meta($post->ID, 'slide-button-text-color', true)){
							$slide_button_text_color = 'color: ' . $button_color . ';';
						}
						
						if(!($slide_title_text_color = get_post_meta($post->ID, 'slide-title-text-color', true))){
							$slide_title_text_color = '#fff';
						}
						
						if(!($slide_description_text_color = get_post_meta($post->ID, 'slide-description-text-color', true))){
							$slide_description_text_color = '#fff';
						}
						
						if(isset($slide_id)){ $slide_id++; }else{ $slide_id = 0; }
						
						// Video slide
						$video_mp4 = $video_ogg = $video_webm = '';
						$video_mp4 = get_post_meta($post->ID, 'slide-video-mp4', true);
						$video_ogg = get_post_meta($post->ID, 'slide-video-ogg', true);
						$video_webm = get_post_meta($post->ID, 'slide-video-webm', true);
						
						// Cursor Color
						$cursor_color = get_post_meta($post->ID, 'slide-cursor-color', true);
						if($cursor_color == 'black'){
							$cursor = 'featured-cursor-black';
						}else{
							$cursor = '';
						}
						
						$video_slide = false;
						if($video_mp4 != '' || $video_webm != '' || $video_ogg != ''){
							$video_slide = true;
						}
						
						//Display slides
						if($slide_image){ ?>
							<li id="slide_<?php echo $slide_id; ?>" class="featured_slideshow-slide <?php if($video_slide){ ?>featured_slideshow-slide-video<?php } ?>" data-cursor-color="<?php echo $cursor; ?>">
								<div class="featured_slideshow-meta-wrapper">
									<div class="featured_slideshow-meta-inner">
										<div class="featured_slideshow-meta-inner-2">
											<h1 class="featured_slideshow-meta-title" style="color: <?php echo $slide_title_text_color; ?>;"><?php echo $page_title; ?></h1>
											<h4 class="featured_slideshow-meta-description" style="color: <?php echo $slide_description_text_color; ?>;"><?php echo $page_description; ?></h4>
											<?php if($slide_link_name != ''){ ?>
												<div class="slideshow-button-wrapper">
													<a href="<?php echo $slide_link; ?>" class="featured_slideshow-button" style="<?php echo $slide_button_text_color; ?>"><?php echo $slide_link_name; ?></a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if($video_slide){ ?>
									<div class="featured-slideshow-video">
										<?php echo do_shortcode('[video mp4="' . $video_mp4 . '" ogv="' . $video_ogg . '" webm="' . $video_webm . '" poster="' . $slide_image . '" preload="true" autoplay="" loop="true" controls="false"]'); ?>
										<?php //<div class="play"></div> ?>
									</div>
								<?php } ?>
								<img class="slide-img" style="position: absolute; clear: both;" src="<?php echo $slide_image; ?>" alt="<?php echo $page_title; ?>" />
								<div class="featured_slideshow-background"></div>
							</li>
						<?php } ?>
					<?php } // endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</div>
		<div class="featured-close"></div>
		<div class="konzept_arrow_left"></div>
		<div class="konzept_arrow_right"></div>
	</div>
<?php } ?>