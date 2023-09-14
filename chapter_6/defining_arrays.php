<?php
/*Numeric arrays
 * 
 * 
 * ------------------*/
//Automatic appending. Let php determine the position of the new element with its internal array pointer.
$list[] = 2;
$list[] = 3;

for($i=0; $i < 2; $i++)
    print $list[$i] . '<br>';

//Initialization with values
$list = array('a','b','c','d','e');
$l = sizeof($list);
$message = '';
for($i=0; $i < $l; $i++)
    $message .= $list[$i];

print $message . '<br>';

/* Associative arrays
 * 
 * -----------------*/

//Automatic appending
$dict['bedrooms']=2;
$dict['bathrooms'] = 1;
$dict['feets'] = 200;

print 'New apartament renovated with '. $dict['bedrooms'] . ' bedroom/s, ' . $dict['bathrooms'] . ' bathroom/s and ' . $dict['feets'] . ' square feets';
print '<br>';

//Initialization using array constructor and => binding

$dict_v2 = array("houses"=>3, "buildings"=>1);
print implode(', ',$dict_v2) . '<br>';