<?php
/** appliquer le style de theme parent **/
add_action( 'wp_enqueue_scripts' , 'parent_style' );
	
function parent_style() {

    wp_enqueue_style( 'parent-style' , get_template_directory_uri() . '/style.css' );

}	
	
/** filtrer le titre de la categorie **/
add_filter( 'custom_postsbycategory_title' , 'category_title' );
	
function category_title( $cat ) {

    return $cat;

}	
	
/** afficher les derniers article de chaque categorie **/
add_action( 'home_loading' , 'show_postsbycategory_index' );
	
function show_postsbycategory_index(){

	/*id de la categorie Marques auto*/
	$parent=get_cat_ID("Marques auto"); 
	/*les attributs de pagination*/
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$cat_per_page = 2;
    $paged_offset = ($paged - 1) * $cat_per_page;
	/*le nombre des pages*/
	$all_categories = get_categories( array( 'parent' => $parent ));
	$max_num_pages  = count( $all_categories ) / $cat_per_page; 

	$paginate = array(
	    'paged'  => $paged,
	    'number' => $cat_per_page,
	    'offset' => $paged_offset,  	
	    'parent' => $parent,
	);
	/* récuperation des categories : "marques" */
	$categories = get_categories( $paginate );

	include( locate_template( 'templats/posts-by-category.php' ) );

}	
	
/* ajouter un menu avec toutes les marques */
add_action( 'init' , 'menu_categories');
	
function menu_categories(){

	$parent      = get_cat_ID( "Marques auto" ); 
	$menu_name   = 'Categories';
	$menu_exists = wp_get_nav_menu_object( $menu_name );
	$categories  = get_categories( array( 'parent' => $parent ) );
	// créer le menu si il n'exist pas
	if( !$menu_exists){
	    $menu_id = wp_create_nav_menu( $menu_name );
	    $i=$j=0;
	    foreach ( $categories as $category ) {
	    	if( $i%8 == 0 ){
			    $parent_item = wp_update_nav_menu_item($menu_id, 0, array(
				    'menu-item-title'  =>  __('Groupe'.($j+1)),
				    'menu-item-url'    => home_url( '#' ), 
				    'menu-item-status' => 'publish', 
				    )
				);
				$j++;
			}
			wp_update_nav_menu_item( $menu_id , 0 , array(
			   'menu-item-title'     =>  __($category->name),
		       'menu-item-url'       => get_category_link($category->cat_ID),
			   'menu-item-status'    => 'publish', 
			   'menu-item-parent-id' => $parent_item)
			);
			$i++;
		}
		//set menu location => "Top Menu"
		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['top'] = $menu_id;
		set_theme_mod( 'nav_menu_locations' , $locations );
	}

}

/* créer et chager le widget */

include ( get_stylesheet_directory().'/widgets/mostpopular-widget.php' );

add_action( 'widgets_init' , 'create_widget' );

function create_widget() {

    register_widget( 'Most_Popular_Widget' );

}

/* créer le shortcode */

add_shortcode( 'popular-cars' , 'popular_car_shortcode' );

function popular_car_shortcode( $brands ) {

	//parameter du shortcode
	$parent     = get_cat_ID( $brands['name'] );
	//les categories filles de la marque passé en paramèter
	$categories = get_categories( array( 'parent' => $parent ) );
	//préparation de contenu du shorcode
	$content    = "<h5>".$brands['name']." :</h5>";
	$content   .= "<ul class='most-popular'>";

	foreach ( $categories as $category ) {

		$content .= "<li>
						<a href='".get_category_link($category->cat_ID)."'>$category->name
						</a>
					</li>";
	}

	$content   .= "</ul>";

    return $content;

}

/*
function posts_by_category( $query ) {

    if ( $query->is_main_query() ) {
        $args = array();
    	$query = new WP_Query( $args );
    }

}
add_action( 'pre_get_posts', 'posts_by_category' );
*/