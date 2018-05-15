<?php
/** appliquer le style de theme parent **/
function parent_style() {

    wp_enqueue_style( 'parent-style' , get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'parent_style' );

/** filtrer le titre de la categorie **/
function category_title( $cat ) {

    return $cat;

}
add_filter( 'custom_postsbycategory_title' , 'category_title' );

/** afficher les derniers article de chaque categorie **/
function show_postsbycategory_index(){
	//Id de la categorie Marques auto
	$parent=get_cat_ID("Marques auto"); 
	//les attributs de pagination
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$cat_per_page = 2;
    $paged_offset = ($paged - 1) * $cat_per_page;
	//le nombre des pages
	$all_categories = get_categories(array('parent' => $parent));
	$max_num_pages  = count( $all_categories ) / $cat_per_page; 

	$paginate = array(
	    'paged'  => $paged,
	    'number' => $cat_per_page,
	    'offset' => $paged_offset,  	
	    'parent' => $parent,
	);
	// récuperation des categories : "marques"
	$categories = get_categories( $paginate );
	// parcours des categories
	foreach ( $categories as $categorie ) {
		//appliquer filter sur le nom de la categorie
		$category_name = $categorie->name;
		$title = apply_filters( 'custom_postsbycategory_title' , $category_name );
		
		echo "<h3>".$title."</h3>";
		//afficher les 4 derniers articles de chaque categorie 
		query_posts( "category_name=$category_name&posts_per_page=4" );
		// parcours des articles
		if (have_posts()) :
			echo "<ul style='list-style-type:none;line-height: 3;margin-left:40px'>";
			while (have_posts()) : the_post();
				?>
				<li>
					<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
				<!--<div style="margin-left: 20px"><?php the_content() ?></div>-->
				</li>	
				<?php
			endwhile;        
			echo "</ul>";
		endif;
	}
	?>
	<!-- les liens de pagination -->
	<div class='alignright'><?php next_posts_link( 'Next &raquo;' , $max_num_pages ) ?></div>
	<div class='alignleft'><?php previous_posts_link( '&laquo; Previous' ) ?></div>
	<?php
}
add_action( 'home_loading' , 'show_postsbycategory_index' );