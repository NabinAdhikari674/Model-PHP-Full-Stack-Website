<?php
    $message = "";
    $servername = "localhost";
    $username = "root";
    $password = "";/* Put your password here */
    $dbname = "databaseUsers";
    /* Create connection */
    $conn = new mysqli($servername, $username, $password);
    /* Check connection */
    if ($conn->connect_error) {
        die("\nConnection Failed (Error at New DataBase Connection): " . $conn->connect_error);
      }
    /* Create database */
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to the DataBase");
      }
    else
      {echo nl2br("\nError while Connecting/Creating Database: " . $conn->error);}

    /* Create connection */
    $conn = new mysqli($servername, $username, $password, $dbname);
    /* Check connection*/
    if ($conn->connect_error) {
        die("\nConnection Failed (Error at Connection to Existing DB): " . $conn->connect_error);

    }
    /*First_name,Last_name,Email,Password,Gender,Agree Conditions*/
    /*First_name,Last_name,Email,Password,Gender,Agree Conditions as required field*/
    $sql = "CREATE TABLE IF NOT EXISTS userDetails
          (
          FirstName varchar(20) NOT NULL,
          LastName varchar(20) NOT NULL,
          Email varchar(50) NOT NULL PRIMARY KEY,
          UserName varchar(50) UNIQUE,
          Password varchar(50) NOT NULL,
          Gender varchar(10) NOT NULL
          )";
    if ($conn->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to User DataBase");
    }
     else {
        echo nl2br("\nError Connecting to/Creating User DataBase : " . $conn->error);
    }?>
