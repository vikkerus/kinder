<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		
		<?php wp_head(); ?>
	</head>
	
	<?php $kid_color = get_theme_mod('kinder_site_color', 'green'); $kid_class = 'green-color';?>
						
	<?php

		switch ($kid_color)
		{								
			case 'green':

				$kid_class = 'green-color';

				break;

			case 'red':

				$kid_class = 'red-color';

				break;

			case 'blue':

				$kid_class = 'blue-color';

				break;

			case 'yellow':

				$kid_class = 'yellow-color';

				break;				

			default:

				$kid_class = 'green-color';
		}

	?>
	
	
	<?php $kid_header = get_theme_mod('kinder_site_back', 'kids'); $kid_header_class = 'head_kids';?>
	
	<?php

		switch ($kid_header)
		{								
			case 'kids':

				$kid_header_class = 'head_kids';

				break;

			case 'one':

				$kid_header_class = 'kid-one';

				break;

			case 'two':

				$kid_header_class = 'kid-two';

				break;

			case 'three':

				$kid_header_class = 'kid-three';

				break;						
			

			default:

				$kid_header_class = 'head_kids';
		}

	?>	
	
	<body <?php body_class($kid_header_class.' '.$kid_class); ?>>

		<?php wp_body_open();?>
		
		<?php 
		
			$age = get_theme_mod('kinder_age_textbox', 'hide');

			if($age != 'hide')
			{
				echo '<div class="kinder_age_control">'.$age.'</div>';
			}	
		?>
		
		<div id="vi_aside" class="vi_aside">			
			<div itemprop="copy"><?php dynamic_sidebar( 'bvi_sidebar' ); ?></div>					
		</div>
		
		<header class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="nav-block">
							<nav class="navbar_head navbar navbar-default">								
								<div class="navbar-header hidden-sm hidden-md hidden-lg">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#kid-menu" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>								
								</div>

								<div class="collapse navbar-collapse kid-menu" id="kid-menu">
									<?php /* Primary navigation */
									wp_nav_menu( array(				
										'theme_location' => 'kid_top_menu',
										'depth'          => 3,
										'fallback_cb' => '__return_empty_string',
										'menu_class'      => 'nav navbar-nav',
										'container' => false,
										'strcasecmp' => 1,
										'menu_class' => 'nav navbar-nav',
										'fallback_cb' => '__return_empty_string',
										//Process nav menu using our custom nav walker
										'walker' => new wp_bootstrap_navwalker())
									);
									wp_nav_menu( array(
										'theme_location' => 'kid_top_menu',
										'depth' =>  0,
										'container' => false,
										'menu_class' => 'dropdown-menu',
										'fallback_cb' => '__return_empty_string',
										//Process nav menu using our custom nav walker
										'walker' => new wp_bootstrap_navwalker())
									);
									?>

								</div>
								<div class="search-block">
									<?php get_search_form(); ?>															
								</div>
							</nav>
						</div>													
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="main-siteinfo">
							<div class="siteinfo-wrapper">
								<div class="site-title"><?php bloginfo( 'name' ); ?></div>
								
								<?php $kinder_description = get_bloginfo( 'description', 'display' );?>
								<div class="site-slogn"><?php echo $kinder_description;?></div>
								
								<?php $kinder_header_phone = get_theme_mod('kinder_header_phone');?>
								<div class="site-phone"><?php echo $kinder_header_phone;?></div>
								
								<?php $kinder_header_address = get_theme_mod('kinder_header_address');?>
								<div class="site-address"><?php echo $kinder_header_address;?></div>
							</div>
						</div>		
					</div>									
				</div>
			</div>
		</header>
