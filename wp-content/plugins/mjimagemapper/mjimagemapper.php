<?php
/*
Plugin Name: Mjimagemapper
Description: Wtyczka do prezentacji i zarządzania nieruchomościami
Version: 0.9
Author: Michał Jendraszczyk VirtualPeople
Author URI: https://virtualpeople.pl
License: GPL2
*/

define('IMAGEMAP_POST_TYPE', 'imagemap');
define('IMAGEMAP_AREA_POST_TYPE', 'imagemap_area');
add_action('init', 'imgmap_create_post_type');

//add_action('init', 'build_acf_forms');

add_action('admin_menu', 'imgmap_custom_form');
add_action('admin_menu', 'imgmap_imagemap_tab_menu'); 
add_action('save_post', 'imgmap_save_meta');
add_action('post_edit_form_tag', 'imgmap_add_post_enctype');
add_action('template_include', 'imgmap_template');
add_action('wp_ajax_imgmap_save_area', 'imgmap_save_area_ajax');
add_action('wp_ajax_imgmap_delete_area', 'imgmap_delete_area_ajax');
add_action('wp_ajax_nopriv_imgmap_load_dialog_post', 'imgmap_load_dialog_post_ajax');
add_action('wp_ajax_imgmap_load_dialog_post', 'imgmap_load_dialog_post_ajax');
add_action('wp_ajax_imgmap_get_area_coordinates', 'imgmap_get_area_coordinates_ajax');
add_action('wp_ajax_imgmap_save_area_title', 'imgmap_save_area_title');
add_action('wp_ajax_imgmap_set_area_color', 'imgmap_set_area_color');
add_action('wp_ajax_imgmap_add_new_style', 'imgmap_add_new_style');
add_action('wp_ajax_imgmap_edit_style', 'imgmap_edit_style');
add_action('wp_ajax_imgmap_delete_style', 'imgmap_delete_style');
add_action('before_delete_post', 'imgmap_permanently_delete_imagemap');
add_action('wp_trash_post', 'imgmap_trash_imagemap');
add_action('manage_'.IMAGEMAP_POST_TYPE.'_posts_custom_column', 'imgmap_manage_imagemap_columns', 10, 2);
add_action('manage_'.IMAGEMAP_AREA_POST_TYPE.'_posts_custom_column', 'imgmap_manage_imagemap_area_columns', 10, 2);
add_action('media_upload_imagemap', 'imgmap_media_upload_tab_action');
add_action('admin_action_imgmap_save_settings', 'imgmap_save_settings');

// add_filter('the_content', 'imgmap_replace_shortcode');
add_filter('post_updated_messages', 'imgmap_updated_message');
add_filter('manage_edit-'.IMAGEMAP_POST_TYPE.'_columns', 'imgmap_set_imagemap_columns');
add_filter('manage_edit-'.IMAGEMAP_AREA_POST_TYPE.'_columns', 'imgmap_set_imagemap_area_columns');
add_filter( 'manage_edit-'.IMAGEMAP_AREA_POST_TYPE.'_sortable_columns', 'imgmap_register_sortable_area_columns' );
add_filter('media_upload_tabs', 'imgmap_media_upload_tab');


$image_maps = array();


