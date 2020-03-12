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
						<?php if ( have_posts() ) : $i = 0;?>
							<h1 class="kinder-page-title">
								<?php
								printf( esc_html__( 'Результаты поиска по: %s', 'kinder' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
							<?php
							
							while ( have_posts() ) :
								
								$i++;
						
								if ( $i > 1 )
								{
									echo '<span class="kinder-post-divider"></span>';
								}
						
								the_post();

								get_template_part( 'template-parts/content');

							endwhile;

							kinder_pagination();

						else : ?>
							
							<h1 class="kinder-page-title">
								<?php
								printf( esc_html__( 'Результаты поиска по: %s', 'kinder' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						
							<?php get_template_part( 'template-parts/nopost');

						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
<?php get_footer();

