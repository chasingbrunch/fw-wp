<?php

add_action( 'init', 'cb_events');
add_action( 'init', 'cb_lessons');
add_action( 'init', 'cb_pressrelease');

function cb_events() { 

	register_post_type( 'events',

		array('labels' => array(
			'name' => __('Events', 'jointswp'),
			'singular_name' => __('Event', 'jointswp'),
			'all_items' => __('All Events', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'), 
			'add_new_item' => __('Add New Event', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Event', 'jointswp'), 
			'new_item' => __('New Event', 'jointswp'),
			'view_item' => __('View Event', 'jointswp'),
			'search_items' => __('Search Events', 'jointswp'), 
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),  
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
			),
			'description' => __( 'Events', 'jointswp' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-tickets-alt',
			'rewrite'	=> array( 'slug' => 'event/%season%', 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'revisions')
	 	) 
	); 
	
	
	register_taxonomy_for_object_type('category', 'season');
	register_taxonomy_for_object_type('category', 'artist');
	register_taxonomy_for_object_type('category', 'series');
	register_taxonomy_for_object_type('post_tag', 'genre');
	register_taxonomy_for_object_type('category', 'stage');
	
}

function cb_lessons() { 

	register_post_type( 'lessons',

		array('labels' => array(
			'name' => __('Lessons', 'jointswp'),
			'singular_name' => __('Lesson', 'jointswp'),
			'all_items' => __('All Lessons', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'), 
			'add_new_item' => __('Add New Lesson', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Lesson', 'jointswp'), 
			'new_item' => __('New Lesson', 'jointswp'),
			'view_item' => __('View Lesson', 'jointswp'),
			'search_items' => __('Search Lessons', 'jointswp'), 
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),  
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
			),
			'description' => __( 'Lessons', 'jointswp' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-embed-photo',
			'rewrite'	=> array( 'slug' => 'resource/%type%', 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'revisions')
	 	) 
	); 
	
	
	register_taxonomy_for_object_type('category', 'subject');
	register_taxonomy_for_object_type('category', 'type');
	register_taxonomy_for_object_type('category', 'grade');
	register_taxonomy_for_object_type('category', 'tags');
	
}

function cb_pressrelease() { 

	register_post_type( 'press-release',

		array('labels' => array(
			'name' => __('Press Release', 'jointswp'),
			'singular_name' => __('Press Release', 'jointswp'),
			'all_items' => __('All Press Releases', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'), 
			'add_new_item' => __('Add New Press Release', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Press Release', 'jointswp'), 
			'new_item' => __('New Press Release', 'jointswp'),
			'view_item' => __('View Press Release', 'jointswp'),
			'search_items' => __('Search Press Releases', 'jointswp'), 
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),  
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
			),
			'description' => __( 'Press Releases', 'jointswp' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-format-aside',
			'rewrite'	=> array( 'slug' => 'press-releases', 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'revisions')
	 	) 
	); 	
	
	register_taxonomy_for_object_type('category', 'release');
	
}
	
register_taxonomy( 'artist', 
  	array('events'),
  	array('hierarchical' => true,          
  		'labels' => array(
  			'name' => __( 'Artist', 'jointswp' ),
  			'singular_name' => __( 'Artist', 'jointswp' ),
   			'search_items' =>  __( 'Search Artists', 'jointswp' ),
   			'all_items' => __( 'All Artists', 'jointswp' ),
   			'parent_item' => __( 'Parent Artist', 'jointswp' ),
   			'parent_item_colon' => __( 'Parent Artist:', 'jointswp' ),
   			'edit_item' => __( 'Edit Artist', 'jointswp' ),
   			'update_item' => __( 'Update Artist', 'jointswp' ),
   			'add_new_item' => __( 'Add New Artist', 'jointswp' ),
   			'new_item_name' => __( 'New Artist', 'jointswp' )
   		),
   		'public' => false,
   		'show_admin_column' => true, 
   		'show_ui' => true,
   		'query_var' => true,
   		//'rewrite' => array( 'slug' => 'artists' ),
   	)
); 
    
register_taxonomy( 'series', 
  	array('events'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Series', 'jointswp' ),
   		'singular_name' => __( 'Series', 'jointswp' ),
   		'search_items' =>  __( 'Search Series', 'jointswp' ),
   		'all_items' => __( 'All Series', 'jointswp' ),
   		'parent_item' => __( 'Parent Series', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Series:', 'jointswp' ),
   		'edit_item' => __( 'Edit Series', 'jointswp' ),
   		'update_item' => __( 'Update Series', 'jointswp' ),
   		'add_new_item' => __( 'Add New Series', 'jointswp' ),
   		'new_item_name' => __( 'New Series', 'jointswp' )
   	),
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   	'rewrite' => array( 'slug' => 'series' ),
   )
);  

register_taxonomy( 'stage', 
  	array('events'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Stage', 'jointswp' ),
   		'singular_name' => __( 'Stage', 'jointswp' ),
   		'search_items' =>  __( 'Search Stage', 'jointswp' ),
   		'all_items' => __( 'All Stages', 'jointswp' ),
   		'parent_item' => __( 'Parent Stage', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Stage:', 'jointswp' ),
   		'edit_item' => __( 'Edit Stage', 'jointswp' ),
   		'update_item' => __( 'Update Stage', 'jointswp' ),
   		'add_new_item' => __( 'Add New Stage', 'jointswp' ),
   		'new_item_name' => __( 'New Stage', 'jointswp' )
   	),
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   	'rewrite' => array( 'slug' => 'stage' ),
   )
);   
    
register_taxonomy( 'genre', 
  	array('events'),
   	array('hierarchical' => true,              
   		'labels' => array(
   			'name' => __( 'Genre', 'jointswp' ),
   			'singular_name' => __( 'Genre', 'jointswp' ),
   			'search_items' =>  __( 'Search Genres', 'jointswp' ),
   			'all_items' => __( 'All Genres', 'jointswp' ),
   			'parent_item' => __( 'Parent Genre', 'jointswp' ),
   			'parent_item_colon' => __( 'Parent Genre:', 'jointswp' ), 
   			'edit_item' => __( 'Edit Genre', 'jointswp' ), 
   			'update_item' => __( 'Update Genre', 'jointswp' ), 
   			'add_new_item' => __( 'Add New Genre', 'jointswp' ), 
   			'new_item_name' => __( 'New Genre', 'jointswp' ) 
   		),
   		'public' => false,
   		'show_admin_column' => true,
   		'show_ui' => true,
   		'query_var' => true,
	)
); 

register_taxonomy( 'subject', 
  	array('lessons'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Subject', 'jointswp' ),
   		'singular_name' => __( 'Subject', 'jointswp' ),
   		'search_items' =>  __( 'Search Subject', 'jointswp' ),
   		'all_items' => __( 'All Subjects', 'jointswp' ),
   		'parent_item' => __( 'Parent Subjects', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Subjects:', 'jointswp' ),
   		'edit_item' => __( 'Edit Subject', 'jointswp' ),
   		'update_item' => __( 'Update Subject', 'jointswp' ),
   		'add_new_item' => __( 'Add New Subject', 'jointswp' ),
   		'new_item_name' => __( 'New Subject', 'jointswp' )
   	),
   	'public' => false,
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   //'rewrite' => array( 'slug' => 'series' ),
   )
);

register_taxonomy( 'type', 
  	array('lessons'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Type', 'jointswp' ),
   		'singular_name' => __( 'Type', 'jointswp' ),
   		'search_items' =>  __( 'Search Type', 'jointswp' ),
   		'all_items' => __( 'All Type', 'jointswp' ),
   		'parent_item' => __( 'Parent Type', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Type:', 'jointswp' ),
   		'edit_item' => __( 'Edit Type', 'jointswp' ),
   		'update_item' => __( 'Update Type', 'jointswp' ),
   		'add_new_item' => __( 'Add New Type', 'jointswp' ),
   		'new_item_name' => __( 'New Type', 'jointswp' )
   	),
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   	'rewrite' => array( 'slug' => 'type' ),
   )
);  

register_taxonomy( 'grade', 
  	array('lessons'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Grade', 'jointswp' ),
   		'singular_name' => __( 'Grade', 'jointswp' ),
   		'search_items' =>  __( 'Search Grade', 'jointswp' ),
   		'all_items' => __( 'All Grades', 'jointswp' ),
   		'parent_item' => __( 'Parent Grades', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Grades:', 'jointswp' ),
   		'edit_item' => __( 'Edit Grade', 'jointswp' ),
   		'update_item' => __( 'Update Grade', 'jointswp' ),
   		'add_new_item' => __( 'Add New Grade', 'jointswp' ),
   		'new_item_name' => __( 'New Grade', 'jointswp' )
   	),
   	'public' => false,
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   //'rewrite' => array( 'slug' => 'series' ),
   )
);


register_taxonomy( 'tags', 
  	array('lessons'),
   	array('hierarchical' => false,              
   		'labels' => array(
   			'name' => __( 'Tag', 'jointswp' ),
   			'singular_name' => __( 'Tag', 'jointswp' ),
   			'search_items' =>  __( 'Search Tags', 'jointswp' ),
   			'all_items' => __( 'All Tags', 'jointswp' ),
   			'parent_item' => __( 'Parent Tag', 'jointswp' ),
   			'parent_item_colon' => __( 'Parent Tag:', 'jointswp' ), 
   			'edit_item' => __( 'Edit Tag', 'jointswp' ), 
   			'update_item' => __( 'Update Tag', 'jointswp' ), 
   			'add_new_item' => __( 'Add New Tag', 'jointswp' ), 
   			'new_item_name' => __( 'New Tag', 'jointswp' ) 
   		),
   		'public' => false,
   		'show_admin_column' => true,
   		'show_ui' => true,
   		'query_var' => true,
	)
); 

register_taxonomy( 'release', 
  	array('press-release'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Season', 'jointswp' ),
   		'singular_name' => __( 'Season', 'jointswp' ),
   		'search_items' =>  __( 'Search Season', 'jointswp' ),
   		'all_items' => __( 'All Season', 'jointswp' ),
   		'parent_item' => __( 'Parent Season', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Season:', 'jointswp' ),
   		'edit_item' => __( 'Edit Season', 'jointswp' ),
   		'update_item' => __( 'Update Season', 'jointswp' ),
   		'add_new_item' => __( 'Add New Season', 'jointswp' ),
   		'new_item_name' => __( 'New Season', 'jointswp' )
   	),
   	'public' => false,
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   )
);  

register_taxonomy( 'season', 
  	array('events'),
  	array('hierarchical' => true,          
  		'labels' => array(
  		'name' => __( 'Season', 'jointswp' ),
   		'singular_name' => __( 'Season', 'jointswp' ),
   		'search_items' =>  __( 'Search Season', 'jointswp' ),
   		'all_items' => __( 'All Season', 'jointswp' ),
   		'parent_item' => __( 'Parent Season', 'jointswp' ),
   		'parent_item_colon' => __( 'Parent Season:', 'jointswp' ),
   		'edit_item' => __( 'Edit Season', 'jointswp' ),
   		'update_item' => __( 'Update Season', 'jointswp' ),
   		'add_new_item' => __( 'Add New Season', 'jointswp' ),
   		'new_item_name' => __( 'New Season', 'jointswp' )
   	),
   	'public' => false,
   	'show_admin_column' => true, 
   	'show_ui' => true,
   	'query_var' => true,
   	'rewrite' => array( 'slug' => 'season' ),
   )
);  


add_filter('post_type_link', 'events_permalink_structure', 10, 4);

function events_permalink_structure($post_link, $post, $leavename, $sample) {
	
    if (false !== strpos($post_link, '%season%')) {
	    
        $type_term = get_the_terms($post->ID, 'season');
        
        if (!empty($type_term))
        
            $post_link = str_replace('%season%', array_pop($type_term)->
            
            slug, $post_link);
            
        else
        
            $post_link = str_replace('%season%', 'uncategorized', $post_link);
            
    }
    
    return $post_link;
}

add_filter('post_type_link', 'lessons_permalink_structure', 10, 4);

function lessons_permalink_structure($post_link, $post, $leavename, $sample) {
	
    if (false !== strpos($post_link, '%type%')) {
	    
        $type_term = get_the_terms($post->ID, 'type');
        
        if (!empty($type_term))
        
            $post_link = str_replace('%type%', array_pop($type_term)->
            
            slug, $post_link);
            
        else
        
            $post_link = str_replace('%type%', 'uncategorized', $post_link);
            
    }
    
    return $post_link;
}