<?php
  include_once 'databaseUser.php';
  session_start();
  // define variables and set to empty values
  $userNameErr = $passErr = $message = "";
  $userName= $password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userName"])) {
      $userName = $_POST["email"];
      $userNameErr = "UserName Required for Logging In !!";
    }
    else {
      $userName = userInput($_POST["userName"]);
      if (!filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        #Its Username
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE UserName = '$userName'"))<1) {
           $userNameErr = "UserName Does Not Exist! Try to Register First !!";
        }
      }
      elseif(filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        #Its Email
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE Email = '$userName'"))<1) {
           $userNameErr = "Email Does Not Exist! Try to Register First !!";
        }
      }
    }

    if (empty($_POST["password"])) {
      $passErr ="Password is Required !!";
    } else {
      $password = userInput($_POST["password"]);
    }
  }
  function userInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //$nameErr = $emailErr = $userNameErr = $genderErr = $passErr = $agreeCndErr = "";
  if (empty($userNameErr) and empty($passErr))
   {
     #echo "All Cleared ##"
     extract($_POST);
     if(isset($submit))
     {
      $userName = userInput($_POST['userName']);
      $password = userInput(md5($_POST['password']));

      if (!filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        #Its Username
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE UserName='$userName' AND Password='$password'"))>0)
        {
          $_SESSION["loggedUser"]=$userName;
        }
        else { echo "UserName or Password is Wrong !! Try Again :( ";}
        }
      elseif(filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        #Its Email
        if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE Email='$userName' AND Password='$password'"))>0)
        {
          $_SESSION["loggedUser"]=$userName;
        }
        else { echo "Email or Password is Wrong !! Try Again :( ";}

      }
     }
     if (isset($_SESSION["loggedUser"]))
      {
      $conn->close();
      header("Location: ../index.php");
      exit;
      }
     #else {echo nl2br("\nDid Not Save in Table !!");}
   }
  else {
    echo nl2br("\n All Conditions Should be Met To LogIn !!");
  }?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/8ad826539a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body class="login-body">
    <div class="login-content">
      <div class="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <legend align='left'><h2>Login Form</h2></legend>
          <h6 style="padding-top:2em;"><span class="error">*Required Fields</span></h6>
          <i class='fas fa-user-tie' style='font-size:20px'></i>
          <input type="text" name="userName" placeholder="Username or Email" value="<?php echo $userName;?>" required>
          <span class="error"> * <?php echo $userNameErr;?></span>
          <br><br>
          <i class='fas fa-key' style='font-size:20px'></i>
          <input type="password" name="password" placeholder="Password" value="<?php echo $password;?>" required>
          <span class="error"> * <?php echo $passErr;?></span>
          <br><br>
          <input style="border-width: 1px;border-radius:8px;cursor: pointer;" type="submit" name="submit" value="LogIn">
        </form>
      </div>
      <div class="login-image">
        <img class="login-image-image" src="https://i.etsystatic.com/5711764/r/il/79946b/2260667525/il_794xN.2260667525_qhoc.jpg" alt="login-image"/>
        <p style="margin-top:1em;margin-left:5%;"> Not Registered Yet ? <a href="../php/register.php"> Register Here</a></p>
      </div>
    </div>
  </body>
</html>
