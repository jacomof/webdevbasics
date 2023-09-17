<?php
/*PHP script to define a simple function that returns the date two days before the current date.
As you can see, to declare a function we just write the "function" followed by the name of the function and its arguments.
The arguments is a list of variables (which may be typed if needed) separated by commas.*/

function longdate(int $timestamp){
    return date("l F jS Y", $timestamp);
}

echo longdate(time() - 2*24*60*60);