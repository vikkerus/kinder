<!-- Post Start -->
	<article <?php post_class('kinder-post'); ?> id="post-<?php the_ID(); ?>">	
		<div class="kinder-single-img"><?php the_post_thumbnail();?></div>
		<h2 class="kinder-single-title"><?php the_title();?></h2>	
		<div class="kinder-single-text"><?php the_content();?></div>		
	</article>
<!-- Post End -->