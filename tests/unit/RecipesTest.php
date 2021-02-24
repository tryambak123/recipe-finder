<?php
/**
* This class has test cases to test the data in recipes.json
* Author : Tryambak
*/
use PHPUnit\Framework\TestCase;
class RecipesTest extends TestCase
{
	public function testFailure(): void
    {
		define('PATH', dirname(dirname(__DIR__)));
		$path = PATH.'/data/recipes.json';
		$this->assertFileExists($path);		
		$json = file_get_contents($path);
		$recipes = json_decode($json, true);
		$this->assertIsArray($recipes);
		$this->assertNotEmpty($recipes);
		
		foreach($recipes as $key => $val){
			if($key == 'name'){
				$this->assertNotEmpty($val);
			} else {
				foreach($val['ingredients'] as $key => $ingredient){
					$this->assertIsNumeric($ingredient['amount']);
					$this->assertNotEmpty($ingredient['item']);
					$this->assertNotEmpty($ingredient['unit']);
				}
			}
		}
    }
}
?>