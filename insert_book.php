<html>
<head>
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php

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

if(!get_magic_quotes_gpc())
{
    $isbn = addslashes($isbn);
    $author = addslashes($author);
    $title = addslashes($title);
    $price =addslashes($price);
}

@ $db = mysqli_connect('localhost', 'ymc', '123456', 'books');
if(mysqli_connect_errno())
{
    echo "Error:Could not connect to database.Please try again later!<br/>";
    exit;
}

$query = "insert into books values
    ('".$isbn."', '".$author."', '".$title."', '".$price."')";
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

$db->close();
?>
</body>
</html>
