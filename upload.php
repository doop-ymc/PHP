<html>
<head>
<title>Uploading...</title>
</head>
<body>
<h1>Uploading file...</h1>
<?php

if($_FILES['userfile']['erroe'] > 0)
{
    echo 'Problem:';
    switch($_FILES['userfile']['error'])
    {
        case 1:
            echo 'File exceeded upload_max_filesize';
            break;
        case 2:
            echo 'File exceeded max_file-zise';
            break;
        case 3:
            echo 'File only partially uploaded';
            break;
        case 4:
            echo 'No file uplaoded';
            break;
        case 6:
            echo 'Cannot upload file:No temp directory specified';
            break;
        case 7:
            echo 'Uplaod file failed:cannot write to disk';
            break;
    }
    echo "<br/>";
    exit;
}

if($_FILES['userfile']['type'] != 'text/plain')
{
    echo 'Problem: file is not plain text'.$_FILES['userfile']['type'];
    echo "<br/>";
    // exit;
}

$upfile = '/upload/'.$_FILES['userfile']['name'];

if(is_uploaded_file($_FILES['userfile']['tmp_name']))
{
    if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
    {
        echo 'Problem: Could not move file to destination directory';
        echo $upfile."<br/>";
        exit;
    }
}
else
{
    echo 'Problem:Possible file upload attack.Filename<br/>';
    echo $_FILES['userfile']['name']."<br/>";
    echo $_FILES['userfile']['tmp_name']."<br/>";
    exit;
}

echo 'File uploaded successfully<br/><br/>';

$content = file_get_contents($upfile);
$content = strip_tags($content);

file_put_contents($_FILES['userfile']['name'], $content);
echo '<p>Preview of uploaded file contents:<br/><br/></p>';
echo nl2br($content);
echo '<br/><br/>';

?>

</body>
</html>
