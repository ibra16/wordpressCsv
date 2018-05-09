<?php
//les fichiers de wordpress
include 'load.php';

//id de la categorie Marques auto
$parent_id=get_cat_ID("Marques auto");

//recuperation des categories filles de Marques auto
$args = array("hide_empty"=>0,"child_of"=>$parent_id);
$categories = get_categories($args);

//creation d'un article par modele
foreach ($categories as $category) {

	//elemination des marques
	 
	if(isset($category) && $category->parent != $parent_id ){

		//extraction des informations
		$model_name=$category->name;
		$model_id=$category->cat_ID;
		$marque_name=get_category($category->parent)->name;
		$marque_id=$category->parent;

		//creation des aticles
		$new_post = array(
			'post_title'    => "Article sur ".$marque_name." modele ".$model_name,
	   	 	'post_content'  => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
		 	'post_status'   => "publish",
		 	'post_category' => array($model_id,$marque_id)
		);
		 
		$post_id = wp_insert_post($new_post);

		/**** test de creation ***/
		if($post_id){
			echo "Article sur ".$model_name." est créé <br>";
		}else{
			echo "Article sur ".$model_name." n'est pas créé <br>";
		}
		/*************************/
	}
}
?>