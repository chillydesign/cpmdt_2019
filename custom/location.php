<?php
		// register a custom post type called 'location'
		function post_type_location() {
		    $labels = array(
		        'name' => __( 'Centres' ),
		        'singular_name' => __( 'Centre' ),
		        'add_new' => __( 'Ajouter' ),
		        'add_new_item' => __( 'Ajouter' ),
		        'edit_item' => __( 'Modifier Location' ),
		        'new_item' => __( 'Nouveau Location' ),
		        'view_item' => __( 'Voir Location' ),
		        'search_items' => __( 'Rechercher Centre' ),
		        'not_found' =>  __( 'Aucun résultat' ),
		        'not_found_in_trash' => __( 'Aucun résultat' ),);
		    $args = array(
		        'labels' => $labels,
		        'public' => true,
		        'publicly_queryable' => true,
		        'supports' => array(
	                'title',
	                'thumbnail',
	                'editor',
	            ),
	            'orderby' => 'post_title',
	            'order' => 'ASC',
		        'show_ui' => true,
		        'query_var' => true,
		        'rewrite' => true,
		        'capability_type' => 'post',
		        'hierarchical' => false,
		        'menu_position' => null,
						'map_meta_cap' => true, 
		        'menu_icon' => 'dashicons-location',
		        'supports' => array('title', 'page-attributes'));

		    register_post_type( 'location', $args );
		}
		add_action( 'init', 'post_type_location' );




		// Creating the custom box
		add_action("admin_init", "location_admin_init");
		function location_admin_init(){
		  add_meta_box("location_meta", "Centres informations", "location_details_meta", "location", "normal", "default");
		}
		// Showing up the box
		function location_details_meta() {
		 	$ret = '<p><label for="lat">Latitude: </label><br/><input style="width:50%;" type="text" size="70" placeholder="" id="lat" name="lat" value="' . get_custom_field("lat") . '" /></p>';
		 	$ret .= '<p><label for="long">Longitude: </label><br/><input style="width:50%;" type="text" size="70" placeholder="" id="long" name="long" value="' . get_custom_field("long") . '" /></p>';
		 	$ret .= '<p><label for="addresse">Addresse: </label><br/><input style="width:50%;" type="text" size="70" placeholder="" id="addresse" name="addresse" value="' . get_custom_field("addresse") . '" /></p>';
		 	$ret .= '<p><label for="infos">Infos TPG: </label><br/><input style="width:50%;" type="text" size="70" placeholder="" id="infos" name="infos" value="' . get_custom_field("infos") . '" /></p>';
		 	$ret .= '<p><label for="description">Description: </label><br/><textarea style="resize: auto;width:50%;" placeholder="" id="description" name="description">' . get_custom_field("description") .'</textarea></p>';
		    $ret .= '<p><label for="responsible">Responsable: <br> <b style="color: #999;font-weight:normal;">Please use <span style="background-color: #eee;padding:3px 5px;">HTML</span></b></label><br/><textarea style="width:50%;" type="text" size="70" placeholder="" id="responsible" name="responsible">' . get_custom_field("responsible") . '</textarea></p>';
		    echo $ret;
		}


		// Saving the details
		add_action('save_post', 'save_location_details');
		function save_location_details(){
		   	global $post;
		 
		   	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		      	return;

		   	if(get_post_type($post) != 'location')
		      	return;
		 
		   	save_custom_field("lat");
		   	save_custom_field("long");
		   	save_custom_field("addresse");
		   	save_custom_field("infos");
		   	save_custom_field("description");
		   	save_custom_field("responsible");
		}
?>