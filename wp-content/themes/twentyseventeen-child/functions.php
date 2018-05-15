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
	$all_categories = get_categories(array('parent' => $parent));
	$max_num_pages  = count( $all_categories ) / $cat_per_page; 

	$paginate = array(
	    'paged'  => $paged,
	    'number' => $cat_per_page,
	    'offset' => $paged_offset,  	
	    'parent' => $parent,
	);
	/* récuperation des categories : "marques"*/
	$categories = get_categories( $paginate );

	include( locate_template( 'templats/posts-by-category.php' ) );

}


add_action( 'init' , 'menu_categories');
/*ajouter un menu avec toutes les marques*/
function menu_categories(){

	$parent      = get_cat_ID( "Marques auto" ); 
	$menu_name   = 'Categories';
	$menu_exists = wp_get_nav_menu_object( $menu_name );
	$categories  = get_categories( array( 'parent' => $parent ) );
	// créer le menu
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
			    'menu-item-classes'   => $category->name,
		        'menu-item-url'       => home_url( "index.php/category/marques-auto/$category->slug/" ),
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