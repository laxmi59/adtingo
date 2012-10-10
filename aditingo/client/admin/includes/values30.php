<?php

$ProductCat=array('1'=>"Clothing",'2'=>"Headwear",'3'=>"Badges/Keyrings/Magnets",'4'=>"Bags",'5'=>"Band/Artist Merchandise",'6'=>"YoYoTrax Merchandise",'7'=>"Memorabilia",'8'=>"Other");

function Get_Product_list()
{
	global $ProductCat;
	foreach($ProductCat as $k=>$v)
	{
		if($k==$pro)
		{
			$ProductList.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$ProductList.= "<option value='$k'>$v</option>";
		}
	}
	
	return $ProductList;
}

?>
