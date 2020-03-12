<?php
/**
 * The projs
 *
 * @package OZD_Studio
 */
?>
<div class="projects_text"><?php echo get_field('projects_text', 'option'); ?></div>


<div class="row">
	<div class="col-md-3 text-right">
		<div class="post_nav text-right">
			<a href="<?php echo esc_url( site_url() ); ?>/projects"class="back"></a>
			<a href="<?php echo next_post_href('project'); ?>" class="prev"></a>
			<a href="<?php echo prev_post_href('project'); ?>" class="next"></a>	
		</div>
		
		<h1 class="proj_title"><?php the_title(); ?></h1>
		<div class="proj_text"><?php the_content(); ?></div>
	</div>
	<div class="proj_gallery col-md-9">
	
		<?php if( have_rows('project_video_I') ): while ( have_rows('project_video_I') ) : the_row();?>
			<div class="embed-container">
				<?php the_sub_field('project_video'); ?>
			</div>			
		<?php endwhile;endif;?>
	
		<?php if(get_field('project_gallery')) : $images = get_field('project_gallery'); foreach( $images as $image ): ?>
			<div class="proj-img margin-bottom">
				<img class="" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
			</div>
		<?php endforeach; endif?>
		
			<?php if( have_rows('project_video_II') ): while ( have_rows('project_video_II') ) : the_row();?>
			<div class="embed-container">
				<?php the_sub_field('project_video'); ?>
			</div>			
		<?php endwhile;endif;?>
	</div>	
</div>