<?php
	
add_action( 'wp_ajax_cb_get_resources', 'cb_get_resources' );
add_action( 'wp_ajax_nopriv_cb_get_resources', 'cb_get_resources' );
add_action( 'wp_enqueue_scripts', 'cb_enqueue' );
add_filter( 'body_class', 'sorting_body_class' );
	
function cb_enqueue() {
	
	wp_enqueue_script( 'resource_archive', get_template_directory_uri() . '/assets/scripts/sorting-resources.js', array('jquery'), NULL );
	
	wp_localize_script( 'resource_archive', 'cb_get_resources', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ), NULL );
	
};


function cb_get_resources() {
	
	global $wp_query;
	
	$subject = $_POST['subject'];
	$type = $_POST['type'];
	$grade = $_POST['grade'];
	$sort_by = $_POST['sort_by'];
	$relation = $_POST['relation'];
	$current_page = $_POST['current_page'];
	$audience = $_POST['audience'];
	
	if( $sort_by == 'most-recent' ) {
	
		$order = 'DESC';
		$orderby = 'date';	
		
	}
	
	elseif( $sort_by == 'title-a-z' ) {
		
		$order = 'ASC';
		$orderby = 'title';	
		
	}
	
	elseif( $sort_by == 'artist-a-z' ) {
		
		$order = 'ASC';
		$orderby = 'title';	
		
	}
	
	if( $subject ) {
		
		$subject = explode(",", $subject);
	
	}
	
	if( $_POST['subject'] || $_POST['type'] || $_POST['grade'] ) {
			
		$tax_query = array(
				    
			'relation' => 'OR',
		        	
		   	array(
		        'taxonomy' => 'subject',
				'field'    => 'slug',
				'terms'    => $subject,
			),
					
			array(
		        'taxonomy' => 'type',
				'field'    => 'slug',
				'terms'    => $type,
			),
				
			array(
		        'taxonomy' => 'grade',
				'field'    => 'slug',
				'terms'    => $grade,
	
			),
										
		);
				   
		$args = array(
				
			'post_type' => 'lessons',
			    
			'tax_query' => $tax_query,
				
			'posts_per_page' => 6,
				
			'order' => $order,
				
			'orderby' => $orderby,
			
			'paged' => $current_page,
		);
	
	}
		
	else {
		
		$args = array(
			
			'post_type' => 'lessons',
			
			'posts_per_page' => 6,
			
			'order' => $order,
			
			'orderby' => $orderby,
			
			'paged' => $current_page,
		
		);
	}
  
	$query = new WP_Query( $args );
			
	while ( $query->have_posts() ) : $query->the_post();
	
		$i++;
		
		echo '<div class="small-12 cell">'; ?>
		
			<a class="grid-x resource-result" href="<?php the_permalink(); ?><?php if( $audience != 'all' ): ?>?audience=<?php echo $audience; ?><?php endif; ?>">
				
				<div class="small-12 medium-4 cell feature-frame">
					
					<?php $image = get_field('featured_image'); ?>
					
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					
				</div>
				
				<div class="small-12 medium-8 cell result-info">
					
					<h3><?php the_title(); ?></h3>
					
					<?php $artist = get_field( 'artist' ); $artist = get_term( $artist, 'artist' ); ?>
					
					<h4><?php echo $artist->name; ?></h4>	
					
					<?php the_field('excerpt'); ?>
					
					<?php $id = get_the_id();
						
					$tags = get_the_terms( $id, 'tags' ); ?>
					
					<?php foreach( $tags as $tag ): ?>
					
						<h6><?php echo $tag->name; ?></h6>
						
					<?php endforeach; ?>
					
				</div>
				
			</a>
								
		<? echo '</div>';
		
	endwhile;
	
	$max_pages = $query->max_num_pages;		
	
	
	if( $max_pages > 1 ) {
		
		echo '<div class="small-12 cell cb-pagination">';
		
		if( $current_page > 1 ) {
			
			$prev = intval( $current_page ) - 1;
			
			echo '<button class="cb-prev" data-page="' . $prev . '"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>
 Previous</button>'; 
			
		}	
		
		for ($page = 0 ; $page < $max_pages; $page++){
			
			$page_num = intval( $page ) + 1;
			
			if( $page_num == $current_page ) {
				
				$active = 'active ';
				
			}
			
			else {
				
				$active = '';
				
			}
				
			echo '<button data-value="' . $page_num . '" class="' . $active . 'page-button">' . $page_num . '</button>'; 
			
		}
				
		if( $current_page != $max_pages ) {
			
			$next = intval( $current_page ) + 1;
			
			echo '<button class="cb-next" data-page="' . $next . '">Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
</button>';
			
		}
		
		echo '</div>';
			
	}
	
	wp_reset_postdata();
	
	wp_die();
	
};

function sorting_body_class( $classes ) {
	
    if ( is_page_template( 'template-lessonsarchive.php' )) {
	    
	    $classes[] = 'resource-archive';
	    
    }
    	
    return $classes;
}