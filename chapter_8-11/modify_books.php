<?php
/*PHP script implementing a basic book database system using PHP, the mysqli module, a MySQL database and HTML.*/

/*For instruction on how the different components of this script work, please refer to the db_basics.php script.*/

require_once 'mysql_login.php';

$db_conn = mysqli_connect($sql_host, $sql_user, $sql_pwd, $sql_database);

if(!$db_conn) die("Couldn't connect to database. Something went wrong when stablishing the connection. Error: " . $db_conn->conn_error);


//Input validation of a submitted book using the website's form.
if(isset($_POST['author']) 
    and isset($_POST['isbn'])
    and isset($_POST['title'])
    and isset($_POST['category'])
    and isset($_POST['year'])){
    
    echo "<br><br> -----------------<br> All post variables set <br>-------------------<br>";
        
    extract($_POST, EXTR_PREFIX_ALL, "postvar");
    
    //Here we clean the inputed values from any potentially dangerous character sequence that may make our system suscebtible to sql
    //injection. This is provided by the real_scape_string of mysqli connection class, and should always be done before executing
    //any sql queries.
    $postvar_author = $db_conn->real_escape_string($postvar_author);
    $postvar_isbn = $db_conn->real_escape_string($postvar_isbn);
    $postvar_title = $db_conn->real_escape_string($postvar_title);
    $postvar_category = $db_conn->real_escape_string($postvar_category);
    $postvar_year = $db_conn->real_escape_string($postvar_year);
    
    
    $query = "insert into classics (author, isbn, title, category, year) values('$postvar_author', '$postvar_isbn', '$postvar_title', '$postvar_category', '$postvar_year')";
    echo "$query";
    if($db_conn->query($query)) echo "<br><br> Book registered successfully!";
    else die("Error while registring book!");
    $db_conn->close();    
}else if(isset($_POST['delete']) && isset($_POST['isbn'])){
    $postvar_isbn = $db_conn->real_escape_string($_POST['isbn']);
    
    $query = "DELETE FROM classics WHERE isbn = '$postvar_isbn'";
    if($db_conn->query($query)) echo "Book deleted successfully! <br>";
    else die("Error while deleting book! Error: " . $db_conn->error);
}

echo <<<_END
    <html><head><title>Modify books</title></head>
_END;

echo <<<_END
        <form method='post' action='modify_books.php' enctype='multipart/form-data'>
            <pre>
                author   <input type="text" name="author">
                isbn     <input type="text" name="isbn">
                title    <input type="text" name="title">
                category <input type="text" name="category">
                year     <input type="text" name="year">
                <input type="submit" value="Register book">
            </pre>
        </form>
_END;

//Here we display all the books in the database.
$query = "SELECT * FROM classics";
$books_results = $db_conn->query($query);
//Error handling code snippet. The error property of the mysqli object contains a string explaining the errors that occurred during the connection
//session.
if(!$books_results) die("Something went wrong while fetching books. Error: " . $db_conn->error);
$book = $books_results->fetch_row();

while($book){
    
    $author = $book[0];
    $title = $book[1];
    $category = $book[2];
    $year = $book[3];
    $isbn = $book[4];
    
    echo <<<_END
    <pre>
        author      $author 
        title       $title
        category    $category
        year        $year
        isbn        $isbn
    </pre>
    <form method='post' action='modify_books.php' enctype='multipart/form-data'>
            <input type="hidden" name="delete" value="yes">
            <input type="hidden" name="isbn" value="$isbn"> 
            <input type="submit" value="Delete book">
    </form>
    _END;
    
    $book = $books_results->fetch_row();
}

//As always, we close the connection to free up the resources used by the script (not necessary since the resources will be fred automatically
//in the end of the script, but a good practice anyways to get used to freeing resoures when they're not needed anymore).
$books_results->close();
$db_conn->close();

echo "</html>";