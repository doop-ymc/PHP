<html>
<head>
    <title>Book-O-Rama Search Results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<h1>Book-O-Rama Search Results</h1>
<?php
// header('Content-Type:text/html;charset=utf-8');
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
@ $db = mysqli_connect('localhost', 'ymc', '123456', 'books');
if(mysqli_connect_errno())
{
    echo 'Error:Could not connect to db,Please try later:';
    exit ;
}
mysqli_query($db,"set names utf8");
printf("Current character set: %s\n", mysqli_character_set_name($db));
#mysql_query("SET CHARACTER_SET_CLIENT=utf8", $db);
#mysql_query("SET CHARACTER_SET_RESULTS=utf8", $db);
$query = "select * from books where ".$searchtype." like '%".$searchterm."%'";

echo "QUERY_new:".$query."<br/>";

$result = mysqli_query($db, $query);
$result1 = mysqli_query($db, $query);
$result2 = mysqli_query($db, $query);

$num_results = mysqli_num_rows($result);

echo "<p>Number of books found:".$num_results."</p>";
for($i = 0; $i < $num_results; $i++)
{
    $row1 = mysqli_fetch_assoc($result1);
    echo "<p><strong>".($i+1).".Title:";
    echo htmlspecialchars(stripcslashes($row1['title']));
    echo "</strong><br/>Author:";
    echo stripcslashes($row1['author']);
    echo "<br/>ISBN:";
    echo stripcslashes($row1['isbn']);
    echo "<br/>Price:";
    echo stripcslashes($row1['price']);
    echo "</p>"; 
    
    $row = mysqli_fetch_object($result);
    echo "<p><strong>".($i+1).".Title:";
    echo htmlspecialchars(stripcslashes($row->title));
    echo "</strong><br/>Author:";
    echo stripcslashes($row->author);
    echo "<br/>ISBN:";
    echo stripcslashes($row->isbn);
    echo "<br/>Price:";
    echo stripcslashes($row->price);
    echo "</p>"; 

    $row2 = mysqli_fetch_row($result2);
    echo "<p><strong>".($i+1).".Title:";
    echo stripcslashes($row2[2])."<br/>";
    echo $row2[2]."<br/>";
    echo htmlspecialchars($row2[2], ENT_COMPAT ,'UTF-8');
    echo "</strong><br/>Author:";
    echo stripcslashes($row2[1]);
    echo "<br/>ISBN:";
    echo stripcslashes($row2[0]);
    echo "<br/>Price:";
    echo stripcslashes($row2[3]);
    echo "</p>"; 


    echo "------------------------------------------<br/>";
}

$result->free(); 
$result1->free(); 
$result2->free(); 
$db->close();

?>
</html>

