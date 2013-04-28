<?php

$url = parse_url("http://www.marktplaats.nl/z.html?query=raspberry+pi&categoryId=0&postcode=3501DD&distance=0");

parse_str($url['query'], $url); //turns the URL query string into a corresponding array

//print_r($url); //handy for debugging

$groups = array(
                    0, 1, 31, 91, 2600, 48, 201, 289, 1744, 322, 378, 1098, 395, 239, 445, 1099, 504, 1032, 565, 621, 
                    1776, 678, 728, 1784, 1826, 356, 784, 820, 1984, 1847, 167, 856, 895, 976, 537, 1085, 428,
                );

$query = array(
                'pmin'  => preg_replace('/,\d\d/', '', $url['priceFrom']), //strip the comma and two last decimals
                'pmax'  => preg_replace('/,\d\d/', '', $url['priceTo']), //strip the comma and two last decimals
                'q'     => $url['query'],
                'pc'    => $url['postcode'],
                'd'     => $url['distance'],
                'ts'    => $url['searchOnTitleAndDescription'] == true ? 1 : 0, //replace 'true' by 1 or else put 0
);

if( in_array($url['categoryId'], $groups) ){ //checks categoryId against group array to know whether to use g or u var name
    $query['g'] = $url['categoryId'];
}else{
    $query['u'] = $url['categoryId'];
};

echo "<a href=\"
http://kopen.marktplaats.nl/opensearch.php?" . http_build_query($query). "\">
http://kopen.marktplaats.nl/opensearch.php?" . http_build_query($query) . "</a>";

?>
