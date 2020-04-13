<?php
$servername = "localhost";
$username = "root";
$password = "";/* Put your password here */
/* Create connection */
$conn = new mysqli($servername, $username, $password);
/* Check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
/* Create database */
$sql = "DROP DATABASE userdetails";
if ($conn->query($sql) === TRUE) {
    echo "Sucessful Connection to the DataBase";
}
else
{
    echo "Error Creating Database: " . $conn->error;
}
$conn->close();
?>
<!DOCTYPE HTML>
<html>
<head>DataBase Management</head>
<body>
  <h1> This is the Database Management Page </h1>
</body>
</html>
