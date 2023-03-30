<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php    
// access the uploaded file
$userFile = $_FILES['userFile'];

// display file name
echo "Name: " . $userFile['name'] . "<br />";

// size
echo "Size: " . $userFile['size'] . "<br />";

// temp location in server cache
echo "Temp Location:" . $userFile['tmp_name'] . "<br />";

// type
//echo "Type: " . $userFile['type'] . "<br />"; - unsafe: only checks file extension
echo "Type: " . mime_content_type($userFile['tmp_name']) . "<br />";

// use the session object to create a unique name.  profile.png => 2sd89f23-profile.png
session_start();
$fileName = session_id() . '-'. $userFile['name'];

// transfer file out of temp location to uploads folder
move_uploaded_file($userFile['tmp_name'], 'uploads/' . $fileName);

?>
</body>
</html>