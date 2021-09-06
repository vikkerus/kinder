<?php
/**
* Basic Theme Setup
*/
if ( ! function_exists( 'kinder_setup' ) ) :
	function kinder_setup()
	{
		// Добавляет ссылки на RSS фиды постов и комментариев в head
		add_theme_support( 'automatic-feed-links' );

		// Позволяет изменять метатег title
		add_theme_support( 'title-tag' );

		// Позволяет устанавливать миниатюру посту
		add_theme_support( 'post-thumbnails' );

		// Регистрация области меню
		register_nav_menus(array(
			'kid_top_menu' => esc_html__('Верхнее меню', 'hike'),
		));

		// Включает поддержку html5 разметки для списка комментариев, формы комментариев, формы поиска, галереи и т.д.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Включает поддержку «Selective Refresh» (выборочное обновление) для виджетов в кастомайзере
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;

add_action( 'after_setup_theme', 'kinder_setup' );


// Регистрация Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');


// Регистрация области виджетов
function kinder_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Kinder-sidebar', 'kinder' ),
		'id'            => 'kd-sidebar',
		'description'   => esc_html__( 'Добавьте виджеты здесь.', 'kinder' ),
		'before_widget' => '<div id="%1$s" class="aside-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="aside-widget-head widget-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'kinder_widgets_init' );

// Удаление слова "Рубрика" из заголовка страницы
add_filter( 'get_the_archive_title', 'remove_name_category' );

function remove_name_category( $title )
{
	if ( is_category() )
	{
		$title = single_cat_title( '', false );
	}
	elseif ( is_tag() )
	{
		$title = single_tag_title( '', false );
	}
	
	return $title;
}


// Удаление конструкции [...] на конце the_excerpt
add_filter('excerpt_more', function($more)
{
	return '...';
});


// Изменение длины обрезаемого текста the_excerpt
add_filter( 'excerpt_length', function()
{
	return 35;
} );


// Кастомная пагинация
if (!function_exists('kinder_pagination'))
{
  function kinder_pagination()
  {
    global $wp_query;
	  
    $big = 999999999;
    
    $links = paginate_links(array( 
      'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 
      'format' => '?paged=%#%', 
      'current' => max(1, get_query_var('paged')), 
      'type' => 'array', 
      'prev_text'    => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      'next_text'    => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
      'total' => $wp_query->max_num_pages, 
      'show_all'     => false, 
      'end_size'     => 1, 
      'mid_size'     => 2,
      'add_args'     => false, 
      'add_fragment' => '',	
      'before_page_number' => '', 
      'after_page_number' => '' 
    ));
    
   	if( is_array( $links ) )
	{
        echo '<ul class="kinder-pagination">';
		
        foreach ( $links as $link )
		{
        	if ( strpos( $link, 'current' ) !== false ) echo "<li class='active'>".$link."</li>";
			
            else echo '<li>'.$link.'</li>'; 
        }
		
       	echo '</ul>';
     }
  }
}


// Удаление секции с настройками статичной главной страницы
add_action('customize_register', 'kinder_customize_remove_static');

function kinder_customize_remove_static($wp_customize)
{
  $wp_customize->remove_section( 'static_front_page' );
}


/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}



// Добавление в настройки дочерней темы полей с доп. настройками
add_action('customize_register', 'kinder_customize_special');

