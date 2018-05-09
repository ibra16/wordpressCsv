<?php
require_once("../wp-load.php");
require_once("../wp-admin/includes/taxonomy.php");

//recuperation des categories

$args = array("hide_empty" => 0);
$categories = get_categories($args);

//creation d'un article par modele
foreach ( $categories as $category ) {

	//eleminer la categorie "Marques auto" et ses filles 'marque'
	 
	if(get_category(get_category($category->parent)->parent)->name == "Marques auto"){

		//creation des aticles
		$new_post = array(
		  'post_title' => "Article sur ".get_category($category->parent)->name." modele ".$category->name,
	   	  'post_content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
		  'post_status' => "publish",
		  'post_author' => 1,
		  'post_type' => "post",
		  'post_category' => array($category->cat_ID,$category->parent)
		);
		 
		$post_id = wp_insert_post($new_post);

		/**** test de creation ***/
		if($brand_id){
			echo "Article sur".$category->name." est créé <br>";
		}else{
			echo "Article sur ".$category->name." n'est pas créé <br>";
		}
		/*************************/
	}
}

?>