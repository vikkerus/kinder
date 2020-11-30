<div class="aside-widget">
	<div class="aside-widget-head">		
		<a href="<?php echo site_url('/sveden');?>" title="Сведения об образовательной организации">Сведения об образовательной организации</a>
	</div>
	<div class="aside-widget-body">
		<ul class="list-unstyled standart-oo-menu">
			<li>
                <a href="<?php echo site_url('/sveden/common');?>" title="Основные сведения">Основные сведения</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/struct');?>" title="Структура и органы управления образовательной организацией">Структура и органы управления образовательной организацией</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/document');?>" title="Документы">Документы</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/education');?>" title="Образование">Образование</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/edustandarts');?>" title="Образовательные стандарты">Образовательные стандарты</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/employees');?>" title="Руководство. Педагогический (научно-педагогический) состав">Руководство. Педагогический (научно-педагогический) состав</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/objects');?>" title="Материально-техническое обеспечение и оснащенность образовательного процесса">Материально-техническое обеспечение и оснащенность образовательного процесса</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/grants');?>" title="Стипендии и иные виды материальной поддержки">Стипендии и иные виды материальной поддержки</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/paid_edu');?>" title="Платные образовательные услуги">Платные образовательные услуги</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/budget');?>" title="Финансово-хозяйственная деятельность">Финансово-хозяйственная деятельность</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/vacant');?>" title="Вакантные места для приема (перевода)">Вакантные места для приема (перевода)</a>
            </li> 
            <li>
                <a href="<?php echo site_url('/sveden/ovz');?>" title="Доступная среда">Доступная среда</a>
            </li>
            <li>
                <a href="<?php echo site_url('/sveden/inter');?>" title="Международное сотрудничество">Международное сотрудничество</a>
            </li>
		</ul>
	</div>
</div>

<?php 
	
	$age = get_theme_mod('kinder_special_radio', 'no');

	if($age != 'no') : 

?>
<div class="aside-widget">
	<div class="aside-widget-head">Электронная приемная</div>
	<div class="kinder_reception">
		<div class="kinder-el-block">
			<?php 
				if (!empty(get_theme_mod('kinder_el_photo')))
				{
					echo '<div class="img-block"><img src="'.get_theme_mod('kinder_el_photo').'"/></div>';
				}
			?>
			<a class="link" href="<?php echo get_site_url()?>/ep" title="Электронная приемная">Электронная приемная</a>
			<?php 
				if (!empty(get_theme_mod('kinder_el_textbox')))
				{
					echo '<div class="kinder_position">'.get_theme_mod('kinder_el_textbox').':</div>';
				}
			?>
			<?php 
				if (!empty(get_theme_mod('kinder_el_fio')))
				{
					echo '<div class="kinder_name">'.get_theme_mod('kinder_el_fio').'</div>';
				}
			?>
		</div>
	</div>
</div>	
<?php endif;?>