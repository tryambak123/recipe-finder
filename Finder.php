<?php
/**
* This class has all the logic to find the recipe and ingredients
* Author : Tryambak
*/
class Finder
{
	/**
	* This is constructor and it initializes the properties ingredients and recipes using content of files
	* @params $files array of file paths for recipe and ingredients
	* Author : Tryambak
	*/
	function __construct($files){
		$this->recepies = file_get_contents($files['recipes']['tmp_name']);
		$path = $files['ingredients']['tmp_name'];		
		$handle = fopen($path, "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$this->ingredients[] = $data;			
		}
		fclose($handle);
	}
	
	/**
	* This function iterates through recipes and tries to find ingredients for them
	* @return $recipe array if ingredients are found or false if not found
	* Author : Tryambak
	*/
	function findRecepies(){
		$recepies = json_decode($this->recepies, true);
		
		foreach($recepies as $recipe){
			$ingredients = $recipe['ingredients'];
			$ingredients_found = true;
			foreach($ingredients as $key => $data){
				$res = $this->isIngredientAvailable($data);
				if($res == false){
					$ingredients_found = false;
					break;
				}
			}
			if($ingredients_found){
				if($recipe['use_by'] > $res){
					$recipe['use_by'] = $res;
				} else {
					$recipe['use_by'] = $res;
				}
				
				return $recipe;
			}
		}
		return false;
	}
	
	/**
	* This function iterates through ingredients array and checks whether the required ingredients are available or not
	* @params $data, array of ingredient
	* @return expiration date if ingredient is found, if not found returns false
	* Author : Tryambak
	*/	
	private function isIngredientAvailable($data){
		foreach($this->ingredients as $ingredient){
			if($ingredient[0] == $data['item'] && $ingredient[1] >= $data['amount'] && $ingredient[2] == $data['unit'] && strtotime(str_replace('/','-',$ingredient[3])) >= time()){
				return strtotime(str_replace('/','-',$ingredient[3]));
			}
		}
		return false;
		
	}
}