<?php
$dog=true;

if($dog)
    echo "It's cute!";
else 
    echo "Not a dog, so queationable cuteness";
echo " <br> \n";
$level = 2;
switch ($level){
    case(1): 
        echo "Total beginner :3";
        break;
    case(2):
        echo "Intermediate apprentice";
        break;
    case(3):
        echo "Respectable Master!";
        break;
    default:
        echo "No level supplied";
        break;
        
}

echo " <br> \n";

$phrase = "";
echo $phrase ? "Phrase not empty :)": "Phrase empty!";