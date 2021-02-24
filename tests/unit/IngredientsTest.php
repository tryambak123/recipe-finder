<?php
/**
* This class has test cases to test the data in fridge.csv
* Author : Tryambak
*/
use PHPUnit\Framework\TestCase;
class IngredientsTest extends TestCase
{
	public function testFailure(): void
    {
		define('PATH', dirname(dirname(__DIR__)));
		$path = PATH.'/data/fridge.csv';
		$this->assertFileExists($path);
		
		if (($handle = fopen($path, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {				
				$this->assertCount(4, $data);	
				$this->assertIsNumeric($data[1]);
			}
			fclose($handle);
		}
    }
}
?>