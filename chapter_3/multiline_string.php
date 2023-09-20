<?php
/*PHP script to showcase how to write a multiline string. In PHP, we can just include spaces within the string constructor characters (" or ').
Additionally, we can use a syntax called "heredoc", which is declared the following way:
first we write "<<<", just after we write a unique name of the heredoc, then, we need to add a new line and write whatever characters we
want, no need to scape any of them. Finally, we add a new line wherever we want to end the multiline string, and in this new line
we write the same name used to begin the heredoc and end it with a semicolon.*/

$name = "Peter";

//Normal multiline string.
echo "<pre>";
$text = "hello my name is
$name, yes! <br>";
echo "</pre>";

$random_variable = "The Variable";

//Example of Heredoc
//No characters have to be scaped, except if we want to write a variable name prepended with the dollar sign,
//which we do have to scape to avoid the variable from being substituted.
echo $text;
echo <<<HEAD
Hello, yes, Helloooo <br>
We just write characters and whatever we like as ", ' with no need to scape them.
We can also include variables, like the following $random_variable.
We do have to scape the dollar sign characters which are followed by any other character without a space in the middle,
since they are interpreted as variables. For example, we can write the string \$random_variable which we used before to 
substitute the variable's name with its value in the "The Variable" example.
HEAD;


