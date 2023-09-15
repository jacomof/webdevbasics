<?php

$User1 = new User();
$User2 = clone $User1;
$User3 = $User1;
$User1->name = "Bertha";
$User2->name = "Sam";
$User3->name = "Peter";
echo "First user's name is: $User1->name <br>";
echo "First user's name is: $User2->name <br>";

class User
{
    public $name;
}

