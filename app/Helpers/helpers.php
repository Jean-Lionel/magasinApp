<?php



function getPrice($price){



	$price = floatval($price);


	return number_format($price, 2,'.',' , ').' FBU';
}