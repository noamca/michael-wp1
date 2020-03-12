<?php

/**
 * Template Name: Home Page
 *
 * @package OZD_Studio
 */

get_header(); ?>

<!------------------------------ 
		HOME Slider
------------------------------->
<div id="video-player" class="fullscreen-bg video-player" style="background-image: url(<?php the_field('home_movies_bg'); ?>)">
<?php if (wp_is_mobile()): ?>

<?php else: $videos = get_field('home_movies');
	foreach($videos as $video){
		echo '<video class="video" muted preload="auto">
				<source src="'. wp_get_attachment_url( $video ) . '" type="video/mp4" poster="' . get_field('home_movies_bg') .'">
			</video>';
	}
	?>
	<script>
		jQuery(function(){
 			$('video').each(function(){this.playbackRate = 1.0;})

			$('.video-player').each(function(){
				var VideoPlayer = $(this),
					PlayList = $(this).children('.video'),
					i;
				$(this).children('video:first-child').addClass('current-video');
				$(this).children('video:first-child').get(0).play();
				
				for ( i = 0; i < PlayList.length; i++ ) {
					PlayList[i].addEventListener('ended', function(i){
						
						$(this).removeClass('current-video');
						
						if( $(this).siblings('video').length == $(this).index('video') ){
							
							$(this).siblings('video:first-child').addClass('current-video');
							
						} else {
							
							$(this).next('video').addClass('current-video');
						}
						
						$('.current-video').get(0).play();
						
					});
				}
			});
		});	
			
	</script>
<?php endif ?>
</div>
<!------------------------------ 
		HOME Search
------------------------------->
	<div id="home_search" class="container text-center">
		<h1><?php the_field('home_title'); ?></h1>
			<?php get_search_form(); ?>	
	</div>
<!------------------------------ 
		About
------------------------------->
<section id="three_cols">
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-right mobile-center mobile-colmns">
			<div class="icon-container">
									<img src="<?php echo get_field('icon_1') ['url']; ?>" alt="">
			</div>
			<div class="icon-title">
									<h4 class=""><?php the_field('icon_title_1'); ?></h4>
									<p class=""><?php the_field('icon_text_1') ?></p>						
			</div>
			</div>
			
			<div class="col-md-4 text-right mobile-center mobile-colmns">
			<div class="icon-container">
									<img src="<?php echo get_field('icon_2') ['url']; ?>" alt="">
			</div>
			<div class="icon-title">
									<h4 class=""><?php the_field('icon_title_2'); ?></h4>
									<p class=""><?php the_field('icon_text_2') ?></p>						
			</div>
			</div>
			
			<div class="col-md-4 text-right mobile-center mobile-colmns">
			<div class="icon-container">
									<img src="<?php echo get_field('icon_3') ['url']; ?>" alt="">
			</div>
			<div class="icon-title">
									<h4 class=""><?php the_field('icon_title_3'); ?></h4>
									<p class=""><?php the_field('icon_text_3') ?></p>						
			</div>
			</div>
	</div>
</section>

<section id="home_about" class="mobile-center">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h2 class="mobile-only"><?php the_field('home_about_title'); ?></h2>
				<div class="mobile-padding">
					<div class="img-container mobile-margin-bottom">
						<img src="<?php echo get_field('home_about_image')['url']; ?>" alt="">
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<h2 class="desktop-only"><?php the_field('home_about_title'); ?></h2>
				<div><?php the_field('home_about_text'); ?></div>
			</div>
			<div class="col-md-2 float-bottom">
				<a href="<?php echo get_the_permalink(pll_get_post(92)); ?>" class="btn btn_grey"><?php _e("קראו עוד", "ozd-studio"); ?></a>	
						
			</div>
		</div>

	</div>
</section>

<!------------------------------ 
		Assets
------------------------------->
<section id="home_assets" class="text-center bg_color">
	<div class="container">
		<h2 class="section-header"><?php _e("הנכסים שלנו", "ozd-studio"); ?></h2>
		<div class="row">
		<?php $post_objects = get_field('home_assets');
			if( $post_objects ): $i = 1 ;
				foreach( $post_objects as $post): 
					setup_postdata($post);
					get_template_part( 'template-parts/content', 'asset' );
					if (($i % 3) == 0) { echo '<div class="col-md-12 desktop-only"></div>';}
					echo '<div class="col-md-12 mobile-only"></div>';
					$i ++ ;
				endforeach;
				echo '<div class="col-md-12 desktop-only"></div>';
				wp_reset_postdata(); 
			endif; 
		?>
		</div>
		<div><a href="<?php echo esc_url( site_url()) . (pll_current_language() == pll_default_language() ? '' : '/' . pll_current_language()) . '/asset/?cat=&area=&type=&s=&min=0&max=15000000' ;?>" class="btn btn_grey"><?php _e("לכל הנכסים", "ozd-studio"); ?></a></div>
	</div>
</section> 
<script>
	
</script>

<?php
get_footer();
