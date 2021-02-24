<?php
/**
* This class has all the logic to vslidate the files and contents in the file
* Author : Tryambak
*/
class FileValidator
{
	/**
	* This function validates content of files
	* @params $file, type of file whther it is ingredients or recipes
	* @params $path, temporary path of uploaded file
	* Author : Tryambak
	*/
	public function validateContent($file, $path){
		$error = '';
		if($file == 'recipes'){
			$recepes = file_get_contents($path);	
			$recepes = json_decode($recepes, true);
			foreach($recepes as $key => $recipe){
				foreach($recipe['ingredients'] as $key1 => $arr){
					if($arr['item'] == '' || $arr['amount'] == '' || !is_numeric($arr['amount']) || $arr['unit'] == ''){
						$error = 'Invalid data';
					}
				}
			}
		} else {
			if (($handle = fopen($path, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if(count($data) < 4 || !is_numeric($data[1]) || $this->isValidDate($data[3])){
						$error = 'Invalid data';
					} else{
						foreach($data as $key => $val){
							if($val == ''){
								$error = 'Invalid data';
							}
						}
					}
					
				}
				fclose($handle);
			}
		}
	}
	
	/**
	* This function validates the file type and size
	* @params $file, type of file whther it is ingredients or recipes
	* @params $data, the information like size and type of file 
	* @returns $error String
	* Author : Tryambak
	*/
	public function validateFile($file, $data){
		$error = '';
		if($file == 'recipes'){
			if($data['type'] != 'application/json'){
				$error = 'Invalid file type';
			} elseif($data['size'] == 0) {
				$error = 'Empty file';
			}
		} else {
			if($data['type'] != 'application/vnd.ms-excel'){
				$error = 'Invalid file type';
			} elseif($data['size'] == 0) {
				$error = 'Empty file';
			}
		}
		
		return $error;
	}
	
	/**
	* This function validates the Use by date of ingredient
	* @params $date_string
	* @returns boolean
	* Author : Tryambak
	*/
	private function isValidDate($date_string){
		$arr_date = explode('/',$date_string);
		if(checkdate($arr_date[1], $arr_date[0], $arr_date[2])){
			return true;
		} else {
			return false;
		}
	}
}