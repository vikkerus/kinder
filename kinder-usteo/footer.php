
<?php $kid_header = get_theme_mod('kinder_site_back', 'kids'); $kid_footer_class = '';?>


<?php

	switch ($kid_header)
	{								
		case 'kids':

			$kid_footer_class = '';

			break;

		case 'one':
			
			$kid_footer_class = 'kid-pen';

			break;
			
		case 'two':
			
			$kid_footer_class = 'kid-flo';

			break;
			
		case 'three':

			$kid_footer_class = 'kid-desk';

			break;				

		default:

			$kid_footer_class = '';
	}

?>	

<footer class="kid-footer <?php echo $kid_footer_class;?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="contacts">

					<?php $kinder_footer_phone = get_theme_mod('kinder_footer_phone');?>
					<div class="phone"><?php echo $kinder_footer_phone;?></div>

					<?php $kinder_footer_address = get_theme_mod('kinder_footer_address');?>
					<div class="address"><?php echo $kinder_footer_address;?></div>

					<?php $kinder_footer_email = get_theme_mod('kinder_footer_email');?>
					<div class="email"><?php echo $kinder_footer_email;?></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">

				<?php 

					$kinder_vk = get_theme_mod('kinder_vk');
					$kinder_fb = get_theme_mod('kinder_fb');
					$kinder_tw = get_theme_mod('kinder_tw');
					$kinder_ok = get_theme_mod('kinder_ok');
					$kinder_in = get_theme_mod('kinder_in');

				?>

				<div class="social">

					<?php if($kinder_vk != '') : ?>
						<a class="vk" href="<?php echo $kinder_vk?>" title="Вконтакте"><i class="fa fa-vk" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if($kinder_fb != '') : ?>
					<a class="fb" href="<?php echo $kinder_fb?>" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if($kinder_tw != '') : ?>
					<a class="tw" href="<?php echo $kinder_tw?>" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if($kinder_ok != '') : ?>
					<a class="ok" href="<?php echo $kinder_ok?>" title="Одноклассники"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if($kinder_in != '') : ?>
					<a class="in" href="<?php echo $kinder_in?>" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php endif;?>				
				</div>
			</div>
            <div class="creator col-xs-12">Создано при поддержке КУ РИАЦ</div>
		</div>
	</div>
</footer>

	<?php wp_footer(); ?>

	</body>
</html>
