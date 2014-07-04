<?php
	define('PANDA_FRAMEWORK', get_template_directory_uri() . '/framework/' );
	//img crop
	require_once 'BFI_Thumb.php'; // обрезка миниатюр
	require_once 'panda-functions.php'; // функции
	require_once 'elements.php';// всякие элементы
	require_once 'sorting-posts.php';//сортировка постов
	require_once 'modal-window-first.php';//модальное окно при загрузке страницы
	require_once 'post_meta_boxes/metaboxes/meta_box.php'; //класс для произвольных полей
	require_once 'post_meta_boxes/inc/sample.php'; //произвольные поля
	require_once 'gallerey-custom.php'; //кастомизация галлереи
	require_once 'soundcloud-shortcode.php'; // шорткод саундклауд
	require_once 'elements/header-template.php'; //элементы хэдера
	require_once 'elements/main-slider.php'; //шаблоны слайдеров
	require_once 'classes/tax-meta-box.php';

    /**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function panda_framework_frontend_scripts() {
		if( !is_admin() ) {
			//wp_enqueue_script( 'effekts', PANDA_FRAMEWORK .'js/effects.js', array( 'jquery' ), false, true);
			//wp_enqueue_script( 'main-framework-frontend-script', PANDA_FRAMEWORK .'js/main-framework-frontend-script.js', array( 'jquery' ), false, true);
			wp_enqueue_script('blorium2-all-script', PANDA_FRAMEWORK  . '/js/all.min.js', array('jquery'), '', false);
			wp_enqueue_style( 'effects', PANDA_FRAMEWORK .'css/effects.css', null, false);
			wp_enqueue_style( 'fonts', PANDA_FRAMEWORK .'fonts/font-awesome.css', null, false);
			wp_enqueue_style( 'blorium2-all-style', PANDA_FRAMEWORK .'css/all.min.css', null, false);

		}
	}

	add_action( 'wp_enqueue_scripts', 'panda_framework_frontend_scripts' );