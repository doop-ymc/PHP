<?php
$name = $_POST['name'];
$password = $_REQUEST['password'];

echo sha1($name).$name."<br/>";
echo $password."<br/>";
if((!isset($name)) || (!isset($password)))
{
?>
<h1>Please Login In</h1>
<p>This page is secret.</p>
<form method="post" action="secretdb.php">
    <p>Username:<input type="text" name="name"></p>
    <p>Password:<input type="password" name="password"></p>
    <p><input type="submit" name="submit" value="Log In"></p>
</form>    
<?php
}
// else if(($name == "user") && ($password == "pass"))
else
{
    @ $db = mysqli_connect("localhost", "ymc", "123456");
    if(!$db)
    {
        echo "connot connect to database.";
        exit;
    }

    $selectdb = mysqli_select_db($db,"books");
    if(!$selectdb)
    {
        echo "select db error.";
        exit;
    }

    $query = "select * from customers where name='".$name."' and city='".$password."'";
    $result = mysqli_query($db, $query);
    if(!$result)
    {
        echo "Cannot run query.";
        exit;
    }
    $row_nums = mysqli_num_rows($result);
    if($row_nums > 0)
    {
     echo "<h1>Here it is!</h1>
        <p>I bet you are glad you can see this secret page.</p>";
    }
    else
    {
        echo "<h1>Go Away!</h1>
        <p>You are not authorized to use this resource.</p>";
    }
}
?>
