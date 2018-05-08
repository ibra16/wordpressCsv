<?php
require_once("../wp-load.php");
require_once("../wp-admin/includes/taxonomy.php");

//categorie parente 
$parent_id=wp_create_category("Marques auto");

/**test creation marques auto**/
if($parent_id){
	echo "Categorie Marques auto est créé <br>";
}else{
	echo "Categorie Marques auto n'est pas créé <br>";
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
				$model[]=$row[$index][1];
			}

        	if (array_key_exists($data[0],$brand_model)){
        		$model[]=$data[1];
			}
			$brand_model[$data[0]]=$model;
    	}
    	$index++;
     }
}

//suprrimer la premiere ligne "en tête"
unset($brand_model["MARQUE"]);

//creation des categories et sous categories
foreach ($brand_model as $brand=>$model) {
	//les marques de voitures
	$brand_id=wp_create_category(preg_replace('/[^A-Za-z0-9\-]/', ' ', $brand),$parent_id);
	
	/**test de création des marques**/
	if($brand_id){
		echo "Marque ".$brand." est créé <br>";
	}else{
		echo "Marque ".$brand." n'est pas créé <br>";
	}
	/******************************/

	for ($i=0; $i < count($model) ; $i++) {
		//les modeles de voitures
		$model_id=wp_create_category(preg_replace('/[^A-Za-z0-9\-]/', ' ',$model[$i]),$brand_id);

		/**test de creation des modeles**/
		if($brand_id){
			echo "Modele ".$model[$i]." est créé <br>";
		}else{
			echo "Modele ".$model[$i]." n'est pas créé <br>";
		}
		/********************************/
	}
}
?>