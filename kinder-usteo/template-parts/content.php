<!-- Post Start -->
	<article <?php post_class('kinder-post'); ?> id="post-<?php the_ID(); ?>">
		
		<?php if ( is_singular() ) : ?>
			<div class="kinder-single-img"><?php the_post_thumbnail();?></div>
			<h2 class="kinder-single-title"><?php the_title();?></h2>	
			<div class="kinder-single-text"><?php the_content();?></div>
			<div class="kinder-single-date">
				<span><?php the_time('j M Y'); ?></span>			
			</div>
		
		<?php else : ?>
		
			<a href="<?php the_permalink(); ?>" class="kinder-img">
				<?php if ( has_post_thumbnail() )
				{
					the_post_thumbnail(); 
				} ?>
			</a>
			<div class="kinder-post-info <?php echo (has_post_thumbnail()) ? '' : 'kinder-no-thumb'?>">
				<h2 class="kinder-post-title">
					<a title="<?php printf( esc_attr__( '%s', 'striped' ), the_title_attribute( 'echo=0' ) ); ?>" href="	<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?>
					</a>	
				</h2>	
				<div class="kinder-post-text">
					<?php the_excerpt();?>
				</div>
			</div>
			<div class="kinder-post-date">
				<span><?php the_time('j M Y'); ?></span>			
			</div>	
		
		<?php endif;?>
	</article>
<!-- Post End -->