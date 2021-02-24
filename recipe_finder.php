<?php 
include "FileValidator.php";
include "Finder.php";

$validator = new FileValidator;
foreach($_FILES as $key => $data){
	$error = $validator->validateFile($key, $data);
	
	if($error != ''){
		header("location:index.php?error=".$error);
		exit;
	} else {
		$error = $validator->validateContent($key, $data['tmp_name']);
		if($error != ''){
			header("location:index.php?error=".$error);
			exit;
		}
	}
}

$finder = new Finder($_FILES);
$recipe = $finder->findRecepies();

if(!$recipe){
	$recipe['name'] = 'Order Takeout';
}
header("location:index.php?recipe=".$recipe['name']);
exit;	
?>