<?php
    $message = "";
    $servername = "localhost";
    $username = "root";
    $password = "";/* Put your password here */
    $dbname = "databasePosts";
    /* Create connection */
    $connPost = new mysqli($servername, $username, $password);
    /* Check connection */
    if ($connPost->connect_error) {
        die("\nConnection Failed (Error at New DataBase(Post) Connection): " . $connPost->connect_error);
      }
    /* Create database */
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($connPost->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to the DataBase");
      }
    else
      {echo nl2br("\nError while Connecting/Creating PostDatabase: " . $connPost->error);}

    /* Create connection */
    $connPost = new mysqli($servername, $username, $password, $dbname);
    /* Check connection*/
    if ($connPost->connect_error) {
        die("\nConnection Failed (Error at Connection to Existing DB(Post): " . $connPost->connect_error);

    }
    /*First_name,Last_name,Email,Password,Gender,Agree Conditions*/
    /*First_name,Last_name,Email,Password,Gender,Agree Conditions as required field*/
    $sql = "CREATE TABLE IF NOT EXISTS userPosts
          (
          PostId int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          UserName varchar(50) NOT NULL,
          Title varchar(80) NOT NULL,
          Popularity int(20) NOT NULL DEFAULT '0',
          Post text NOT NULL,
          CreationAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          UpdatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
    if ($connPost->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to User DataBase");
    }
     else {
        echo nl2br("\nError Connecting to/Creating User Posts DataBase Table : " . $connPost->error);
    }
    $sql = "CREATE TABLE IF NOT EXISTS postReactions
          (
          PostId int(20) NOT NULL,
          UserName varchar(50) NOT NULL,
          Reaction int(2) NOT NULL DEFAULT '0',
          Popularity int(20) NOT NULL DEFAULT '0'
          )";
    if ($connPost->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to User DataBase");
    }
     else {
        echo nl2br("\nError Connecting to/Creating Post Reactions Table : " . $connPost->error);
    }
    $sql = "CREATE TABLE IF NOT EXISTS postComments
          (
          PostId int(20) NOT NULL,
          CommentId int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          ParentId int(20) NOT NULL,
          UserName varchar(50) NOT NULL,
          Comment text NOT NULL,
          CreationAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          UpdatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
    if ($connPost->query($sql) === TRUE) {
        #echo nl2br("\nSucessful Connection to User DataBase");
    }
     else {
        echo nl2br("\nError Connecting to/Creating Post Comments Table : " . $connPost->error);
    }
?>
