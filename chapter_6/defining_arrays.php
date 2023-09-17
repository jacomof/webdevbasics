<?php
/*PHP program showcasing the different types of arrays present
in the language. 
An array is a data type that consists of a sequence of ordered 
elements stored together. The elements of an array can be accessed
with an index that uniquely identifies it inside of the array.

There are two types of arrays in PHP: numeric and associative 
arrays. The elements of a numeric array are accessed using
a positive integer as an index. Associative arrays' elements
are accessed using a string as index (eg. a['person']).*/

/*Numeric arrays
 * 
 * 
 * ------------------*/

//Creating an empty array

$list = Array(); //Alternatively, $list = []

//Automatic appending. Let php determine the position of the new element with its internal array pointer.
$list[] = 2;
$list[] = 3;

for($i=0; $i < 2; $i++)
    //Indexing array
    print $list[$i] . '<br>';

//Initialization with values
$list = array('a','b','c','d','e');
$l = sizeof($list);
$message = '';
for($i=0; $i < $l; $i++)
    $message .= $list[$i];

print $message . '<br>';


/* Associative arrays (eg. arrays indexed with strings)
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