<?php get_header();?>
	<div class="column-wrapper">
		<div class="container">
			<div class="row">				
				<div class="col-xs-12 col-sm-5 col-md-3">
					<div class="aside-column">
						<?php get_template_part( 'template-parts/special');?>
						
						<?php dynamic_sidebar( 'kd-sidebar' ); ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-7 col-md-9">
					<div class="main-column">
						<?php
							while ( have_posts() )
							{					
								the_post();

								get_template_part( 'template-parts/content', 'page');
								
								if ( comments_open() || get_comments_number() )
								{
									comments_template();
								}
							}	
						?>					
					</div>
				</div>
			</div>
		</div>
	</div>	
<?php get_footer();