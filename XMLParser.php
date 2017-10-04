<?php
function getXML($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $retValue = curl_exec($ch);          
    curl_close($ch);
    return $retValue;
}

$sXML = getXML('http://domain.com/products.xml'); //get xml file

$data = simplexml_load_string($sXML); // load xml data 

$limit = 12; // number of products to appear per page

$totalProducts = count($data); // total products

$totalPage = ceil($totalProducts) / $limit); // total products list page

$products = array();


foreach($data as $d)
{
	 array_push($products, $d);
}

for ($i=1; $i<=$totalPage; $i++) 
{
			$offset = ($i - 1) * $limit;

			foreach(array_slice($products, $offset, $limit) as $product) 
			{ 
					foreach($product->images as $image) // if product have more images
					{ 
							echo $image->image1;
					} 
						echo $product->name;
						echo $product->description;
						echo $product->price;
			}
}

?>
