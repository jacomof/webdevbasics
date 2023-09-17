<?php
/*PHP script to demonstrate how to clone objects. When an object is cloned, a bran new copy is made from itself
and if we change the copy, the original is not affected.*/

$User1 = new User();
$User1->name = "Bertha";
$User2 = clone $User1;
$User3 = $User1;
$User3->name = "Peter";
//Here, we can verify that the name of User1 changed, as we changed in the User3, which is just a reference of User1
echo "First user's name is: $User1->name <br>";
//However, in user User2 the name is still Bertha, as we cloned the object before making the change!
echo "First user's name is: $User2->name <br>";

class User
{
    public $name;
}

