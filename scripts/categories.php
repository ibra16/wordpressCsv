<?php
//les fichiers de wordpress
include 'load.php';

//categorie parente 
$parent_id=wp_create_category("Marques auto");

/**test creation marques auto**/
if($parent_id){
	echo "Categorie Marques auto est créé <br>";
}else{
	echo "Categorie Marques auto n'est pas créée <br>";
}
/******************************/	

/*organisation des données dans un tableau associative brand=>array('marque1','marque2'...)*/

$brand_model=array();
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

//supprimer la premiere ligne "en tête"
unset($brand_model["MARQUE"]);

//creation des categories et sous categories
foreach ($brand_model as $brand=>$model) {
	//les marques de voitures
	$brand_id=create_categories($brand,$parent_id);

	for ($i=0; $i < count($model) ; $i++) {
		//les modeles de voitures
		create_categories($model[$i],$brand_id);
	}
}


//fonction de creation des categries
function create_categories($name,$parent){

	//creation des categories
	$categorie_id=wp_create_category($name,$parent);
	
	/**** test de création ****/
	if($categorie_id){

		echo "Marque ".$name." est créé <br>";

	}else{

		echo "Marque ".$name." n'est pas créée <br>";

	}

	return $categorie_id;
}
?>