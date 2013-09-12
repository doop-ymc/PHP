<html>
<head>
    <title>Book-O-Rama Book Entry Results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Book-O-Rama Book Entry Results:</h1>
<?php
// header('Content-Type:text/html;charset=utf-8');
$isbn = $_POST['isbn'];
$author = $_POST['author'];
$title = $_POST['title'];
$price = $_POST['price'];

if(!$isbn || !$author || !$title || !$price)
{
    echo "You have not entered the required details. <br/>"
         ."Please go back and try again.";
    exit;
}

 /* if(!get_magic_quotes_gpc())
{
    $isbn = addslashes($isbn);
    $author = addslashes($author);
    $title = addslashes($title);
    $price =addslashes($price);
}  */
echo "双引号:$author<br/>";
echo '单引号:$author<br/>';
echo "select * from books where isbn='$isbn'";
echo 'select * from books where isbn=\'$isbn\'';
echo $author.$title."<br/>";
@ $db = mysqli_connect('localhost', 'ymc', '123456', 'books') or die("cannot connect to db!");
if(mysqli_connect_errno())
{
    echo "Error:Could not connect to database.Please try again later!<br/>";
    exit;
}
// mysql_select_db("books",$db) or die("failed ro select db!");
#$setRes = mysqli_query($db, "set names utf8");
   
$setRes = mysqli_set_charset($db, 'utf8');
printf("Current character set: %s\n", mysqli_character_set_name($db));
/* if(!$setRes)
{
    echo "Set names utf8 error!<br/>".mysql_error();
    exit;
} */
// mysql_query("set character set 'utf8'", $db) or die ("failed to set character set utf8!");
#mb_internal_encoding('utf-8',$db);
/* $query = "insert into books values(?,?,?,?)";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "sssd", $isbn, $author, $title, $price);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$num = mysqli_affected_rows($db);
echo $num."book insert into database."; */

$query = "insert into books values ('".$isbn."', '".$author."', '".$title."', '".$price."')"; 
#$query = 'insert into test1 values ("098765", "zhiyajun"," 中文","123")'; 
echo "QUERY:".$query."<br/>";
$result = mysqli_query($db, $query);
if($result)
{
    echo mysqli_affected_rows()."book insert into database.";
}
else
{
    echo "An error has occured. The item was not added.";
} 
// mysqli_close($db);
?>
</body>
</html>
