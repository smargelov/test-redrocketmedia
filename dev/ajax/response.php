<?php
add_action('wp_ajax_action-name', 'some_function');
add_action('wp_ajax_nopriv_action-name', 'some_function');

function some_function()
{
	$other_data = esc_attr($_POST['otherData']);
	// Какая-то работа над полученными данными

	echo "Переданные данные: $other_data";
	wp_die();
}

add_action('wp_enqueue_scripts', 'my_action');
function my_action()
{
	wp_enqueue_script('request', get_template_directory_uri('request.js', __FILE__), array('jquery')); // исправить путь к файлу скрипта если нужно

	wp_localize_script('request', 'myObject', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'someData' => 'some data'
	));
}
