<?php 

try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=GAG;charset=utf8', 'root', 'zbooby*dev', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}