// Test data for highlight style management
$imgmap_colors = array(
	'current_id' => 12,
	'last_chosen' => 1,
	'colors' => array(
		1 => array( 'fillColor' => 'fefefe', 'strokeColor' => 'fefefe', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		2 => array( 'fillColor' => '070707', 'strokeColor' => '070707', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		3 => array( 'fillColor' => 'c94a4a', 'strokeColor' => 'e82828', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		4 => array( 'fillColor' => '1e39db', 'strokeColor' => '1e39db', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		5 => array( 'fillColor' => '1ed4db', 'strokeColor' => '1ed4db', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		6 => array( 'fillColor' => '4355c3', 'strokeColor' => '1edb4b', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		7 => array( 'fillColor' => '3ddb1e', 'strokeColor' => '3ddb1e', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		8 => array( 'fillColor' => 'dbc71e', 'strokeColor' => 'dbc71e', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		9 => array( 'fillColor' => 'db4f1e', 'strokeColor' => 'db4f1e', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		10 => array( 'fillColor' => 'd91edb', 'strokeColor' => 'd91edb', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		11 => array( 'fillColor' => '1e34db', 'strokeColor' => '1e34db', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2),
		12 => array( 'fillColor' => 'db1e65', 'strokeColor' => 'db1e65', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.8, 'strokeWidth' => 2)
		)
);

/**
 * Tworzenie elementów w ACF
 */
function build_acf_forms() { 
 
	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_6477458d4af35',
			'title' => 'Obszary obrazków - Inwestycje',
			'fields' => array(
				array(
					'key' => 'field_6477459b170cd',
					'label' => 'Inwestycja',
					'name' => 'inwestycja',
					'type' => 'select',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Szczecin - Osiedle Spiska' => 'Szczecin - Osiedle Spiska',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_647752887df0a',
					'label' => 'Typ',
					'name' => 'typ',
					'type' => 'select',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						0 => 'Osiedle',
						1 => 'Budynek',
						2 => 'Piętro',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'imagemap',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5f79c6e09f33d',
			'title' => 'Obszary obrazków - Mieszkanie',
			'fields' => array(
				array(
					'key' => 'field_5f79c6eafcc0a',
					'label' => 'Powierzchnia',
					'name' => 'powierzchnia',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f79c6f5fcc0b',
					'label' => 'Cena',
					'name' => 'cena',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f79c6fdfcc0c',
					'label' => 'Piętro',
					'name' => 'pietro',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f79c705fcc0d',
					'label' => 'Numer lokalu',
					'name' => 'numerlokalu',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f79c716fcc0e',
					'label' => 'Rzut',
					'name' => 'rzut',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'large',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5f79c76cfcc0f',
					'label' => 'Typ',
					'name' => 'typ',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Mieszkanie' => 'Mieszkanie',
						'Osiedle' => 'Osiedle',
						'Budynek' => 'Budynek',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_5f79c779fcc10',
					'label' => 'Status',
					'name' => 'status',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Wolne' => 'Wolne',
						'Zarezerwowane' => 'Zarezerwowane',
						'Sprzedane' => 'Sprzedane',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_5f79c7a7fcc11',
					'label' => 'Inwestycja',
					'name' => 'inwestycja',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Szczecin - Osiedle Spiska' => 'Szczecin - Osiedle Spiska',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_5f79c7b8fcc12',
					'label' => 'Pokoje',
					'name' => 'pokoje',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'imagemap_area',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));
		
		endif;
}
/* Creation of the custom post types 
 * Also script and stylesheet importing
 * Note: The plugin uses jQueryUI library, which includes jQuery UI Stylesheet. If you want to use your own stylesheet made with jQuery UI stylesheet generator, please replace the jquery-ui.css link address with your own stylesheet.
 * jQuery UI is only used in the dialog window which opens when user clicks a highlighted area. 
 * Later there will be option for changing the stylesheet. 
 * */
function imgmap_create_post_type() {
	if(!get_option('imgmap_colors')) {
		global $imgmap_colors;	
		add_option('imgmap_colors', $imgmap_colors);
	}
	/* Create the imagemap post type */
	register_post_type(IMAGEMAP_POST_TYPE,
		array( 
			'labels' => array(
				'name' => __('Mapy obrazków'),
				'singular_name' => __('Mapy obrazków'),
				'add_new' => __('Dodaj nową mapę obrazku'),
				'all_items' => __('Wszystkie mapy obrazków'),
				'add_new_item' => __('Dodaj nową mapę obrazka'),
				'edit_item' => __('Edytuj mapę obrazka'),
				'new_item' => __('Nowa mapa obrazka'),
				'view_item' => __('Podgląd mapy obrazka'),
				'search_items' => __('Szukaj map obrazków'),
				'not_found' => __('Nie znaleziono map obrazka'),
				'not_found_in_trash' => __('Mapy obrazków nie znaleziono w koszu'),
			),
			'public' => true,
			'menu_icon' => plugins_url() . '/mjimagemapper/imagemap_icon.png',
			'exclude_from_search' => true,
			'has_archive' => true,
			'supports' => array(
					'title'
				)
			)
	);
	
	/* Create the imagemap area post type */
	/* Area to highlight. */
	register_post_type(IMAGEMAP_AREA_POST_TYPE,
		array( 
			'labels' => array(
				'name' => __('Obszary map obrazków'),
				'singular_name' => __('Obszar mapy obrazka'),
				'add_new' => __('Dodaj nowy obszar mapy obrazka'),
				'all_items' => __('Wszystkie obszary map obrazka'),
				'add_new_item' => __('Dodaj nowy obszar mapy obrazka'),
				'edit_item' => __('Edytuj obszar mapy obrazka'),
				'new_item' => __('Nowy obszar mapy obrazka'),
				'view_item' => __('Podgląd obszaru mapy obrazka'),
				'search_items' => __('Szukaj obszaru mapy obrazka'),
				'not_found' => __('Nie znaleziono obszaru mapy obrazka'),
				'not_found_in_trash' => __('Nie znaeziono obszaru mapy obrazka w koszu'),
			),
			'public' => true,
			'has_archive' => true,
			'menu_icon' => plugins_url() . '/mjimagemapper/imagemap_area_icon.png',
		)
	);
	
	/* Import ImageMapster and jQuery UI */
        
	wp_register_script('imgmap_imagemapster', plugins_url() . '/mjimagemapper/script/jquery.imagemapster.min.js?v='.time());
	// wp_register_style('jquery_ui', 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
	wp_register_style('imgmap_style', plugins_url().'/mjimagemapper/imgmap_style.css?v='.time());

        wp_register_style('imgmap_style_datatable', plugins_url().'/mjimagemapper/datatables.css?v='.time());

		wp_register_style('imgmap_style_jquery-ui', plugins_url().'/mjimagemapper/jquery-ui.css?v='.time());

		// wp_register_style('imgmap_style', 'https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css');
		
		// wp_register_script('imgmap_imagemapster', 'https://code.jquery.com/ui/1.10.4/jquery-ui.js');

		// <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
		// <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  
		

	/* Enqueue jQuery UI, jQuery and ImageMapster */
	wp_enqueue_style(array( 'imgmap_style', 'imgmap_style_jquery-ui' ));
	// wp_enqueue_style(array(  ));
	
	
	
	if(get_option('imgmap-include-jquery', NULL) === NULL)
		update_option('imgmap-include-jquery', true);
	
	if(get_option('imgmap-include-jquery-ui', NULL) === NULL)
		update_option('imgmap-include-jquery-ui', true);
	
	if(get_option('imgmap-include-jquery-ui-dialog', NULL) === NULL)
		update_option('imgmap-include-jquery-ui-dialog', true);
	
	/* Not really necessary to have options to not include jquery because of the Wordpress script enqueue function.*/
	if(get_option('imgmap-include-jquery'))
		wp_enqueue_script(array( 'jquery'));
	
	if(get_option('imgmap-include-jquery-ui'))
		wp_enqueue_script(array( 'jquery-ui-core'));
		
	if(get_option('imgmap-include-jquery-ui-dialog'))
		wp_enqueue_script(array( 'jquery-ui-dialog'));
		
	
	wp_enqueue_script(array( 'jquery', 'jquery-ui', 'jquery-ui-dialog', 'editor', 'editor_functions', 'imgmap_imagemapster' ));
	
	/* The javascript file server needs to load for plugin's functionality depends on is the page is the admin panel or a frontend page */
	/* (The frontend version obviously doesn't have all the features backend version has, e.g. the imagemap editor) */
	if(is_admin()) {
		wp_register_script('imgmap_admin_script', plugins_url() . '/mjimagemapper/imagemapper_admin_script.js');
		wp_enqueue_script(array('imgmap_admin_script'));
		
		// WP 3.5 introduced a new better color picker
		if(get_bloginfo('version') >= 3.5) {
			wp_enqueue_style(array( 'wp-color-picker' ));
			wp_enqueue_script(array( 'wp-color-picker' ));
		}
	}
	else {
		wp_register_script('imgmap_script', plugins_url() . '/mjimagemapper/imagemapper_script.js?v='.time());
		wp_register_script('imgmap_script_datatable', plugins_url() . '/mjimagemapper/datatables.js?v='.time());
		wp_enqueue_script('imgmap_script');
		wp_enqueue_script('imgmap_script_datatable');
	}
	
	
	wp_localize_script('imgmap_script', 'imgmap', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'pulseOption' => get_option('imgmap-pulse'),
		'admin_logged' => current_user_can('edit_posts'),
		'alt_dialog' => get_option('imgmap-alt-dialog')));
};

// Set custom columns for imagemap archive page
function imgmap_set_imagemap_columns($columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['image'] = __('Image');
	$new_columns['title'] = _x('Imagemap name', 'column name');
	$new_columns['area_count'] = __('Obszary');
	$new_columns['date'] = __('Updated');
	$new_columns['author'] = __('Autor');
	return $new_columns;
}

// ..and do the same for areas
function imgmap_set_imagemap_area_columns($columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Imagemap area name', 'column name');
	$new_columns['parent_image'] = __('Imagemap image');
	$new_columns['parent_title'] = __('Imagemap title');
	$new_columns['date'] = __('Updated');
	$new_columns['author'] = __('Author');
	return $new_columns;
}

//Define what to do for custom columns
function imgmap_manage_imagemap_columns($column_name, $id) {
	global $wpdb;
	switch($column_name) {
		case 'image':
			echo '<img class="imagemap-column-image" src="'.get_post_meta($id, 'imgmap_image', true).'" alt>';
			break;
			
		case 'area_count': 
			$areas = get_posts('post_parent='.$id.'&post_type='.IMAGEMAP_AREA_POST_TYPE.'&numberposts=-1');
			echo count($areas);
			break;
	}
}
// for the areas too
function imgmap_manage_imagemap_area_columns($column_name, $id) {
	global $wpdb;
	switch($column_name) {
		case 'parent_image':
			$post = get_post($id);
			echo '<img class="imagemap-column-image" src="'.get_post_meta($post->post_parent, 'imgmap_image', true).'" alt>';
			break;
		
		case 'parent_title':
			$post = get_post($id);
			echo '<a href="'.get_edit_post_link($post->post_parent).'">'.get_the_title($post->post_parent).'</a>';
			break;
	}
}

//Make the parent title column sortable, so there's a way to sort areas by parent image map.
function imgmap_register_sortable_area_columns( $columns ) {
	$columns['parent_title'] = 'parent_title';
	return $columns;
}

/* To enable author to upload an image for the image map. */
function imgmap_add_post_enctype() {
    echo ' enctype="multipart/form-data"';
}

/* When updating a post, Wordpress needs to check for the custom fields 
 * At the moment it's only the uploaded image.
 * */
function imgmap_save_meta($id = false) {
		
	if(get_post_type($id) == IMAGEMAP_POST_TYPE) {
		
		// echo "TEST";
		// print_r($_FILES['imgmap_image']);
		// print_r($_POST);
		// print_r($_FILES);
		// exit();
		if(isset($_FILES['imgmap_image'])) {
			$uploadedFile = $_FILES['imgmap_image'];
			if($uploadedFile['error'] == 0){
				
				$file = wp_handle_upload($uploadedFile, array('test_form' => FALSE));
				
				if(!strpos('image/', $file['type']) == 0)
				wp_die('This is not an image!');
				
				update_post_meta($id, 'imgmap_image', $file['url']);
			}
		}
	}
	if(get_post_type($id) == IMAGEMAP_AREA_POST_TYPE) {
		$area_vars = imgmap_get_imgmap_area_vars($id);
		@$area_vars->type = @$_POST['area-type'];
		@$area_vars->tooltip_text = wp_kses_post(@$_POST['area-tooltip-text']);
		@$area_vars->title_attribute = esc_attr(@$_POST['area-title-attribute']);
		@$area_vars->link_url = @esc_url($_POST['area-link-url']);
		@$area_vars->link_type = @esc_attr($_POST['area-link-type']);
		@$area_vars->link_post = @esc_attr($_POST['area-link-post']);
		@$area_vars->link_page = @esc_attr($_POST['area-link-page']);
		// Save area settings in JSON format.
		// Basically when you need one of them, you need all others as well, so it's inefficient to save them in separate columns.
		update_post_meta($id, 'imgmap_area_vars', @$area_vars);
	}

	if(get_post_type($id) == IMAGEMAP_AREA_POST_TYPE) {
		if(!empty(@$_POST['coords'])) {
			update_post_meta($id, 'coords', @$_POST['coords']);
		}
	}
}

function imgmap_updated_message( $messages ) {
	global $post_ID;
	$post = get_post($post_ID);
	if(get_post_type($post_ID) != IMAGEMAP_POST_TYPE) 
		return;
		
	$messages[IMAGEMAP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Image map updated. You can add the image map to a post with Upload/Insert media tool.') ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Image map updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Image map restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Image map published.')),
		7 => __('Image map saved.'),
		8 => sprintf( __('Image map submitted.')),
		9 => sprintf( __('Image map scheduled for: <strong>%1$s</strong>.'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
		10 => sprintf( __('Image map draft updated.')),
	);
	
	return $messages;
}

function imgmap_imagemap_tab_menu() {
	add_submenu_page('edit.php?post_type='.IMAGEMAP_AREA_POST_TYPE, 'Style podświetleń obszarów', 'Style podświetleń obszarów', 'edit_posts', 'imagemap-area-styles', 'imgmap_area_styles');
	add_submenu_page('edit.php?post_type='.IMAGEMAP_POST_TYPE, 'Ustawienia map obrazka', 'Ustawienia map obrazka', 'edit_posts', 'imagemap-settings', 'imgmap_imagemap_settings');
}


/* Add custom fields to the custom post type forms. 
 * */
function imgmap_custom_form() {
	global $_wp_post_type_features;
	
	add_meta_box('imagemap-image-container', 'Image', 'imgmap_form_image', IMAGEMAP_POST_TYPE, 'normal');
	add_meta_box('imagemap-addarea', 'Dodaj obszar', 'imgmap_form_addarea', IMAGEMAP_POST_TYPE, 'side');
	add_meta_box('imagemap-areas', 'Obszary', 'imgmap_form_areas', IMAGEMAP_POST_TYPE, 'side');
	
	remove_post_type_support(IMAGEMAP_AREA_POST_TYPE, 'editor');
		
	add_meta_box('imagemap-area-coords', 'Koordynaty', 'imgmap_area_form_coords', IMAGEMAP_AREA_POST_TYPE, 'side');

	
	add_meta_box('imagemap-area-highlight', 'Podświetlenia', 'imgmap_area_form_highlight', IMAGEMAP_AREA_POST_TYPE, 'side');
	add_meta_box('imagemap-area-settings', 'Ustawienia', 'imgmap_area_form_settings', IMAGEMAP_AREA_POST_TYPE, 'side');
	add_meta_box('imagemap-area-types', 'Efekt po kliknięciu myszą', 'imgmap_area_form_types', IMAGEMAP_AREA_POST_TYPE, 'normal');
}

/* Custom field for the imagemap image.
 * Includes also the imagemap editor.
 *  */
function imgmap_form_image($post) {
	?>
	<label><h4>Wybierz plik obrazu do użycia z mapą obrazu. Zapisz post po wybraniu pliku do przesłania.</h4> 
	<input type="file" name="imgmap_image" id="file" /></label>
	<h4><?php echo strlen(get_post_meta($post->ID, 'imgmap_image', true)) > 0 ? 'Mapa obrazka' : ''; ?></h4>
	<div style="position: relative; margin-top: 30px">
		<img src="<?php echo get_post_meta($post->ID, 'imgmap_image', true); ?>" usemap="#imgmap-<?php echo $post->ID ?>" id="imagemap-image" />
		<canvas id="image-area-canvas"></canvas>
		<canvas id="image-coord-canvas"></canvas>
	</div>
	<?php
		
		$areas = get_posts('post_parent='.$post->ID.'&post_type='.IMAGEMAP_AREA_POST_TYPE.'&numberposts=-1');
		
	?>
	<map name="imgmap-<?php echo $post->ID ?>">
		<?php
			foreach($areas as $a) {
				echo imgmap_create_area_element($a->ID, $a->post_title);
			}
		?>
	</map>
	<?php
}

function imgmap_media_upload_tab($tabs) {
	$newtab = array('imagemap' => __('Mapa obrazka', 'imagemap'));
	return array_merge($tabs, $newtab);
}

function imgmap_media_upload_tab_action() {
	return wp_iframe('media_imgmap_media_upload_tab_inside');
}

function media_imgmap_media_upload_tab_inside() {
	media_upload_header(); ?>
	<p>
		<?php
		$areas = get_posts('post_type='.IMAGEMAP_POST_TYPE.'&numberposts=-1');
		foreach($areas as $a) { 
		$title = strlen($a->post_title) == 0 ? '(untitled)' : $a->post_title;
			?>
			<div data-imagemap="<?php echo $a->ID; ?>" class="insert-media-imagemap" style="background-image: url(<?php echo get_post_meta($a->ID, 'imgmap_image', true); ?>);">
				<div><?php echo $title ?></div>
			</div>
		<?php }
		?>
	</p>
	<?php
}
 
/**
 * Zwraca wszystkie mapy za pomoca jednego shortcoda
 */

 function all_imgmap_frontend_image_shortcode($atts) { 
	//$nazwaInwestycji = $atts['name'];
	$nazwaInwestycji = $atts['name'];

	$args = array(
        'numberposts'      => -1,
        'orderby'          => 'post_title',//post_title
        'order'            => 'ASC',
        // 'include'          => array(),
        // 'exclude'          => array(),
        'post_type'        => IMAGEMAP_POST_TYPE,
        'meta_query' => array(
           'relation' => 'AND',
           array(
             'key' => 'inwestycja',
             'value' => $nazwaInwestycji,
             'compare' => '=',
           ),
		));
	$getPosts = get_posts($args);
	//'post_type='.IMAGEMAP_POST_TYPE.'&numberposts=-1&inwestycja='.$nazwaInwestycji
    // 'meta_key'      => 'color',
    // 'meta_value'    => 'red'
	// echo 'post_type='.IMAGEMAP_POST_TYPE.'&numberposts=-1&inwestycja='.$nazwaInwestycji;
	// echo "<Br/>";
	$outputKondygnacje = '';
	$output = '';
	$output .= '<div class="mjmapperarea mt-5">';
	//$output .= '<p class="blockBackToFirst"><span class="backToFirst">Powrót</span></p>';

	$outputKondygnacje .=  '<button class="more gold-button small-margin-top  m-auto d-inline-block active" onclick=\'switchDisplayMode("interactive_view", this)\'>Widok interaktywny</button>';
	$outputKondygnacje .=  '<button class="more gold-button small-margin-top  ml-5 d-inline-block" onclick=\'switchDisplayMode("table_view", this)\'>Tabela mieszkań</button>';

	$output .= '<div class="invest-search extendfull">';

	// Widok interaktywny
	$output .= '<div class="interactive_view">';

	// Przelaczanie sie miedzy kondygnacjami
		$getKondygnacje = $getPosts;
		$outputKondygnacje .= '<div class="kondygnacje interactive_view">';
		$outputKondygnacje .= '<h4>Wybierz piętro</h4>';
		$outputKondygnacje .= '<div class="kondygnacje--container">';

		$outputKondygnacje .= '<div>';

		$outputKondygnacje .= '<select id="numberFloor" onchange="switchInteractiveLayer(this)">';

		foreach($getKondygnacje as $key => $kondygnacja) {
			#if($key == 0) { 
				//$key
			#	$outputKondygnacje .= '<option data-title="'.$kondygnacja->post_title.'" value="'.$kondygnacja->post_title.'" class="active btn btn-primary more">'.$kondygnacja->post_title.'</option>';

				//$outputKondygnacje .= '<button data-layer="'.$key.'" onclick="switchInteractiveLayer(this)" type="button" class="active btn btn-primary more">'.$kondygnacja->post_title.'</button>';
			#} else { 
				//$outputKondygnacje .= '<button data-layer="'.$key.'" onclick="switchInteractiveLayer(this)" type="button" class="btn btn-primary more">'.$kondygnacja->post_title.'</button>';
				//$key
				$outputKondygnacje .= '<option data-title="'.$kondygnacja->post_title.'" value="'.$kondygnacja->post_title.'" class="btn btn-primary more">'.$kondygnacja->post_title.'</option>';
			#}
			
		 
		}
		$outputKondygnacje .= '</select>';
		$outputKondygnacje .= '</div>';
		$outputKondygnacje .= "</div>";

		// Wroc do modelu
		$outputKondygnacje .= "<div class='backToModel'>";
		$outputKondygnacje .= '<button value="'.$nazwaInwestycji.'" onclick="switchInteractiveLayer(this)" type="button" class="active btn btn-primary more">Wróć do modelu</button>';
		$outputKondygnacje .= "</div>";

		// 
		$outputKondygnacje .= "<div class='legend'>";
		$outputKondygnacje .= '<ul><li>dostępne</li><li>zarezerwowane</li><li>sprzedane</li></ul>';
		$outputKondygnacje .= "</div>";

		$outputKondygnacje .= "</div>";
 
	
	// Koniec przelaczania sie miedzy kondygnacjami
	foreach($getPosts as $key => $itemMap) { 
		$output .= '<div class="block-group" data-title="'.$itemMap->post_title.'">';
		$output .= '<h2 class="title-section">'.$itemMap->post_title.'</h2>';
		$output .= '<div class="block-inner">';
		$output .= do_shortcode( '[imagemap id="'.$itemMap->ID.'"]' );
		$output .= '</div>';
		$output .= '</div>';
	}
	$output .= '</div>';
	// Koniec widoki interaktywnego

	// Widok tabeli
	$output .= '<div class="table_view">';

	##spr
	#print_r($nazwaInwestycji);
	##
	$output .=   do_shortcode( '[tablemap id="'.$nazwaInwestycji.'" view="single"]' );
	$output .= '</div>';
	// koniec widoku tabeli
	$output .= '</div>';

	$output .= '</div>';
	return $outputKondygnacje.$output;


 }
  
/* Displays the image map in a frontend page. */
function imgmap_frontend_image($id, $element_id) {
	$atts = array(
		'id' => $id,
		'element_id' => $element_id);
	return imgmap_frontend_image_shortcode($atts);
}

function imgmap_frontend_image_shortcode( $atts ) {
	global $element_id_count;  // prevent duplicate maps
	$element_id_count++;		// start with 1
	$id = $atts['id'];			// get the map id from the passed-in attributes
	if (isset($atts['element_id']))
		$element_id = $atts['element_id'];
	else
		$element_id = $id . '-' . $element_id_count;    // build the unique identifier
													// carry on with the original processing
	$areas = array();
	$value = '
	<div class="imgmap-frontend-image" id="highlightarea'.$id.'">
	<div class="imgmap-dialog-wrapper" id="imgmap-dialog-'.$element_id.'"></div>
	<img src="'.get_post_meta($id, 'imgmap_image', true).'" usemap="#imgmap-'.$element_id.'" id="imagemap-'.$element_id.'" />
	<map name="imgmap-'.$element_id.'">';
	$areas = get_posts('post_parent='.$id.'&post_type='.IMAGEMAP_AREA_POST_TYPE.'&numberposts=-1');
	foreach($areas as $a) {
		$value .= imgmap_create_area_element($a->ID, $a->post_title);
	}
	$value .= '</map>';
	
	$altLink = get_option('imgmap-alternative-link-positions');
	
	if($altLink == 'hidden' || $altLink == 'visible') {
		
		if($altLink == 'hidden') {
			$value .= '
			<a class="altlinks-toggle" data-parent="'.$element_id.'">Show links</a>
			<div class="altlinks-container imgmap-hidden" id="altlinks-container-'.$element_id.'">';
		}
		else
			$value .= '<div class="altlinks-container">';
		
		
		foreach($areas as $a) {
			$title = $a->post_title == '' ? '(untitled)' : $a->post_title;
			$meta = imgmap_get_imgmap_area_vars($a->ID);
			$meta->type = isset($meta->type) ? $meta->type : 'popup';
			$url = $meta->type == 'link' ? ' href="'.imgmap_get_link_url($meta).'"' : '';
			$value .= '<a class="alternative-links-imagemap"'.$url.' data-key="area-'.$a->ID.'" data-type="'.$meta->type.'" data-parent="imgmap-'.$element_id.'">'.$title.'</a>, ';
		}
		$value = substr($value, 0, -2);
		$value .= '</div>';
	}
	$value .= '
	</div>';
	return $value;
}
function imgmap_frontend_search($atts) {
	
    $output_search = '';  
    $options = '';
	$typy_transakcji = '';

	//1239
	// Jesli jest wybeane pole z ACF trzymające informacje o inwestycjach.
	if(!empty(get_option('id_acf_imagemapping'))) {
		$post_acf_id = get_option('id_acf_imagemapping');
	} else { 
		$post_acf_id = null;
	}

	// Sprawdz czy sa zmapowane typy transakcji

	if(!empty(get_option('id_acf_imagemapping_transaction'))) {
		$post_acf_id_transaction = get_option('id_acf_imagemapping_transaction');
	} else { 
		$post_acf_id_transaction = null;
	}

	if($post_acf_id_transaction != null) { 
		// Zwracaj transakcje do selecta
		$typy_transakcji .= '<option value="">Wszystkie</option>';
		foreach((@unserialize(@get_post($post_acf_id_transaction)->post_content)['choices']) as $key => $choice) {
			if(
				($key == trim(@$_POST['typ_transakcji'])) ||
				($key == trim(@$atts['id']))
			) {
				$typy_transakcji .= '<option selected="selected" value="'.$key.'">'.$choice.'</option>';
			} else {
				$typy_transakcji .=	 '<option  value="'.$key.'">'.$choice. '</option>';
			}
		}
	} else { 
	}

	if($post_acf_id != null) { 
		// Zwracaj inwestyje do selecta
		foreach((@unserialize(@get_post($post_acf_id)->post_content)['choices']) as $key => $choice) {
			if(
				($key == trim(@$_POST['inwestycja'])) ||
				($key == trim(@$atts['id']))
			) {
				$options .= '<option selected="selected" value="'.$key.'">'.$choice.'</option>';
			} else {
				$options .=	 '<option  value="'.$key.'">'.$choice. '</option>';
			}
		}
	} else { 
	}
 
	if(@$atts['id']) {
		$args = array(
				'category'         => 0,
				'numberposts'      => -1,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'include'          => array(),
				'exclude'          => array(),
				'post_type'        => 'imagemap_area',
			// 'suppress_filters' => true,
				'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'Typ',
					'value' => 'Mieszkanie',
					'compare' => '=',
				),
				array(
					'key' => 'Inwestycja',
					'value' => (array)@$atts['id'],// @$atts['id'] //
					'compare' => 'IN',
				),
				array(
					'key' => 'Status',
					'value' => 'Sprzedane',
					'compare' => '!=',
				),
			)
		);
} else {
	$args = array(
		'category'         => 0,
		'numberposts'      => -1,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => array(),
		'exclude'          => array(),
		'post_type'        => 'imagemap_area',
	   // 'suppress_filters' => true,
		'meta_query' => array(
		   'relation' => 'AND',
		   array(
			 'key' => 'Typ',
			 'value' => 'Mieszkanie',
			 'compare' => '=',
		   ),
		   array(
			 'key' => 'Status',
			 'value' => 'Sprzedane',
			 'compare' => '!=',
		   ),
	)
);
}

	$getPosts = get_posts($args);
	

	$typ_nieruchomosci_list = [];
	$pokoje_list = [];
	$pietra_list = [];
	$powierzchnie_list = [];
	foreach($getPosts as $post) { 
		
		if(!in_array(get_field('typ_nieruchomosci', $post->ID), $typ_nieruchomosci_list)) {
			$typ_nieruchomosci_list[] = get_field('typ_nieruchomosci', $post->ID);
		}

		if(!in_array(get_field('pokoje', $post->ID), $pokoje_list)) {
			$pokoje_list[] = get_field('pokoje', $post->ID);
		}
		if(!in_array(get_field('powierzchnia', $post->ID), $pokoje_list)) {
			$powierzchnie_list[] = get_field('powierzchnia', $post->ID);
		}
		if(!in_array(get_field('pietro', $post->ID), $pietra_list)) {
			$pietra_list[] = get_field('pietro', $post->ID);
		}
	}
	
	sort($pietra_list);
	sort($pokoje_list);
	sort($powierzchnie_list);

	$min_powierzchnia = @min($powierzchnie_list);
	$max_powierzchnia = @max($powierzchnie_list);

	$output_search .= '<div class="row-full only-dev">'; 
	$output_search .= '<div class="container">'; 
	$output_search .= '<div class="row">'; 
	$output_search .= '<div class="col-md-12">';
    //$output_search .= '<h2 class="title-section mt-5">Wyszukaj</h2>'; 
    $output_search .= '<form class="image_search_form" method="POST">'; 


	// Typ zwracanej wyszukiwarki [mieszkanie, lokal_uslugowy, miejsce_postojowe]

	$output_search .= imgmap_frontend_property_types();
	$output_search .= '<input type="hidden" name="typ_wyszukiwarki" id="typ_wyszukiwarki" value="mieszkanie"/>';

	// Url wysyłanego formularza
	$output_search .= '<input type="hidden" id="filter_site_url" value="'.get_site_url().'"/>';
	
	// Tryb wyświetlania -> zakładka /deweloper lub widok pojedyńczej inwestycji
	$output_search .= "<input type='hidden' name='view' id='view' value='".@$atts['view']."'/>";

	// Wybór aktualnego miasta
	$output_search .= "<input type='hidden' name='lokalizacja' id='lokalizacja' value=''/>";
    $output_search .= '<div class="row panel">';

	// Typ nieruchomości
	$output_search .= '<div class="col-md-6 col-lg-3">';

	#$output_search .= print_r($typ_nieruchomosci_list);

	$output_search .= '<label>Typ nieruchomości</label><div class="custom-select-opt typ_nieruchomosci_select"><select name="typ_nieruchomosci" onchange="ajaxImagemapperSearch(this)">';
	
	$output_search .= '<option data-type="Wybierz" value="">Wybierz</option>';
	$output_search .= '<option value="">Wszystkie</option>';
	foreach ($typ_nieruchomosci_list as $key => $value) {
		if(@$_POST['typ_wyszukiwarki'] == 'lokal_uzytkowy') {
			// Tylko lokal uzytkowy
			if($value['value'] == 'Lokal usługowy') {
				$output_search .= '<option data-type="'.$value['label'].'" value="'.$value['value'].'">'.$value['label'].'</option>';	
			}
		} else if(@$_POST['typ_wyszukiwarki'] == 'miejsce_postojowe') {
			// Tylko miejsce postojowe
			if($value['value'] == 'Lokal usługowy') {
				$output_search .= '<option data-type="'.$value['label'].'" value="'.$value['value'].'">'.$value['label'].'</option>';	
			}
		} else {
			$output_search .= '<option data-type="'.$value['label'].'" value="'.$value['value'].'">'.$value['label'].'</option>';	
		}
	}
	
	//$output_search .= '<option value="Mieszkanie">Mieszkanie</option>';
	$output_search .= '</select></div>';
	$output_search .= '</div>';

	// Inwestycja (jej nazwa - ukryte)
    $output_search .= '<div class="col-md-6 col-lg-3 d-none">';
	// d-none
    $output_search .= '<label>Inwestycja</label><select multiple name="inwestycja[]" onchange="ajaxImagemapperSearch(this)">'; 
	//$output_search .= "<option value=''>Wszystkie</option>";
	$output_search .= @$options;
    $output_search .= '</select>'; 
    $output_search .= '</div>';
    
	// Powierzchnia
	$output_search .= '<div class="col-md-6 col-lg-3" data-type="lokal_uslugowy,mieszkanie" >';

	$output_search .= ' 
	<div class="d-none d-lg-block" style="background:transparent;">
		<label for="price">Powierzchnia</label>  
		<input type="text" data-min="'.$min_powierzchnia.'" data-max="'.$max_powierzchnia.'" id="powierzchnia_content" onchange="ajaxImagemapperSearch(this)" style="border:0px;">  
		<div id="slide" ></div>
	</div>
		';
		
	$output_search .= '
	<div class="d-block d-lg-none">
	<label>Metraż od </label><input type="number" onchange="ajaxImagemapperSearch(this)" value="'.@$_POST['metraz'].'" class="form-control" name="metraz">'; 

    $output_search .= '<label>Metraż do </label><input type="number"  onchange="ajaxImagemapperSearch(this)" value="'.@$_POST['metraz_do'].'"  class="form-control" name="metraz_do">'; 

    $output_search .= '</div>
	</div>';
	// Pietra
    $output_search .= '<div class="col-md-6 col-lg-3" data-type="mieszkanie,lokal_uslugowy">';
    $output_search .= '<label>Piętro</label>';

	$output_search .= "<div class='checkbox-container' onclick='toggleCheckboxList(this)'>";

	$output_search .= '<input type="text" onchange="ajaxImagemapperSearch(this)" value="'.@$_POST['pietro'].'" readonly class="no-input cursor-pointer" name="pietro">'; 

	// Zwróć listę pieter
	$output_search .= "<div>";
	foreach ($pietra_list as $key => $value) {
		//<label class="container">Four
//   <input type="radio" name="radio">
//   <span class="checkmark"></span>
// </label>

		$output_search .= '<label class="container-checkbox"><input data-input="pietro" onclick="setCheckboxOption(this)" type="checkbox" value="'.$value.'"><span class="checkmark"></span>'.$value.'</label>';	 
	}
	$output_search .= "</div>";
	$output_search .= "</div>";
	$output_search .= "</div>";

	// Pokoje
    $output_search .= '<div class="col-md-6 col-lg-3" data-type="mieszkanie">';
    $output_search .= '<label>Pokoje</label>';
	
	$output_search .= "<div class='checkbox-container' onclick='toggleCheckboxList(this)'>";

	$output_search .= '<input type="text" onchange="ajaxImagemapperSearch(this)" value="'.@$_POST['pokoje'].'" readonly   class="no-input cursor-pointer" name="pokoje">'; 

	// Zwróć listę pokoi
	$output_search .= "<div>";
	foreach ($pokoje_list as $key => $value) {
		$output_search .= '<label  class="container-checkbox"><input data-input="pokoje" onclick="setCheckboxOption(this)" type="checkbox" value="'.$value.'"><span class="checkmark"></span>'.$value.'</label>';	 
	}
	$output_search .= "</div>";
	$output_search .= "</div>";

    $output_search .= '</div>';

	// Typ sprzedazy (spzedaz / wynajem)
	$output_search .= '<div class="col-md-6 col-lg-3" data-type="lokal_uslugowy,miejsce_postojowe" style="display:none;">';
	$output_search .= '<label>Typ transakcji</label>
	<div class="custom-select-opt"><select name="typ_transakcji" onchange="ajaxImagemapperSearch(this)">'; 
	$output_search .= "<option value=''>Wszystkie</option>";
	$output_search .= @$typy_transakcji;
	$output_search .= '</select>'; 
	$output_search .= '</div>';
	//
	
    $output_search .= '</div>';
    $output_search .= '</select></div>'; 
    $output_search .= '<button type="button" id="search_button" onclick="ajaxImagemapperSearch(this)" name="imagemapper_search" style="border:0px;border-radius:0px;" class="more gold-button small-margin-top  m-auto d-table imagemapper_search"><em>Wyszukaj</em></button>'; 
    $output_search .= '</form>'; 
	$output_search .= '</div>'; 
	$output_search .= '</div>'; 
	$output_search .= '</div>'; 
	$output_search .= '</div>'; 
    
    if(isset($_POST['imagemapper_search'])) {
        $atts=array();
        $atts['id'] = (array)@$_POST['inwestycja'];
        return $output_search.imgmap_frontend_table($atts, $_POST, 'search');
    }
    return $output_search;
}
function imgmap_frontend_table($atts, $filters, $type) {
	
	$listaInwestycji = [];

    if($atts) {
		$inwestycja = $atts['id'];
		// Typ wyszukiwarki
		$typWyszukiwarki = $atts['typ_wyszukiwarki'];
    }
    $addons_filters = array();
    if($filters) {
		//print_r($filters);
		
        foreach($filters as $key => $filter) {
            if(($key != 'imagemapper_search') && ($key != 'inwestycja') && ($key != 'view')) {
                if($filter != '') {
                if(($key == 'cena') || ($key == 'powierzchnia')) {
                     $add_option = array(
                         'key' => $key,
                         'value' => $filter,
                         'compare' => '=<',
                       );
                     array_push($addons_filters, $add_option);
                } else if(($key == 'metraz') || ($key == 'metraz_do')) {
                    if ($key == 'metraz') {
                        $add_option = array(
                         'key' => 'powierzchnia',
						 'value' => $filter,
						 'type' => 'numeric',
                         'compare' => '>=',
                       );
                        array_push($addons_filters, $add_option);
					}
                    if ($key == 'metraz_do') {
						$add_option = array(
                         'key' => 'powierzchnia',
						 'value' => $filter,
						 'type' => 'numeric',
                         'compare' => '<=',
                       );
                        array_push($addons_filters, $add_option);
                    }
                } else {
					//Jesli mamy checkboxa 
					if(($key == 'pokoje') || ($key == 'pietro')) {
						$values = explode(",",$filter);  
						$add_option = array(
							'key' => $key,
							'value' => $values,
							'compare' => 'IN',
						  );
					} else {
                        $add_option = array(
                         'key' => $key,
                         'value' => $filter,
                         'compare' => '=',
                       );
					}
                        array_push($addons_filters, $add_option);
                    }
                }
                }
            }
            //$addons_filters = $filter;
        }
    //    print_r($addons_filters);
    //    exit();
	$output = '';
	$mode='';
    if (!$filters) {
		$output .= ''.imgmap_frontend_search($atts);
		$mode = 'hidden';
    }
	
	//Jesli inwestycja nie jest tablicą utwórz ją (dla widoku pojedynczej inwestycji)
	if(!is_array($inwestycja)) { 
		$inwestycja = (array)$inwestycja;
	}

	// if($key == 'typ_wyszkiwarki') {
	// 	$add_option = array(
	// 		'key' => $key,
	// 		'value' => 'mieszkanie',
	// 		'compare' => '=',
	// 	  );
	// 	  array_push($addons_filters, $add_option);
	// }

	if(empty($_POST['typ_wyszukiwarki'])) { 
		$wyszukiwarkaFilter =  array(
			'key' => 'typ_wyszukiwarki',
			'value' => 'mieszkanie',
			'compare' => '=',
		);
	} else {
		$wyszukiwarkaFilter = null;
	}
	// Jesli inwestycja jest tablica i ma przynajmniej 1 wybrana opcje
	if((is_array($inwestycja)) && (count($inwestycja) > 0)) { 
		$args = array(
			'category'         => 0,
			'numberposts'      => -1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => array(),
			'exclude'          => array(),
			'post_type'        => 'imagemap_area',
			'post_status'        => 'publish',
		   // 'suppress_filters' => true,
			'meta_query' => array(
			   'relation' => 'AND',
			   array(
				 'key' => 'Typ',
				 'value' => 'Mieszkanie',
				 'compare' => '=',
			   ),
			   array(
				 'key' => 'Inwestycja',
				 'value' => (array)$inwestycja,
				 'compare' => 'IN', //=
			   ),
			   array(
				 'key' => 'Status',
				 'value' => 'Sprzedane',
				 'compare' => '!=',
			   ),
				$wyszukiwarkaFilter,
			   	$addons_filters
				
		));
	} else { 
		$args = array(
			'category'         => 0,
			'numberposts'      => -1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => array(),
			'exclude'          => array(),
			'post_type'        => 'imagemap_area',
		   // 'suppress_filters' => true,
		   'post_status'        => 'publish',
			'meta_query' => array(
			   'relation' => 'AND',
			   array(
				 'key' => 'Typ',
				 'value' => 'Mieszkanie',
				 'compare' => '=',
			   ),
			   array(
				 'key' => 'Status',
				 'value' => 'Sprzedane',
				 'compare' => '!=',
			   ),
			   $wyszukiwarkaFilter,
			   $addons_filters
				
		));
	}
 	#print_r($args);
	$getPosts = get_posts($args);

	foreach($getPosts as $post) { 
		//Jesli dana inwestycja nie jest w tablicy dodaj ja
		if(!in_array(get_field('inwestycja', $post->ID), $listaInwestycji)) { 
			$listaInwestycji[] = get_field("inwestycja", $post->ID);
		}
	}

	$outputInwestycje .= '<div class="only-dev-real row-full">';
	$outputInwestycje .= '<div class="container">';
	$outputInwestycje .= '<div class="row">';
	foreach($listaInwestycji as $inwest) { 
		$getPostByTitle = get_post_by_title($inwest);
		if($getPostByTitle->post_status == 'publish') {
		$outputInwestycje .= '<div class="col-md-6 col-lg-3">';
		$outputInwestycje .= '<a href="'.get_permalink($getPostByTitle->ID).'"><div class="thumbnail-inwestycje" style="background-image:url('.get_the_post_thumbnail_url($getPostByTitle->ID).');">';
		
		//'. $getPostByTitle->ID.' 
		$outputInwestycje .= '</div></a>';
		$outputInwestycje .= '<a class="mj-invest-title" href="'.get_permalink($getPostByTitle->ID).'">'.$inwest .'</a>';
		$outputInwestycje .= '<p>'.get_field('lokalizacja', $getPostByTitle->ID).'</p>';
		$outputInwestycje .= '</div>';
		}
	}
	$outputInwestycje .= '</div>';
	$outputInwestycje .= '</div>';
	$outputInwestycje .= '</div>';

	if($filters) {
		//Jesli wywołujemy shortcode w widku innym niz pojedynczej inwestycji pokaz miniatury innych inwestycji
		if(@$atts['view'] != 'single') {
			$output .= $outputInwestycje;
		}
		#$output .= '<h2 class="title-section">Tabela mieszkań</h2>';
	} else {
		$output .= '<div id="firstAjaxSearchResult">';
		//Jesli wywołujemy shortcode w widku innym niz pojedynczej inwestycji pokaz miniatury innych inwestycji
		if(@$atts['view'] != 'single') {
			$output .= $outputInwestycje;
		}
		
		$output .= '<h2 class="title-section">Tabela mieszkań</h2>';
		$output .= '</div>';
	}
	

    if (($mode != 'hidden') || (count($_POST) == 0)){
		if($type != 'ajax')	{

		}
		#$output .= '<div class="table-responsive">';
		//$output .= "typ wyszukiwarki: ".$typWyszukiwarki;
        $output .= '<table id="tabela_mieszkania" class="table-responsive dataTable no-footer table">';
        $output .= '<thead><tr>';
		$output .= '<th>';
        $output .= 'Inwestycja';
        $output .= '</th>';
        $output .= '<th>';
        $output .= 'Nr';
        $output .= '</th>';
        $output .= '<th>';
        $output .= 'Status';
        $output .= '</th>';
		// Dla lokale usługowe i mieszkania
		if($typWyszukiwarki != 'miejsce_postojowe') {
        $output .= '<th>';
        $output .= 'Piętro';
        $output .= '</th>';
		}
		// Tylko dla tabeli mieszkania
		if(($typWyszukiwarki == 'mieszkanie') || ($typWyszukiwarki == null)) {
			$output .= '<th>';
			$output .= 'Pokoje';
			$output .= '</th>';
		}
		// Dla lokale usługowe i mieszkania
		if($typWyszukiwarki != 'miejsce_postojowe') {
			$output .= '<th>';
			$output .= 'Metraż (m<sup>2</sup>)';
			$output .= '</th>';
		}
        $output .= '<th>';
        $output .= 'Cena';
        $output .= '</th>';

		// Dla lokale usługowe i miejsca postojowe
		if(($typWyszukiwarki == 'lokal_uslugowy') || ($typWyszukiwarki == 'miejsce_postojowe')) {
			$output .= '<th>';
			$output .= 'Typ transakcji';
			$output .= '</th>';
		}

        $output .= '<th>';
        $output .= 'Rzut';
        $output .= '</th>';
        $output .= '</tr></thead>';      
 
        $output .= '<tbody>';

        foreach ($getPosts as $post) {

			$getPostByTitle = get_post_by_title(get_field("inwestycja", $post->ID));
			if($getPostByTitle->post_status == 'publish') {
            $output .= '<tr>';
			$output .= '<td>';
            $output .= ''.get_field("inwestycja", $post->ID);
            $output .= '</td>';

            $output .= '<td>';
            $output .= ''.get_field("numerlokalu", $post->ID);
            $output .= '</td>';
        
            $output .= '<td>';
            $output .= get_field("status", $post->ID);
            $output .= '</td>';
        
			// Dla lokale usługowe i mieszkania
			if($typWyszukiwarki != 'miejsce_postojowe') {
				$output .= '<td>';
				$output .= get_field("pietro", $post->ID);
				$output .= '</td>';
			}
			// Tylko dla tabeli mieszkania
			if(($typWyszukiwarki == 'mieszkanie') || ($typWyszukiwarki == null)) {
				$output .= '<td>';
				$output .= get_field("pokoje", $post->ID);
				$output .= '</td>';
			}

			// Dla lokale usługowe i mieszkania
			if($typWyszukiwarki != 'miejsce_postojowe') {
				$output .= '<td>';
				if((float)get_field("powierzchnia", $post->ID) > 0) {
				$output .= @number_format((float)get_field("powierzchnia", $post->ID), 2, '.', ' ');
				$output .= 'm<sup>2</sup></td>';
				} else { 
					$output .= '';
				}
			}
        
            $output .= '<td>';
            if (!empty(@number_format((float)get_field("cena", $post->ID), 2, '.', ' '))) {
				if((int)get_field("cena", $post->ID) == '0') {
					//$output .= 'Zapytaj o cenę';
					$output .=  '	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal'.$post->ID.'" style="padding: 0;background: transparent;color: inherit;border: 0;font-size: inherit;">
  Zapytaj o cenę
</button>';

$output .= '<!-- Modal -->
<div class="modal fade" id="Modal'.$post->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
        </button>
		</div>
      <div class="modal-body">
	  <form method="POST" class="sendQuestionForm">
	  <div class="row text-left">
	  
	  <div class="col-md-12">
	    <p class="modal-title col-md-12" id="exampleModalLabel">Uprzejmie prosimy o wypełnienie poniższego formularza, abyśmy mogli skontaktować się z Państwem i przedstawić ofertę, dotyczącą wybranego lokalu.</p>
	  </div>
	  <div class="col-md-6">
			<label>Imię i nazwisko *</label>		
			<input type="text" required name="imie_nazwisko" class="form-control">
			<label>Telefon *</label>		
			<input type="text" required name="telefon" class="form-control"/>
			<label>E-mail *</label>		
			<input type="email" required name="email" class="form-control"/>
			<input type="hidden" name="lokal" value="'.get_field("numerlokalu", $post->ID).'"/>
			<input type="hidden" name="inwestycja" value="'.get_field("inwestycja", $post->ID).'"/>
	  </div>
			<div class="col-md-6">
				<label>Wiadomość</label>
				<textarea name="tresc" class="form-control" required style="min-height:300px">Proszę o kontakt w sprawie '.get_field("numerlokalu", $post->ID).' lokalu w inwestycji '.get_field("inwestycja", $post->ID).'</textarea>
			</div>
			<div class="col-md-12 accept">
					<label><input type="checkbox" name="rule1" value="1" required>
					Administratorem Państwa danych osobowych jest Przedsiębiorstwo Budowalne "Calbud" Sp. z o.o z siedzibą w Szczecinie. Wysyłając wiadomość zgadzasz się z naszą Polityką Prywatności
					</label>

					<label><input type="checkbox" name="rule2" value="1" required>
					Wyrażam zgodę Administratorowi Przedsiębiorstwo Budowlane "Calbud" sp. z o.o w Szczecinie oraz spółkom powiązanym z grupy kapitałowej Administratora na przesłanie informacji handlowych związanych ze sprzedazą lokali za pomocą środków komunikacji elektronicznej i/lub telefonu oraz wyrazam tym podmiotom zgodę na przetwarzanie moich danych osobowych w postaci emaila, teleofnu oraz innych udostępnionych danych dla realizacji tego celu.
					</label>
					<label><input type="checkbox" required>
					Wyrażam zgodę Administratorowi Przedsiębiorstwo Budowlane "Calbud" sp. z o.o w Szczecinie oraz spółkom powiązanym z grupy kapitałowej Administratora na marketing dotyczący lokali oferowanych przez Administratora i podmioty powiązane za pomocą środków komunikacji elektornicznej i/lub telefonu oraz wyrazam tym podmiotom zogdę na przetwarzanie moich danych osobowych w postaci emaila, telefonu oraz innych udostępnionych danych dla realizacji tego celu.
					</label>
					<button name="send_question" type="button" onclick="ajaxSendQuestion(this)" class="orange">Wyślij zapytanie</button>
					<p>* pozycje obowiązkowe</p>
			</div>
			
			<div class="formFlashMessage"></div>
			
			</form>
	  </div>
      </div>
       
    </div>
  </div>
</div>';
				} else {
                $output .= @number_format((float)get_field("cena", $post->ID), 2, '.', ' ').' zł';
				}
            }
            $output .= '</td>';

			// Dla lokale usługowe i miejsca postojowe
			if(($typWyszukiwarki == 'lokal_uslugowy') || ($typWyszukiwarki == 'miejsce_postojowe')) {
				$output .= '<td>';
				if(get_field("typ_transakcji", $post->ID) != '') {
				$output .= get_field("typ_transakcji", $post->ID)['label'];
				$output .= '</td>';
				} else { 
					$output .= '';
				}
			}

            $output .= '<td>';
            if (!empty(get_field("rzut", $post->ID)['url'])) {
                $output .= '<a target="_blank" href="'.get_field("rzut", $post->ID)['url'].'" class="more more-reverse" style="min-width: 50%;padding: 0px 10px;font-size: 20px !important;"><em style="font-size: 14px;line-height: 44px;">Pobierz rzut</em></a>';
            }
            //$output .= print_r();
            $output .= '</td>';
            $output .= '</tr>';
        }
	}
        $output .= '</tbody>';
        $output .= '</table>';
		#$output .= '</div>';
    }
	//echo "FILTER:".print_r($_POST);
	
    //if(count($_POST) == 0) {
    
	//}

	#$output .= print_r($args);
	if(count($getPosts) == 0)  {
		$output .= '<div class="alert alert-info">Żaden z elementów nie spełnia podanych kryteriów wyszukiwania</div>';
	}
	// echo "FILTER:".$type;
	if($type == 'search') {
	// 	echo "FFF##".$output;
	// 	return $type.$output;
	    return $output;
	} else {
		return $output;
	}
}

add_shortcode( 'imagemap', 'imgmap_frontend_image_shortcode' );
add_shortcode( 'tablemap', 'imgmap_frontend_table' );
add_shortcode( 'searchmap', 'imgmap_frontend_search' );
add_shortcode('button_city_list', 'imgmap_frontend_city_list');

#add_shortcode('button_type_property', 'imgmap_frontend_property_types');

// Dodaj wszystkie mapy związane z daną inwestycją za pomocą jednego shortcoda
add_shortcode( 'allimagemap', 'all_imgmap_frontend_image_shortcode' );
add_shortcode( 'search_mjwpimagemapper', 'all_search_frontend_shortcode' );

function imgmap_frontend_property_types() { 

//mieszkanie] [lokal usługowy] [miejsce postojowe
	$typesProperty = [
		"mieszkanie" => "Mieszkanie",
		"lokal_uslugowy" => "Lokal usługowy",
		"miejsce_postojowe" => "Miejsce postojowe",
	];
	$output = '';

	$output .= '<div class="col-md-12 text-center">';
	$output .= '<h3>Czego szukasz?</h3>';
	$output .= '</div>';


	$output .= '<div class="col-md-12 text-center">';
	$output .= '<ul class="nav mb-5">';

	foreach($typesProperty as $key => $property) { 
		$output .= '<li class="propertyItem">';
		if($key == 'mieszkanie') {
		$output .= '<button  type="button" class="nav-link gold-button active" onclick="setTypeProperty(this)" value="'.$key.'" data-type="'.$key.'">'; 
		} else { 
			$output .= '<button type="button"  class="nav-link gold-button" onclick="setTypeProperty(this)" value="'.$key.'" data-type="'.$key.'">'; 
		}
		$output .= $property;
		$output .= '</button>';
		$output .= '</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	
	return $output;
}
function imgmap_frontend_city_list() {
	$city_list = [];
	 
	$categoryInvestitionCity = get_option('mjimagemapper_category_city');
	$args = array( 
		'category' => get_option('mjimagemapper_category_city'),//'10',
		'post_type' => 'post',
		'post_status' => 'publish' // ?
		);
		
		$posts = get_posts( $args );
		
		$inwestycja = [];
		$inwestycjaCity = [];

		foreach ($posts as $key => $post) {
			/**
			 * Tablica miast do zwrócenia na froncie
			 */
			if(!in_array(get_field('lokalizacja', $post->ID) ,$city_list)) {
				$city_list[] = get_field('lokalizacja', $post->ID);
			}

			// Jesli danej inwestycji nie ma w tablicy dodaj ja
			if(!in_array(trim($post->post_title), $inwestycja)) {

				// Odloz dana inwestycje w tablicy
				$inwestycja[] = trim($post->post_title);
				
				// Powiaz inwestycje z miastem
				$inwestycjaCity[get_field('lokalizacja', $post->ID)][] = trim($post->post_title);
			}
		}


		$output = '';
		##$output .= print_r($inwestycjaCity);
		$output .= '<ul class="developer-city nav mb-5">';

		$output .= '<li>';
		$output .= '<button class="nav-link active" onclick="setLokalizacja(this)" value="" data-inwestycje="">'; //name="lokalizacja"
		$output .= 'Wszystkie';
		$output .= '</button>';
		$output .= '</li>';

		//$output .= print_r($city_list);
		foreach($city_list as $city) { 
		 
			//$output .= print_r(implode(";",$inwestycjaCity[$city]));
			$inwestycja_attr = implode(";",$inwestycjaCity[$city]);

			if(!empty($city)) {
				$output .= '<li>';
				//$output .= print_r($inwestycja_attr[$city]);
				$output .= '<button class="nav-link" data-inwestycje="'.$inwestycja_attr.'" onclick="setLokalizacja(this)"  value="">'; //name="lokalizacja"
				$output .= $city;
				$output .= '</button>';
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
	return $output;
}

/* Fields for adding new areas to the imagemap using the editor.
 * However the editor functionality is included in the image field. */
function imgmap_form_addarea($post) {
	?><h4><?php _e('Wskazówki do tworzenia obszarów map'); ?></h4>
	<p><?php _e('Rozpocznij tworzenie kształtu nowego obszaru, klikając obraz mapy obrazu po lewej stronie.'); ?></p>
	<p><?php _e('Pierwszy i ostatni punkt ścieżki są łączone automatycznie'); ?></p>
<p><?php _e('Gdy kształt będzie gotowy, naciśnij przycisk poniżej.');?></p>
	<input type="button" value="Cofnij (Shift + LPM)" title="Shift + LPM" class="button" id="undo-area-button"/>
	<input type="button" value="Dodaj obszar" class="button" id="add-area-button" style="float:right"/>
	<?php
}

/* List of the current areas of the imagemap. 
 * Every element in the list has link to edit form of the area and a shortcut for deleting the areas. */
function imgmap_form_areas($post) {
	$areas = get_posts('post_parent='.$post->ID.'&post_type='.IMAGEMAP_AREA_POST_TYPE.'&orderby=id&order=desc&numberposts=-1');
	echo '<ul>';
	foreach($areas as $a) {
		echo imgmap_create_list_element($a->ID);
	}
	echo '</ul>';
}

/* Settings for the single imagemap area */
function imgmap_area_form_settings($post) { 
	$meta = imgmap_get_imgmap_area_vars($post->ID);
	$meta->title_attribute = isset($meta->title_attribute) ? $meta->title_attribute : '';
	?>
	<p><input style="width: 100%" type="text" name="area-title-attribute" value="<?php echo $meta->title_attribute; ?>" placeholder="HTML title attribute"></p>
	<p><a title="The HTML title attribute often shows as a small tooltip when mouse hovers over an element. No tooltip is shown if the field is left empty.">What is this?<br>Hover mouse over this text for an example.</a></p>
	<?php
}
/**
 * Koordynaty
 */
function imgmap_area_form_coords($post) { 
	// $imgmap_colors = get_option('imgmap_colors');
	// $meta = imgmap_get_imgmap_area_vars($post->ID);
	?> 
	<h4>Koordynaty</h4>
	<!-- <?php print_r($post); ?> -->
	<input type="text" name="coords" value="<?= esc_attr(get_post_meta($post->ID, 'coords', true)) ?>">
	<?php
}
/* Settings for the single imagemap area highlight */
function imgmap_area_form_highlight($post) {
	$imgmap_colors = get_option('imgmap_colors');
	$meta = imgmap_get_imgmap_area_vars($post->ID);
	?> 
	<h4>Highlight styles</h4>
	<div id="imgmap-area-styles"><?php
	foreach($imgmap_colors['colors'] as $key => $color) { 
		echo @imgmap_get_style_element($key, @$color, $meta->color);
	}
	if(count($imgmap_colors['colors']) == 0) 
		echo '<p>'.__('No styles found. Start by adding a new style.').'</p>';
	?><br style="clear:both;"></div>
	<a style="display: block; padding: 8px;" href="edit.php?post_type=imagemap_area&page=imagemapper.php">Add new</a><?php
}

function imgmap_get_style_element($key, $color, $chosen = false, $data = false) { 
	echo '
	<div class="imgmap-area-style'.($key == $chosen ? ' chosen' : '').'" data-id="'.$key.'" title="'.$key.'"
	'.($data ? '
	data-fill-color="'.esc_attr($color['fillColor']).'"
	data-fill-opacity="'.esc_attr($color['fillOpacity']).'"
	data-stroke-color="'.esc_attr($color['strokeColor']).'"
	data-stroke-opacity="'.esc_attr($color['strokeOpacity']).'"
	data-stroke-width="'.esc_attr($color['strokeWidth']).'"' :
	'').'>
		<div class="imgmap-area-color" style="
		background-color: '.imgmap_hex_to_rgba($color['fillColor'], $color['fillOpacity']).';
		box-shadow: 0 0 0 '.$color['strokeWidth'].'px '.imgmap_hex_to_rgba($color['strokeColor'], $color['strokeOpacity']).'"
		></div>
	</div>';
}

function imgmap_area_styles() { ?>
	<div class="wrap">
	<h2>Ustawienia podświetleń obszarów</h2>
	<div class="divide-left">
		<h3>Zapisne style</h3>
		<?php
		$imgmap_styles = get_option('imgmap_colors');
		?>
			<div id="imgmap-area-styles-edit"><?php 
				if(count($imgmap_styles['colors']) == 0) 
					echo '<p>'.__('No styles found. Start by adding a new style.').'</p>';
			
				foreach($imgmap_styles['colors'] as $key => $color) {
					echo imgmap_get_style_element($key, $color, false, true); }
				?>
		</div><br style="clear:both;">
	</div>
	<div class="divide-right">
	<h3>Dodaj/Edytuj style</h3>
		<div id="add-new-imgmap-style">
			<table>
			<tr>
				<th>Kolor wpełnienia</th>
				<th>Przezroczystość wypełnienia</th>
			</tr>
			<tr>
				<td>
					<div class="form-field">
						<input type="text" maxlength="6" id="imgmap-new-style-fillcolor" class="color-picker-field" placeholder="rrggbb" />
					</div>
				</td>
				<td>
					<div class="form-field">
						<input type="number" value="1" min="0" max="1" step="0.1" id="imgmap-new-style-fillopacity" />
					</div>
				</td>
			</tr>
			<tr>
				<th>Kolor obramownania</th>
				<th>Przezroczystość obramowania</th>
				<th>Szerokość obramowania</th>
			</tr>
			<tr>
				<td>
					<div class="form-field">
						<input type="text" maxlength="6" id="imgmap-new-style-strokecolor" class="color-picker-field" placeholder="rrggbb" />
					</div>
				</td>
				<td>
					<div class="form-field">
						<input type="number" value="1" min="0" max="1" step="0.1" id="imgmap-new-style-strokeopacity" />

					</div>
				</td>
				<td>
					<div class="form-field">
						<input type="number" value="1" min="0" step="1" id="imgmap-new-style-strokewidth" />
					</div>
				</td>
			</tr>
		</table>
			<p>
				<input type="button" class="button" id="add-new-imgmap-style-button" value="Dodaj nowy styl"> 
				<input type="button" class="button" id="edit-imgmap-style-button" value="Zapisz zmiany" disabled>
				<input type="button" class="button" id="delete-imgmap-style-button" value="Usuń styl" disabled>
			</p>
		</div>
	</div>
	<?php
}
		
function imgmap_imagemap_settings() {
	register_setting('imgmap-settings', 'imgmap-alternative-link-positions');
	
	if(!get_option('imgmap-alternative-link-positions'))
		update_option('imgmap-alternative-link-positions', 'off');
		
	if(!get_option('imgmap-pulse'))
		update_option('imgmap-pulse', 'never');
		
	
	?>
	<div class="wrap">
		<h2><?php _e('Ustawienia map obrazków'); ?></h2>
		<form method="post" action="<?php echo admin_url('admin.php'); ?>">

		<input type="hidden" name="action" value="imgmap_save_settings" />
		<?php wp_nonce_field('imgmap-settings'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><a title="Zawiera odpowiednie łącza do obszarów mapy obrazu pod obrazem. Użyj, jeśli martwisz się, czy użytkownicy mogą poprawnie korzystać z mapy obrazu.">Linki zastępcze dla obszarów.</a></th>
				<td>
					<input type="radio" name="imgmap-settings-fallback-link-position" value="off" <?php echo get_option('imgmap-alternative-link-positions') == 'off' ? 'checked' : ''; ?> /> <?php _e('Nie'); ?><br>
					<input type="radio" name="imgmap-settings-fallback-link-position" value="hidden" <?php echo get_option('imgmap-alternative-link-positions') == 'hidden' ? 'checked' : ''; ?> /> <?php _e('Ukyj'); ?><br>
					<input type="radio" name="imgmap-settings-fallback-link-position" value="visible" <?php echo get_option('imgmap-alternative-link-positions') == 'visible' ? 'checked' : ''; ?> /> <?php _e('Zawsze widoczne'); ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><a title="Highlights all areas for a short time when mouse is moved over an image map.">Podświetl wszystkie obszary</a></th>
				<td>
					<input type="radio" name="imgmap-settings-pulse" value="never" <?php echo get_option('imgmap-pulse') == 'never' ? 'checked' : ''; ?> /> <?php _e('Nigdy'); ?><br>
					<input type="radio" name="imgmap-settings-pulse" value="first_time" <?php echo get_option('imgmap-pulse') == 'first_time' ? 'checked' : ''; ?> /> <?php _e('Kiedy mysz jest przesuwana po mapie obrazu po raz pierwszy.'); ?><br>
					<input type="radio" name="imgmap-settings-pulse" value="always" <?php echo get_option('imgmap-pulse') == 'always' ? 'checked' : ''; ?> /> <?php _e('Zawsze po najechaniu myszką na mapę obrazu.'); ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><a title="Zastosuj jeśli domyślny szablon nie wyświetla się prawidłowo">Zastosuj nowego szablonu popup</a></th>
				<td>
					<input type="radio" name="imgmap-settings-alt-dialog" value="no" <?php echo !get_option('imgmap-alt-dialog') ? 'checked' : ''; ?> /> <?php _e('Nie'); ?><br>
					<input type="radio" name="imgmap-settings-alt-dialog" value="yes" <?php echo get_option('imgmap-alt-dialog') ? 'checked' : ''; ?> /> <?php _e('Tak'); ?><br>
				</td>
			</tr>
			<tr>
				<th>
				 
					<a>Podaj ID strony z wtyczki ACF z której bedą pobierane właściwości do nieruchomości
					</a>
					</th>
				<td>
					<input type="number" name="id_acf_imagemapping"  
					value="<?php echo get_option('id_acf_imagemapping'); ?>" class="form-control"/>
				</td>
				
			</tr>
			<tr>
			<th>
				 
				 <a>Podaj ID strony z wtyczki ACF z której bedą pobierane typy transakcji
				 </a>
				 </th>
			 <td>
				 <input type="number" name="id_acf_imagemapping_transaction"  
				 value="<?php echo get_option('id_acf_imagemapping_transaction'); ?>" class="form-control"/>
			 </td>
			
			</tr>

			<tr>
				<th>
				 
					<a>Podaj numer telefonu który będzie widoczny w szczegółach inwestycji
					</a>
					</th>
				<td>
					<input type="text" name="phone_contact_imagemapping"  
					value="<?php echo get_option('phone_contact_imagemapping'); ?>" class="form-control"/>
				</td>
				
			</tr>

			<tr>
				<th>
				 
					<a>Podaj ID kategorii wpisów które uwzględniane będą w liście aktualnych realizacji
					</a>
					</th>
				<td>
					<input type="text" name="mjimagemapper_category_city"  
					value="<?php echo get_option('mjimagemapper_category_city'); ?>" class="form-control"/>
				</td>
				
			</tr>
			
			<hr/>

			<tr class="admin_mjimagemapper_smtp" style="border-top:1px solid #000;">
				<th style="display:block;">
				 
					<a>
						Hosta SMTP
					</a>
					</th>
				<td>
					<input type="text" name="mjimagemapper_smtp_host"  
					value="<?php echo get_option('mjimagemapper_smtp_host'); ?>" class="form-control"/>
				</td>
				
			</tr>
			<tr>
			<th>
				 
				 <a>
					 Uzytkownik SMTP
				 </a>
				 </th>
			 <td>
				 <input type="text" name="mjimagemapper_smtp_user"  
				 value="<?php echo get_option('mjimagemapper_smtp_user'); ?>" class="form-control"/>
			 </td>
			 
			</tr>
<tr>
			<th>
				 
					<a>
						Hasło SMTP
					</a>
					</th>
				<td>
					<input type="password" name="mjimagemapper_smtp_password"  
					value="<?php echo get_option('mjimagemapper_smtp_password'); ?>" class="form-control"/>
				</td>
</tr>
<tr>
				<th>
				 
				 <a>
					 Port SMTP
				 </a>
				 </th>
			 <td>
				 <input type="text" name="mjimagemapper_smtp_port"  
				 value="<?php echo get_option('mjimagemapper_smtp_port'); ?>" class="form-control"/>
			 </td>
			 </tr>
		</table>
		
		<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function imgmap_save_settings() {
	update_option('imgmap-alternative-link-positions', $_POST['imgmap-settings-fallback-link-position']);
	update_option('imgmap-pulse', $_POST['imgmap-settings-pulse']);

	update_option('id_acf_imagemapping', $_POST['id_acf_imagemapping']);
	update_option('id_acf_imagemapping_transaction', $_POST['id_acf_imagemapping_transaction']);
	
	update_option('phone_contact_imagemapping', $_POST['phone_contact_imagemapping']);

	update_option('imgmap-alt-dialog', $_POST['imgmap-settings-alt-dialog'] == 'yes');

	update_option('mjimagemapper_smtp_host', $_POST['mjimagemapper_smtp_host']);
	update_option('mjimagemapper_smtp_user', $_POST['mjimagemapper_smtp_user']);
	update_option('mjimagemapper_smtp_password', $_POST['mjimagemapper_smtp_password']);
	update_option('mjimagemapper_smtp_port', $_POST['mjimagemapper_smtp_port']);

	update_option('mjimagemapper_category_city', $_POST['mjimagemapper_category_city']);
	

	/*
	update_option('imgmap-include-jquery', $_POST['imgmap-settings-include-jquery']);
	update_option('imgmap-include-jquery-ui', $_POST['imgmap-settings-include-jquery-ui']);
	update_option('imgmap-include-jquery-ui-dialog', $_POST['imgmap-settings-include-jquery-ui-dialog']);
	*/
	wp_redirect($_POST['_wp_http_referer']);
}

function imgmap_get_imgmap_area_vars($id) {
	$meta = get_post_meta($id, 'imgmap_area_vars', true);
	
	// In 0.5 and earlier versions imgmap_area_vars were saved as JSON string.
	// It was changed because there was a problem with scandinavian letters and JSON encoding
	if(is_string($meta)) 
		$meta = json_decode($meta);
	
	// Disables Creating object from empty value warnings.
	if(empty($meta)) 
		$meta = new StdClass();
	
	return $meta;
}

function imgmap_area_form_types($post) { 
	// Get area variables from post meta 
	$meta = imgmap_get_imgmap_area_vars($post->ID);
	$meta->type = isset($meta->type) ? $meta->type : 'popup';
	$meta->tooltip_text = isset($meta->tooltip_text) ? $meta->tooltip_text : '';
	$meta->link_url = isset($meta->link_url) ? $meta->link_url : '';
	$meta->link_type = isset($meta->link_type) ? $meta->link_type : 'absolute';
	$meta->link_page = isset($meta->link_page) ? $meta->link_page : -1;
	?>
	<div style="width: 20%; float: left;" id="area-form-types">
		<p><input type="radio" name="area-type" onclick="ShowTypes('link')" value="link" <?php echo $meta->type == 'link' ? 'checked' : '' ?>> 
			<input type="button" class="button" onclick="ShowTypes('link')" value="Link" /></p>
		<p><input type="radio" name="area-type" onclick="ShowTypes('tooltip')" value="tooltip" <?php echo $meta->type == 'tooltip' ? 'checked' : '' ?>> 
			<input type="button" class="button" onclick="ShowTypes('tooltip')" value="Etykieta" /></p>
		<p><input type="radio" name="area-type" onclick="ShowTypes('popup')" value="popup" <?php echo $meta->type == 'popup' ? 'checked' : '' ?>> 
			<input type="button" class="button" onclick="ShowTypes('popup')" value="Okienko Popup" /></p>
	</div>
	<div id="imagemap-area-type-editors">
		<div id="imagemap-area-popup-editor" class="area-type-editors <?php echo $meta->type == 'popup' ? 'area-type-editor-current' : '' ?>">
		<h4>Pokaż tekst i obrazy w wyskakującym oknie, gdy użytkownik kliknie obszar</h4>
		<?php 
		if(function_exists('wp_editor')) {
			wp_editor($post->post_content, 'content', array( 'editor_css' => '<style> body { min-height: 300px; background-color: white; } </style>' )); 
		}
		else if(function_exists('the_editor')) {
			the_editor($post->post_content, 'content', array( 'textarea_rows' => 8 ));
		}
		else {
			echo 'Something went wrong when loading editor.';
		}
		?></div>
		<div id="imagemap-area-tooltip-editor" class="area-type-editors <?php echo $meta->type == 'tooltip' ? 'area-type-editor-current' : '' ?>">
		<h4>Pokaż niewielką podpowiedź, gdy użytkownicy przesuną kursor myszy na obszar</h4>
			<p><label>Treść podpowiedzi <br />
				<textarea name="area-tooltip-text" cols="50" rows="6"><?php echo $meta->tooltip_text; ?></textarea>
			</label></p>
			<p>Elementy HTML tj jak linki i zdjęcia są dozwolone. Kod JavaScript zabroniony.</p>
		</div>
		<div id="imagemap-area-link-editor" class="area-type-editors <?php echo $meta->type == 'link' ? 'area-type-editor-current' : '' ?>">
		Wybierz, gdzie użytkownicy mają być przekierowywani po kliknięciu obszaru</h4>
			<table>
				<tr>
			<td><label><input type="radio" name="area-link-type" value="post" <?php echo $meta->link_type == 'post' ? 'checked' : ''; ?>> Link do istniejącego wpisu:</label></td>
			<td>
				<select name="area-link-post"><?php 
				//$posts = get_posts(array('numberposts' => -1));
                                $posts = get_posts('post_type='.IMAGEMAP_POST_TYPE.'&numberposts=-1');
                                
				foreach($posts as $post) { echo '<option value="'.$post->ID.'" '.($meta->link_post == $post->ID ? 'selected' : '').'>'.(strlen($post->post_title) ? $post->post_title : '(untitled, id: '.$post->ID.')').'</option>'; }
				?></select>
			</td>
			<tr><td><label><input type="radio" name="area-link-type" value="page" <?php echo $meta->link_type == 'page' ? 'checked' : ''; ?>> Link do istniejącego wpisu:</label></td><td><?php wp_dropdown_pages(array('name' => 'area-link-page', 'selected' => $meta->link_page)); ?></td></tr>
			<tr><td><label><input type="radio" name="area-link-type" value="absolute" <?php echo $meta->link_type == 'absolute' ? 'checked' : ''; ?>> Link do adresu URL:</label></td><td><input type="text" name="area-link-url" value="<?php echo $meta->link_url; ?>"></td></tr>
			</tr>
			</table>
		</div>
	</div>
	<br style="clear:both">
<?php }

/* Used when user adds a new area to the image map 
 * The function returns object with data of the newly-added area and link to edit it. 
 * Currently Wordpress should be redirecting user to the area edit form after the area has been saved. 
 * However there's a bug with the redirecting and it's redirecting in wrong page. Might be that Wordpress doesn't allow the redirect. */
function imgmap_save_area_ajax() {
	global $wpdb;
	$area = new StdClass();
	$area->coords = $_POST['coords'];
	$area->text = '';
	$area->title = '(untitled image map area)'; 
	$area->title_attribute = '';
	$area->parent = $_POST['parent_post'];
	$post = array(
	'post_author'    => get_current_user_id(),
	'post_content'   => $area->text,
	'post_parent'    => $area->parent,
	'post_status'    => 'publish',
	'post_name' 	 => $area->title,
	'post_title'     => $area->title,
	'post_type'      => IMAGEMAP_AREA_POST_TYPE
	);
	$post = wp_insert_post($post);
	
	$area->id = $post;
	$area->link = get_edit_post_link($area->id);
	update_post_meta($area->id, 'coords', $area->coords);
	$meta = new StdClass();
	
	$meta->color = $styles['last_chosen'];
	update_post_meta($area->id, 'imgmap_area_vars', json_encode($meta));
	$area->html = imgmap_create_list_element($area->id, true);
	ob_clean();
	echo json_encode($area);
	die();
}

/* Shortlink for deleting an area. (Well, the functionality which happens when the shortlink is pressed. */
function imgmap_delete_area_ajax() {
	echo json_encode(wp_delete_post($_POST['post'], true));
	die();
}

/* Creates an area element to the HTML image map */
function imgmap_create_area_element($id, $title) {	
	$imgmap_colors = get_option('imgmap_colors');
	$meta = imgmap_get_imgmap_area_vars($id);
	
	if($meta === null)
		$meta = new StdClass();
	
	if(!isset($meta->color) || !isset($imgmap_colors['colors'][$meta->color]))
		$meta->color = $imgmap_colors['last_chosen'];
		
	if(!isset($imgmap_colors['colors'][$meta->color])) 
		$color = array( 'fillColor' => 'fefefe', 'strokeColor' => 'fefefe', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.6, 'strokeWidth' => 1);
	else
		$color = $imgmap_colors['colors'][$meta->color];
	
	$meta->type = isset($meta->type) ? $meta->type : '';
	$meta->tooltip_text = isset($meta->tooltip_text) ? $meta->tooltip_text : '';
	$link = imgmap_get_link_url($meta);
	
	$meta->title_attribute = isset($meta->title_attribute) ? $meta->title_attribute : '';
	
	if(get_field("typ", $id) == "Mieszkanie") {
		$title_area = get_field("numerlokalu", $id).' - '.get_field("status", $id);
	} else {
		$title_area = $meta->title_attribute;//get_field("numerlokalu", $id).' - '.get_field("status", $id);
	}
	return '<area title="'.$title_area.'" data-type="'.esc_attr($meta->type).'" data-tooltip="'.esc_attr($meta->type == 'tooltip' ? $meta->tooltip_text : false ). '" data-fill-color="'.esc_attr(str_replace('#', '', $color['fillColor'])).'" data-fill-opacity="'.esc_attr($color['fillOpacity']).'" data-stroke-color="'.esc_attr(str_replace('#', '', $color['strokeColor'])).'" data-stroke-opacity="'.esc_attr($color['strokeOpacity']).'" data-stroke-width="'.esc_attr($color['strokeWidth']).'" data-title="'.$title.'" data-mapkey="area-'.$id.'" data-object="'.get_field("typ", $id).'" shape="poly" coords="'.esc_attr(get_post_meta($id, 'coords', true)).'" href="'.esc_attr($link) .'" title="'.(isset($meta->title_attribute) ? $meta->title_attribute : $title).'" />';
}

/* Creates an list element to the list of imagemap's areas. */
function imgmap_create_list_element($id, $animated = false) {
	return 
	'<li data-listkey="area-'.$id.'" class="area-list-element '.($animated ? 'area-list-element-animated' : '').'">
	<div class="area-list-left">
		<input id="area-checkbox-'.$id.'" data-listkey="area-'.$id.'" type="checkbox" checked>
	</div>
	<div class="area-list-right">
		<label>Title: <input type="text" id="'.$id.'-list-area-title" value="'.get_the_title($id).'" /><div style="clear: both"></div></label>
		<div class="area-list-meta">
			<a class="save-area-link" href="#" onclick="SaveTitle('.$id.')">Save</a>
			<a class="edit-area-link" href="'.get_edit_post_link($id).'">Edit page</a>
			<a class="delete-area" data-area="'.$id.'">Delete</a>
		</div>
	</div>
	</li>';
}

function imgmap_get_link_url($meta) {
	if($meta->type != 'link')
		return '#'; 
		
	switch($meta->link_type) {
		case 'post': return "#highlightarea".$meta->link_post;//get_permalink($meta->link_post);
		case 'page': return get_permalink($meta->link_page);
		default: return isset($meta->link_url) ? $meta->link_url : '';
	}
}

/* Template for the imagemap frontend page. 
 * Checks first the theme folder. 
 * Note: If you want to edit the image map template, please check the single_imgmap.php template file in plugin's directory. */
function imgmap_template($template) {
	$post = get_the_ID();
	if(get_post_type() == IMAGEMAP_POST_TYPE) {
		if(locate_template(array('single-imgmap.php')) != '') 
			include locate_template(array('single-imgmap.php'));
		else
			include 'single-imgmap.php';
		return;
	}
	return $template;
}

/* Loads post in a jQuery dialog when a highlighted area is clicked. 
 * Checks first the theme folder, too */
function imgmap_load_dialog_post_ajax() {
	$post = get_post($_POST['id']);
	if(locate_template(array('single-imgmap-dialog.php')) != '') 
		include locate_template(array('single-imgmap-dialog.php'));
	else
		include 'single-imgmap-dialog.php';
	die();
}

/* Returns array of area data of an imagemap. */
function imgmap_get_area_coordinates_ajax() {
	$return = array();
	$areas = get_posts('post_parent='.$_POST['post'].'&post_type='.IMAGEMAP_AREA_POST_TYPE.'&orderby=id&order=desc&numberposts=-1');
	$imgmap_colors = get_option('imgmap_colors');
	foreach($areas as $a) {
		$newArea = new StdClass();
		$newArea->coords = get_post_meta($a->ID, 'coords', true);
		$vars = imgmap_get_imgmap_area_vars($a->ID);
		$newArea->style = isset($imgmap_colors['colors'][$vars->color]) ? $imgmap_colors['colors'][$vars->color] : array( 'fillColor' => 'fefefe', 'strokeColor' => 'fefefe', 'fillOpacity' => 0.3, 'strokeOpacity' => 0.6, 'strokeWidth' => 1);;
		$newArea->id = $a->ID;
		$return[] = $newArea;
	}
	echo json_encode($return);
	die();
}

/* Be sure to delete areas when deleting parent post */
function imgmap_permanently_delete_imagemap($post_id) {
	imgmap_delete_imagemap($post_id, true);
}

/* ...and be sure to trash areas when trashing parent post as well. */
function imgmap_trash_imagemap($post_id) {
	imgmap_delete_imagemap($post_id, false);
}

/* Delete areas when deleting imagemap. 
 * Doesn't actually restore trashed imagemap areas when restoring the imagemap. */
function imgmap_delete_imagemap($post_id, $permanent) {
	
	$args = array( 
    'post_parent' => $post_id,
    'post_type' => IMAGEMAP_POST_TYPE
	);
	
	$posts = get_posts( $args );
	
	if (is_array($posts) && count($posts) > 0) {
		// Delete all the Children of the Parent Page
		foreach($posts as $post){
			wp_delete_post($post->ID, $permanent);
		}
	}
}

/* Insert image map code in posts */
/* removed by Samatva - the *wrong* way to do shortcodes - breaks with "curly" quotation marks
function imgmap_replace_shortcode($content) {
	global $imagemaps;
	preg_match_all('/\[imagemap id=\"(.*?)\"\]/', $content, $maps);
	foreach($maps[1] as $map) {
		if(!isset($imagemaps[$map]))
			$imagemaps[$map] = 0;
		$imagemaps[$map]++;
			
		$content = preg_replace('/\[imagemap id=\"'.$map.'\"\]/', get_imgmap_frontend_image($map, $map.'-'.$imagemaps[$map]), $content, 1);
	}
	return $content;
}
*/
function imgmap_save_area_title() {
	if(current_user_can('manage_options')) {
		$id = $_POST['id'];
		$post = get_post($id);
		$post->post_title = $_POST['title'];
		echo wp_update_post($post);
	}
	die();
}

function imgmap_set_area_color() {
	if(current_user_can('manage_options')) {
		$id = $_POST['post'];
		$color = $_POST['color'];
		$meta = imgmap_get_imgmap_area_vars($id);
		echo json_encode($meta);
		$meta->color = $color;
		update_post_meta($id, 'imgmap_area_vars', json_encode($meta));
	}
	die();
}

function imgmap_add_new_style() {
	if(current_user_can('manage_options')) {
		if(substr($_POST['fillColor'], 0, 1) == '#')
			$_POST['fillColor'] = substr($_POST['fillColor'], 1);

		$style = array(
			'fillColor' => $_POST['fillColor'],
			'fillOpacity' => $_POST['fillOpacity'],
			'strokeColor' => $_POST['strokeColor'],
			'strokeOpacity' => $_POST['strokeOpacity'],
			'strokeWidth' => $_POST['strokeWidth']
		);
		$style_option = get_option('imgmap_colors');
		$key = $style_option['current_id'] + 1;
		$style_option['colors'][$key] = $style;
		$style_option['current_id']++;
		
		update_option('imgmap_colors', $style_option);
		echo imgmap_get_style_element($key, $style, true, true);
	}
	die();
}

function imgmap_edit_style() {
	if(current_user_can('manage_options')) {
		$style = array(
			'fillColor' => $_POST['fillColor'],
			'fillOpacity' => $_POST['fillOpacity'],
			'strokeColor' => $_POST['strokeColor'],
			'strokeOpacity' => $_POST['strokeOpacity'],
			'strokeWidth' => $_POST['strokeWidth']
		);
		$id = $_POST['id'];
		$style_option = get_option('imgmap_colors');
		$style_option['colors'][$id] = $style;
		
		update_option('imgmap_colors', $style_option);
		echo imgmap_get_style_element($id, $style, true, true);
	}
	die();
}

function imgmap_delete_style() {
	if(current_user_can('manage_options')) {
		$style_option = get_option('imgmap_colors');
		$id = $_POST['id'];
		unset($style_option['colors'][$id]);
		update_option('imgmap_colors', $style_option);
	}
	die();
}

function imgmap_hex_to_rgba($hex, $opacity = false) {
	
	if(substr($hex, 0, 1) == '#')
		$hex = substr($hex, 1);
		
	$red = substr($hex, 0, 2);
	$green = substr($hex, 2, 2);
	$blue = substr($hex, 4, 2);
	
	$red = hexdec($red);
	$green = hexdec($green);
	$blue = hexdec($blue);
	
	if(is_numeric($opacity))
		return 'rgba('.$red.', '.$green.', '.$blue.', '.$opacity.')';
	else
		return 'rgb('.$red.', '.$green.', '.$blue.')';
}

function get_post_by_title($page_title, $output = OBJECT) {
    global $wpdb;
        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='post'", $page_title ));
        if ( $post )
            return get_post($post, $output);

    return null;
}

?>
