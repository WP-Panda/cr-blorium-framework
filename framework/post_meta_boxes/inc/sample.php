<?

$prefix = 'cr_bl2_';

$fields = array(
	array(
		'label'	=>__( 'Инпут', 'wp_panda' ),// заголовок
		'desc'	=> __( 'Описание для поля', 'wp_panda' ), // описание
		'id'	=> $prefix.'text', // id опции
		'type'	=> 'text' // тип поля
	),
	array(
		'label'	=> __( 'Текстовое поле', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'textarea',
		'type'	=> 'textarea'
	),
	array(
		'label'	=> __( 'Чекбокс', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'checkbox',
		'type'	=> 'checkbox'
	),
	array(
		'label'	=> __( 'Селект', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'select',
		'type'	=> 'select', 
		'options' => array (//массив опций
			'one' => array ( //единичная опция
				'label' => __( 'Первая Опция', 'wp_panda' ), //отображаемый текст
				'value'	=> 'one' //значение
			),
			'two' => array (
				'label' => __( 'Вторая Опция', 'wp_panda' ),
				'value'	=> 'two'
			),
			'three' => array (
				'label' => __( 'Третья Опция', 'wp_panda' ),
				'value'	=> 'three'
			)
		)
	),
	array (
		'label'	=> __( 'Группа радиокнопок', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'radio',
		'type'	=> 'radio',
		'options' => array (
			'one' => array (
				'label' => __( 'Первая Опция', 'wp_panda' ),
				'value'	=> 'one'
			),
			'two' => array (
				'label' => __( 'Вторая Опция', 'wp_panda' ),
				'value'	=> 'two'
			),
			'three' => array (
				'label' => __( 'Третья Опция', 'wp_panda' ),
				'value'	=> 'three'
			)
		)
	),
	array (
		'label'	=> __( 'Группа чекбоксов', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'checkbox_group',
		'type'	=> 'checkbox_group',
		'options' => array (
			'one' => array (
				'label' => __( 'Первая Опция', 'wp_panda' ),
				'value'	=> 'one'
			),
			'two' => array (
				'label' => __( 'Вторая Опция', 'wp_panda' ),
				'value'	=> 'two'
			),
			'three' => array (
				'label' => __( 'Третья Опция', 'wp_panda' ),
				'value'	=> 'three'
			)
		)
	),
	array(
		'label'	=> __( 'Категории', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> 'category', //что выбирать
		'type'	=> 'tax_select'
	),
	array(
		'label'	=> __( 'Записи', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=>  $prefix.'post_id',
		'type'	=> 'post_select',
		'post_type' => array('post','page') //что отоброжать
	),
	array(
		'label'	=> __( 'Дата', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'date',
		'type'	=> 'date'
	),
	array(
		'label'	=> __( 'Слайдер', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'slider',
		'type'	=> 'slider',
		'min'	=> '0', //минимальное значение
		'max'	=> '100', //максимальное значение
		'step'	=> '5' //шаг
	),
	array(
		'label'	=> __( 'Изображение', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'image',
		'type'	=> 'image'
	),
	array( 
		'label'	=> __( 'Динамическая группа', 'wp_panda' ),
		'desc'	=> __( 'Описание для поля', 'wp_panda' ),
		'id'	=> $prefix.'repeatable', // field id and name
		'type'	=> 'repeatable',
		'sanitizer' => array( // массив обработчики
			'featured' => 'meta_box_santitize_boolean',
			'title' => 'sanitize_text_field',
			'desc' => 'wp_kses_data'
		),
		'repeatable_fields' => array ( 
			'featured' => array(
				'label' => 'Featured?',
				'id' => 'featured',
				'type' => 'checkbox'
			),
			array(
				'label'	=> 'Image',
				'id'	=> 'image',
				'type'	=> 'image'
			),
			'title' => array(
				'label' => 'Title',
				'id' => 'title',
				'type' => 'text'
			),
			'desc' => array(
				'label' => 'Description',
				'id' => 'desc',
				'type' => 'textarea'
			)
		)
	)
);


$audio_post_type = array(
	array(
		'label'	=> __( 'Soundcloud аудио пост', 'wp_panda' ),
		'desc'	=> __( 'Выбрать если вы хотите вставить аудио с сервиса soundcloud, в противном случае оставьте чекбокс не отмеченным', 'wp_panda' ),
		'id'	=> $prefix.'audio_soundcloud_type',
		'type'	=> 'checkbox'
	),


	array(
		'label'	=>__( 'Ссылка на аудио файл', 'wp_panda' ),// заголовок
		'desc'	=> __( 'В данное поле необходимо ввести ссылку на аудио файл, файл можно загрузить на ваш сервер, или вставить ссылку на файл находящийся на постороннем ресурсе, так же  сюда можно добавить ссылку на композицию с сервиса <a href="https://soundcloud.com" title="">Soundcloud</a> в этом случае необходимо отметить чекбокс выше', 'wp_panda' ), // описание
		'id'	=> $prefix.'audio_file',
		'type'	=> 'audio'
	),

	array(
		'label'	=> __( 'Название композиции', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести название композиции (не обязательно), если поле пустое в качестве названия будет использован заголовок записи.', 'wp_panda' ),
		'id'	=> $prefix.'audio_title',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Исполнитель композиции', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести исполнителя композиции (не обязательно)', 'wp_panda' ),
		'id'	=> $prefix.'audio_singer',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Альбом', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести альбом в который входит композиция (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'audio_album',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Год', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести год выхода композиции (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'audio_year',
		'type'	=> 'text'
	),

);

$quote_post_type = array(
	array(
		'label'	=> __( 'Источник', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести источник цитаты (не обязательно)', 'wp_panda' ),
		'id'	=> $prefix.'quote_source',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Автор', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести автора цитаты (не обязательно), если поле пустое сюда будет выведен загорловок поста.', 'wp_panda' ),
		'id'	=> $prefix.'quote_autor',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Год', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести год к которому принадлежит цитата (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'quote_year',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Цвет шрифта цитаты', 'wp_panda' ),
		'desc'	=> __( 'В данном поле можно выбрать цвет шрифта цитаты, это необходимо для того, что бы надпись хорощо читалась на выбранном фоне (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'quote_color',
		'type'	=> 'color'
	),
);

$link_post_type = array(
	array(
		'label'	=> __( 'Ссылка', 'wp_panda' ),
		'desc'	=> __( 'В данное поле необходимо ввести url ссылки', 'wp_panda' ),
		'id'	=> $prefix.'link_url',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Анкор ссылки', 'wp_panda' ),
		'desc'	=> __( 'В данное поле необходимо ввести анкор (текст) ссылки (не обязательно), если поле пустое сюда будет выведен загорловок поста.', 'wp_panda' ),
		'id'	=> $prefix.'link_ankor',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Атрибут title', 'wp_panda' ),
		'desc'	=> __( 'В данное поле можно ввести атрибут title для ссылки (не обязательно), если поле пустое атрибут title будет выведен пустым.', 'wp_panda' ),
		'id'	=> $prefix.'link_title',
		'type'	=> 'text'
	),

	array(
		'label'	=> __( 'Цвет шрифта блока ссылки', 'wp_panda' ),
		'desc'	=> __( 'В данном поле можно выбрать цвет шрифта блока ссылки, это необходимо для того, что бы надпись хорощо читалась на выбранном фоне (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'link_color',
		'type'	=> 'color'
	),
);

$status_post_type = array(
	array(
		'label'	=> __( 'Цвет шрифта блока статус', 'wp_panda' ),
		'desc'	=> __( 'В данном поле можно выбрать цвет шрифта блока статус, это необходимо для того, что бы надпись хорощо читалась на выбранном фоне (не обязательно).', 'wp_panda' ),
		'id'	=> $prefix.'status_color',
		'type'	=> 'color'
	),
);

$video_post_type = array(
	array(
		'label'	=> __( 'Ссылка', 'wp_panda' ),
		'desc'	=> __( 'В данное поле необходимо ввести url ссылки', 'wp_panda' ),
		'id'	=> $prefix.'video_url',
		'type'	=> 'text'
	),
);


/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
//$sample_box = new custom_add_meta_box( 'sample_box', 'Sample Box', $fields, 'post', true );

$audio_box  = new custom_add_meta_box( 'sample_box', __( 'Параметры аудио', 'wp_panda' ), $audio_post_type, 'post', true );
$quote_box  = new custom_add_meta_box( 'audio_box', __( 'Параметры цитаты', 'wp_panda' ), $quote_post_type, 'post', true );
$link_box  = new custom_add_meta_box( 'link_box', __( 'Параметры сылки', 'wp_panda' ), $link_post_type, 'post', true );
$status_box  = new custom_add_meta_box( 'status_box', __( 'Параметры статуса', 'wp_panda' ), $status_post_type, 'post', true );
$video_box  = new custom_add_meta_box( 'video_box', __( 'Параметры видео', 'wp_panda' ), $video_post_type, 'post', true );