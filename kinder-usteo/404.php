<?php get_header(); ?>

<div class="not-found-page">
	<div class="container">
		<div class="row">			
			<div class="col-xs-12">				
				<div class="nf-text">
					<div class="nf-big">404</div>
					<div class="nf-small">Страница не найдена...</div>
				</div>
				<div class="img-block">
					<img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/kids6.png" alt="Страница не найдена">
				</div>	
				<div class="to-main-link">
					<a href="<?php echo home_url();?>" title="На главную страницу">На главную страницу</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
