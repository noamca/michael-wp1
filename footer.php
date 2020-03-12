<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OZD_Studio
 */

?>
	<!-- FOOTER message
	================================================== -->
		 
	<section id="footer_message" class="bg_color_alt text-center">
	<h4><?php the_field('contact_header', pll_current_language('slug')); ?></h4>
	</section>	

	<!-- FOOTER contact details
	================================================== -->
		 
	<section id="footer_contact_details" class="text-center">
		<div class="container">
			<h3 class=""><?php the_field('form_header', pll_current_language('slug')); ?></h3>
			<div><?php  echo get_the_title( get_field('contact_person', 'option') -> ID )?></div>
			<div class="strong"><a href="tel:<?php the_field('contact_phone', 'option'); ?>"><?php the_field('contact_phone', 'option'); ?></a></div>
			<div class="strong"><a href="tel:<?php the_field('contact_phone_2', 'option'); ?>"><?php the_field('contact_phone_2', 'option'); ?></a></div>
			<hr>
			<p class="strong"><a href="mailto:<?php the_field('contact_email', 'option'); ?>"><?php the_field('contact_email', 'option'); ?></a></p>
			<div class="container-social">
				<a href="<?php the_field('contact_linkedin', 'option'); ?>" class="badge social-icon" target="_blank"><i class="fa fa-linkedin"></i></a>			
				<a href="<?php the_field('contact_facebook', 'option'); ?>" class="badge social-icon" target="_blank"><i class="fa fa-facebook"></i></a>		
			</div>
		</div>
	</section>
	
	<!-- FOOTER contact
	================================================== -->
		 
	<section id="footer_contact" class="bg_color text-center">
		<div class="container">
				<h3 class=""><?php _e("לשליחת הודעה", "ozd-studio"); ?></h3>
				<?php echo do_shortcode('[cf7-form cf7key="heb"]') ?>					
		</div>
	</section>
	
	<!------------------------------ 
			Offices
	------------------------------->
	<section id="offices" class="text-center">
		<div class="container">
			<h3 class="section-header"><?php the_field('office_header', pll_current_language('slug')); ?></h3>
			<div class="row">
				<?php $post_objects = get_field('contact_offices', 'option');?>
				<?php if( $post_objects ): ?>
					<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
						<?php setup_postdata($post);?>
							<div class="office col-md-4 text-right mobile-center mobile-colmns">
								<div class="header">
									<h4 class=""><?php the_title(); ?></h4>
									<p class=""><?php the_field('office_address') ?></p>						
								</div>
								<div class="img-container">
										<img src="<?php the_post_thumbnail_url() ?>" alt="">
								</div>
							</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>				
			</div>
		</div>
	</section>		
</div><!-- #content -->

	<!-- FOOTER
	================================================== -->
	<footer>
		<div class="container">
		<p><?php _e("כל הזכויות שמורות ל", "ozd-studio"); ?><a href="<?php echo esc_url( site_url() ); ?>" ><?php _e("-ERS", "ozd-studio"); ?></a> | <?php _e("עיצוב אתר", "ozd-studio"); ?> <a href="http://www.hollestudio.co.il" target="_blank">HolleStudio</a> | <?php _e("פיתוח אתר", "ozd-studio"); ?> <a href="http://www.ozdstudio.com" target="_blank">OZD Studio</a></p>
		</div><!-- container -->
	</footer>
</div><!-- #page -->
<script>
	
	
function changeCurency(sel){
	var theField = jQuery(sel).parents('.asset-price').find('.asset-price-no');
	var currentValue = jQuery(theField).attr('value');
	var FromCurrency = jQuery(theField).attr('curency');
	var ToCurrency = sel.value;
	jQuery(theField).attr('curency', ToCurrency);
	var demo = function(data) {
		fx.base = "EUR";
		fx.rates = data.rates;
		var rate = fx(currentValue).from(FromCurrency).to(ToCurrency);
		jQuery(theField).html(rate.toLocaleString( undefined, { maximumFractionDigits: 0 }));
		jQuery(theField).attr('value',rate);
	}

	$.getJSON("https://api.fixer.io/latest", demo);
}
	
jQuery(window).load(function() {
	$('.ajax_load_asset').on('click',function(){
		$('.ajax_load_asset').removeClass('active');
		$(this).addClass('active');
		$('.asset-full').empty();
		$('.asset-full').css({ opacity: '0', height: '0'});
		
		var theId = $(this).attr('id');
		var div1 = $(this).parents('.col-md-4').nextAll('.col-md-12.mobile-only:first');
		var div2 = $(this).parents('.col-md-4').nextAll('.col-md-12.desktop-only:first');

		$.post(
			'<?php echo admin_url('admin-ajax.php'); ?>',
			{ action:'my_get_posts',post_id: theId },
			function(data){ 
				
				div1.html(data);
				div2.html(data);				
				heightToAuto(div1);
				heightToAuto(div2);
				
				$('.asset').css('opacity',1);
			}
		);
		if ($(window).width() < 991) {
			$('html, body').delay(100).animate({
				scrollTop: div1.offset().top - $('.navbar').outerHeight()
			}, 800,'swing');
		}
		else {
			$('html, body').delay(100).animate({
				scrollTop: div2.offset().top - $('.navbar').outerHeight()
			}, 800,'swing');
		}
		return false;
	});
	$('.spinner-hide').css('opacity',1);				
});
	
function heightToAuto($this){
	var eh = $this.outerHeight();
	$this.css('height', 'auto');
	var ah = $this.outerHeight();
	$this.css('height', eh);
	$this.animate({ opacity: '1', height: ah});
}

</script>
<?php wp_footer(); ?>
					
<!-- JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->   
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/swiper.jquery.min.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/jquery.easydropdown.min.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/money.min.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/wNumb.js"></script>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/js/ozd.js"></script>


</body>
</html>
