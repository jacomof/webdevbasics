<?php
/*PHP script to demonstrate date processing in PHP*/

//time() returns the UNIX timestamp representation of the current time
//UNIX timestamp are integers that represent the number of seconds passed since the start of 1970
//The 32-bit signed version let's you declare periods of time between 1901 to 2038 

printf("<pre>Current timestamp: %s\n",time());

//One can make calculations using the timestamps, since it's just adding seconds to a given amount
//e.g. to add six days to the current date:


$new_moment = time() + 6*24*60*60;

printf("Current timestamp six days later: %s\n",  date("Y-d-m", $new_moment));

//date() returns the a string representing a date using the format specified in the input string argument
printf("Today's date is %s\n", date("Y-d-m"));

//mktime() creates a date from numbers representing, in order: hour, minute, seconds, month, day, year
$generated_date = mktime(2,0,30,2,15,2020);
printf("Generated date is: %s\n", date("Y-d-m H:i:s", $generated_date));

//Date format constants. These are constants used to store commnon date formats for the date function

printf("Current date in RSS format: %s\n", date(DATE_RSS));
printf("Current date in World Wide Web Consortium fomrat: %s\n", date(DATE_W3C));

//checkdate() function to check if a given date is valid
$year=3000;
$month=11;
$day=21;

print_if_valid_date($month, $day, $year);
$day = 35;
print_if_valid_date($month, $day, $year);

function print_if_valid_date($month, $day, $year){
    
    $msg = checkdate($month, $day, $year) ? "Yes, it's a valid date!" : "No, it's not a valid date";
    printf("Is the input date valid? %s\n", $msg);
    
}