function kinder_customize_special($customizer)
{
	// Добавление полей для электронной приёмной
	$customizer->add_section(
        'kinder_special_section',
        array(
            'title' => 'Электронная приёмная',
            'description' => 'Отображать ли блок с электронной приёмной',
            'priority' => 11,
        )
    );
	
	$customizer->add_setting(
		'kinder_special_radio',
		array(
			'type' => 'theme_mod',
			'default' => 'no',
		)
	);
	
	$customizer->add_control(
		'kinder_special_radio',
		array(
			'label' => 'Отображать электронную приёмную?',
			'section' => 'kinder_special_section',
			'type' => 'radio',
			'choices' => array(
				'no' => 'Нет',
				'yes' => 'Да',
			),
		)
	);
	
	
	$customizer->add_setting('kinder_el_photo');
	$customizer->add_control(
    	new WP_Customize_Image_Control(
			$customizer,
			'kinder_el_photo',
			array(
				'label' => 'Загрузка изображ.',
				'section' => 'kinder_special_section',
				'settings' => 'kinder_el_photo'
        	)
    	)
	);
	
	
	$customizer->add_setting('kinder_el_textbox');
	$customizer->add_control(
		'kinder_el_textbox',
		array(
			'label' => 'Должность руководителя',
			'section' => 'kinder_special_section',
			'type' => 'text',
		)
	);
	
	
	$customizer->add_setting('kinder_el_fio');	
	$customizer->add_control(
		'kinder_el_fio',
		array(
			'label' => 'ФИО руководителя',
			'section' => 'kinder_special_section',
			'type' => 'text',
		)
	);
	
	
	// добавление полей с возрастными ограничениями
	$customizer->add_section(
        'kinder_age_section',
        array(
            'title' => 'Возрастные органичения',
            'description' => 'Выберите возрастное ограничение сайта',
            'priority' => 12,
        )
    );
	
	$customizer->add_setting(
		'kinder_age_textbox',
		array('default' => 'hide')
	);
	
	$customizer->add_control(
		'kinder_age_textbox',
		array(
			'label' => 'Возрастное ограничение',
			'section' => 'kinder_age_section',
			'type' => 'select',
			'choices' => array(
				'hide' => 'hide',
				'0+'   => '0+',
				'6+'   => '6+',
			),
		)
	);
	
	
	// Контактные данные в "шапку"
	$customizer->add_section(
        'kinder_contact_header_section',
        array(
            'title' => 'Контактные данные в "шапке"',
            'description' => 'Контактные данные, отображаемые в "шапке" сайта.',
            'priority' => 13,
        )
    );
	
	$customizer->add_setting('kinder_header_phone');
	$customizer->add_control(
		'kinder_header_phone',
		array(
			'label' => 'Контактный телефон',
			'section' => 'kinder_contact_header_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_header_address');
	$customizer->add_control(
		'kinder_header_address',
		array(
			'label' => 'Адрес учреждения',
			'section' => 'kinder_contact_header_section',
			'type' => 'text',
		)
	);
	
	
	//Контактные данные в "подвал"
	$customizer->add_section(
        'kinder_contact_footer_section',
        array(
            'title' => 'Контактные данные в "подвале"',
            'description' => 'Контактные данные, отображаемые в "подвале" сайта.',
            'priority' => 14,
        )
    );
	
	$customizer->add_setting('kinder_footer_phone');
	$customizer->add_control(
		'kinder_footer_phone',
		array(
			'label' => 'Контактный телефон',
			'section' => 'kinder_contact_footer_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_footer_address');
	$customizer->add_control(
		'kinder_footer_address',
		array(
			'label' => 'Адрес учреждения',
			'section' => 'kinder_contact_footer_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_footer_email');
	$customizer->add_control(
		'kinder_footer_email',
		array(
			'label' => 'Электронная почта',
			'section' => 'kinder_contact_footer_section',
			'type' => 'text',
		)
	);
	
	
	// Ссылки на социальные сети
	$customizer->add_section(
        'kinder_social_section',
        array(
            'title' => 'Ссылки на социальные сети',
            'description' => 'Ссылки на имеющиеся социальные сети.',
            'priority' => 15,
        )
    );
		
	$customizer->add_setting('kinder_vk');
	$customizer->add_control(
		'kinder_vk',
		array(
			'label' => 'Вконтакте',
			'section' => 'kinder_social_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_fb');
	$customizer->add_control(
		'kinder_fb',
		array(
			'label' => 'Facebook',
			'section' => 'kinder_social_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_tw');
	$customizer->add_control(
		'kinder_tw',
		array(
			'label' => 'Twitter',
			'section' => 'kinder_social_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_ok');
	$customizer->add_control(
		'kinder_ok',
		array(
			'label' => 'Одноклассники',
			'section' => 'kinder_social_section',
			'type' => 'text',
		)
	);
	
	$customizer->add_setting('kinder_in');
	$customizer->add_control(
		'kinder_in',
		array(
			'label' => 'Инстаграм',
			'section' => 'kinder_social_section',
			'type' => 'text',
		)
	);
	
	
	// Цветовые схемы  сайта
	$customizer->add_section(
        'kinder_color_section',
        array(
            'title' => 'Цветовая схема сайта',
            'description' => 'Варианты цветовых схем сайта.',
            'priority' => 16,
        )
    );
	
	$customizer->add_setting(
		'kinder_site_color',
		array('default' => 'green')
	);
	
	$customizer->add_control(
		'kinder_site_color',
		array(
			'label' => 'Цветовая схема сайта',
			'section' => 'kinder_color_section',
			'type' => 'radio',
			'choices' => array(
				'green' => 'Зеленая',
				'red'   => 'Красная',
				'blue'   => 'Синяя',
				'yellow'   => 'Жёлтая',
			),
		)
	);
	
	
	// Фоновые картинки header'а
	$customizer->add_section(
        'kinder_back_section',
        array(
            'title' => 'Фоновое изображение "шапки" и "подвала"',
            'description' => 'Варианты фоновых изображений "шапки" и "подвала".',
            'priority' => 17,
        )
    );
	
	$customizer->add_setting(
		'kinder_site_back',
		array('default' => 'kids')
	);
	
	$customizer->add_control(
		'kinder_site_back',
		array(
			'label' => 'Фоновое изображение "шапки" и "подвала"',
			'section' => 'kinder_back_section',
			'type' => 'radio',
			'choices' => array(
				'kids' => 'Дети',
				'one'   => 'Карандаши',
				'two'   => 'Цветы',
				'three'   => 'Стол',
				
			),
		)
	);
	
	
}


// Дополнительная область виджетов для кнопки слабовидящих
function register_bvi_sidebar()
{
	register_sidebar(
		array(
			'id' => 'bvi_sidebar',
			'name' => 'Для слабовидящих',
			'description' => 'В этот сайдбар можно поместить виджет с кнопкой для слабовидящих. Прочие виджеты, помещенные в этот сайдбар, не будут видны.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-heading">',
			'after_title' => '</h4>'
		)
	);
}

add_action( 'widgets_init', 'register_bvi_sidebar' );



// содержимое страницы мануала
function kinder_page()
{
	echo '<h2 class="org_title">Руководство пользователя по теме Kinder-usteo</h2><p><a href="'.site_url('/wp-content/themes/kinder-usteo/kinder.pdf').'" title="Руководство пользователя" target="_blank">Руководство пользователя по теме Kinder-usteo</a></p>';
}



// создание страницы в админке с ссылкой на руководство пользователя по теме
function kinder_manual_page()
{
	add_menu_page( 'Руководство пользователя по теме Kinder', 'Тема Kinder-usteo', 'read', 'kinder', 'kinder_page', 'dashicons-book-alt','81.6' );
}

add_action( 'admin_menu', 'kinder_manual_page' );



// Скрипты и стили 
function kinder_scripts()
{	
	wp_enqueue_style( 'f_roboto', 'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic', array(), null );
	
	wp_enqueue_style( 'f_mont', 'https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic', array(), null );
	
	wp_enqueue_style( 'kinder_bt_s', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null );
	
	wp_enqueue_style( 'kinder_style', get_stylesheet_directory_uri() . '/style.css', array(), null );
	
	wp_enqueue_script( 'f_awesome', 'https://use.fontawesome.com/366cf63e23.js', array(), null, true);
	
	wp_enqueue_script( 'kinder_app', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), null, true);
	
}

add_action( 'wp_enqueue_scripts', 'kinder_scripts' );
