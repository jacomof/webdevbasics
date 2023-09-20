<?php
/*PHP script showcasing the different conditional expression in PHP.*/


$dog=true;

//Here we showcase the incredibly common if([expression]){[block]} else {[expression]} statement used to control the flow of execution of a program.
//The expression inside of the parenthesis of the if statement is evaluated, and if it returns true (or, in php, a value that evaluates to true
//in the context of a boolean expression, since it has dynamic typing) we execute the block just after the if keyword. If it evaluates to false
//we execute the block after the else part of the statement. 
if($dog)
    echo "It's cute!";
else 
    echo "Not a dog, so queationable cuteness";
echo " <br> \n";
$level = 2;

//Here we are creating a switch statement. 
//This conditional works like this:
//First, the expression within the parenthesis after the switch keyword is evaluated, and then compared to 
//each of the values contained with the case keywords. If they match, the block after the case statement is executed.
//Multiple case statements can be executed if the expression mateches with more than one case value, and we can avoid this by placing a 
//break statement after the each corresponding case blocks, which skips to the end of the switch statement.
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

//The last expression we'll explore is the terniary operator. It's an operator that evaluates an expression an returns a certain value 
//if the expression evaluates to true, or another if it evaluates to false. The two values are separated by a colon (":"): the value returned
//if the expression is true is the one at the left of the colon, if false the value returned is the one at the right.
echo $phrase ? "Phrase not empty :)": "Phrase empty!";