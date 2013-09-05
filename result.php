<html>
<head>
    <title>Book-O-Rama Search Results</title>

</head>
<h1>Book-O-Rama Search Results</h1>
<?php
$searchtype = $_POST['searchtype'];
$searchterm = trim($_POST['searchterm']);
if(!searchtype || !searchterm)
{
    echo 'You have not entered search details.Please go back and try again.';
    exit;
}

if(!get_magic_quotes_gpc())
{
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
}

@ $db = new mysqli('localhost', 'ymc', '123456', 'books');

if(mysqli_connect_errno())
{
    echo 'Error:Could not connect to db,Please try later:';
    exit ;
}

$query = "select * from books where ".$searchtype." like '%".$searchterm."%'";

echo "QUERY:".$query."<br/>";
$result = $db->query($query);

$num_results = $result->num_rows;

echo "<p>Number of books found:".$num_results."</p>";
for($i = 0; $i < $num_results; $i++)
{
    $row = $result->fetch_assoc();
    echo "<p><strong>".($i+1).".Title:";
    echo htmlspecialchars(stripcslashes($row['title']));
    echo "</strong><br/>Author:";
    echo stripcslashes($row['author']);
    echo "<br/>ISBN:";
    echo stripcslashes($row['isbn']);
    echo "<br/>Price:";
    echo stripcslashes($row['price']);
    echo "</p>";
}

$result->free();
$db->close();

?>
</html>
