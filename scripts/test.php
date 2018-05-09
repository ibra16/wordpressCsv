<?php

//les fichiers de wordpress
include 'load.php';

/*$brand_model=array();
$index=0;
if (($file = fopen("csv_marque_Modele_290318.csv", "r"))) {
    while (($data = fgetcsv($file,288, ";"))) {
    	$row[]=$data;
        if(!empty($data[0]) && !empty($data[1])){
        	if($row[$index][0] != $row[$index-1][0]){
				$model=array();
				$model[]=$data[1];
			}
        	if (array_key_exists($data[0],$brand_model)){
        		$model[]=$data[1];
			}
			$brand_model[$data[0]]=$model;
    	}
    	$index++;
     }
}
//$brands=array_unique($all_brands);
unset($brand_model["MARQUE"]);

foreach ($brand_model as $brand=>$model) {
	echo "brand : ".$brand;
	echo "<br>";
	for ($i=0; $i < count($model) ; $i++) {
		echo "-->sous categorie : ".$model[$i];
		echo "<br>";
	}
}*/

/********* cat id ************/
$parent_id=get_cat_ID("Marques auto");

$args = array("hide_empty"=>0,"child_of"=>$parent_id);
$categories = get_categories($args);
foreach ( $categories as $category ) {
	if(isset($category) && $category->parent != $parent_id ){
		echo $category->name." ".get_category($category->parent)->name;
		echo "<br>";
	}
}
/******************************/
//echo get_permalink(1180);