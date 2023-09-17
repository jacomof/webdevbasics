<?php
/*Different array functions to learn php's basic array functionalities
 * 
 *-----------------------*/

echo "<pre>";

//is_array function, to check if variable is an array

$words[] = 'hi';
$words[] = 'dog';
$words[] = 'history';
$words[] = 'television';

printf("Is \"words\" an array? %'#-10s \n", is_array($words) ? "true":"false");

//Sort function, to sort an array from lowest to largest. Second argument is a constant
//determining the sorting criteria.
//Acts directly in the array, returns true if successful.

sort($words, SORT_STRING); //Sort elements as strings
echo "Sorted words are: ";
print_array($words);
sort($words, SORT_NUMERIC); //Sort elements as numbers
echo "Sorting words array numerically results in: ";
print_array($words);

//Shuffle function, arranges elements of the array randomly. Acts directly on the array, returns true if successful.

shuffle($words);
echo "Shuffled array is: ";
print_array($words);

//explode splits a string by a splitter substring
$csl = 'elem1, elem2, elem3';

$list = explode(', ', $csl);
$count=0;
foreach($list as $elem){
    
    print "Element $count is $elem <br>";
    $count++;
    
}

//implode generates a string from an array by concatenating its elements. It separates the elements inside of the string using a 
//"glue" string (in this case ', ').
$csl_reconstructed = implode(', ', $list);
echo "reconstructing array: $csl_reconstructed" . '<br>';

//extract imports all key/value pairs inside an associative array in the current symbol table
//can prefix the variables with string and indicate flags to avoid overriding existing variables
$ass_array = array("age" => 28, "number" => 63212323, "city" => "San Diego");
if(extract($ass_array, EXTR_PREFIX_ALL, "new") > 0)
    print("Person's city is $new_city <br>");

//compact concatenates several variables into an array
$ass_array_reconst = compact("new_age", "new_number", "new_city");
foreach($ass_array_reconst as $key => $elem){
    print "Variable $key is $elem <br>";
}


/*Function to print an array.*/
function print_array(&$arr){
    echo "[";
    //Iterate and print each of its elements.
    foreach($arr as $s)
        printf("$s,");
        echo "]\n";
}