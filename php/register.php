<?php
  include_once 'databaseUser.php';
  // define variables and set to empty values
  $nameErr = $emailErr = $userNameErr = $genderErr = $passErr = $agreeCndErr = $message = "";
  $firstName = $lastName= $email = $userName= $gender = $password = $agreeCnd= "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"]) or empty($_POST["lastName"])) {
      $nameErr = "Full Name Required(Only Letters and White Spaces are Allowed)!!";
    } else {
      $firstName = userInput($_POST["firstName"]);
      $lastName = userInput($_POST["lastName"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$firstName) or !preg_match("/^[a-zA-Z ]*$/",$lastName)) {
        $nameErr = "Only Letters and White Spaces are Allowed in Name !!";
      }
    }
    if (empty($_POST["email"])) {
      $emailErr = "Email is Required !!";
    } else {
      $email = userInput($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid Email Format !!";
      }
      if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE Email = '$email'"))>0) {
         $emailErr = "Email Already Exists !! Try Logging In Instead";
      }
    }
    if (empty($_POST["userName"])) {
      $userName = $_POST["email"];
      $userNameErr = "Email Will be Used as UserName !!";
    } else {
      $userName = userInput($_POST["userName"]);
      if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM userDetails WHERE UserName = '$userName'"))>0) {
         $userNameErr = "UserName Already Exists !! Try Another One";
      }
    }

    if (empty($_POST["password"])) {
      $passErr ="Password is Required !!";
    } else {
      $password = userInput($_POST["password"]);
      $upper = preg_match('@[A-Z]@', $password);
      $lower = preg_match('@[a-z]@', $password);
      $num   = preg_match('@[0-9]@', $password);
      $specialChars = preg_match('@[^\w]@', $password);
      if(!$upper || !$lower || !$num || !$specialChars || strlen($password) < 6) {
          $passErr = "Password Should be at Least 6 Characters in Length, Should Include at Least one UpperCase & LowerCase Letter, One Number and One Special Character.";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is Required !!";
    } else {
      $gender = userInput($_POST["gender"]);
    }
    if (empty($_POST["agreeCnd"])) {
      $agreeCndErr = "You Should Check one of the Boxes !!";
    } else {
      $agreeCnd = userInput($_POST["agreeCnd"]);
      if ($agreeCnd == "disAgree")
      {
        $agreeCndErr = "You Should Agree on Our Terms and Conditions to Sign Up !!";
      }
      }
  }

  function userInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //$nameErr = $emailErr = $userNameErr = $genderErr = $passErr = $agreeCndErr = "";
  if (empty($nameErr) and empty($emailErr) and empty($userNameErr) and empty($genderErr) and empty($passErr) and empty($agreeCndErr))
   {
     #echo "All Cleared ##"
     if(isset($_POST['SubmitForm']))
     {
      $firstName = userInput($_POST['firstName']);
      $lastName = userInput($_POST['lastName']);
      $email = userInput($_POST['email']);
      $userName = userInput($_POST['userName']);
      $password = userInput(md5($_POST['password']));
      $gender = userInput($_POST['gender']);

      $sql = "INSERT INTO userDetails VALUES ('$firstName','$lastName','$email','$userName','$password','$gender')";
      if (mysqli_query($conn, $sql)) {
       $conn->close();
       header("Location: login.php");
       exit;
      } else {
       echo "Error: " . $sql . " " . mysqli_error($conn);
       $message= "Error: " . $sql . " " . mysqli_error($conn);
      }
     }
     #else {echo nl2br("\nDid Not Save in Table !!");}
   }
  else {echo nl2br("\n All Conditions Should be Met To Register !!");}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/8ad826539a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body class="reg-body">
    <div class="reg-content">
      <div class="reg-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <legend align='left'><h2>Registration Form</h2></legend>
          <h6 style="padding-top:2em;"><span class="error">*Required Fields</span></h6>
          <i class="fas fa-user" style='font-size:20px'></i>
          <input type="text" name="firstName" placeholder=" First Name" value="<?php echo $firstName;?>" required>
          <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lastName;?>" required>
          <span class="error"> * <br><?php echo $nameErr;?></span>
          <br>
          <i class="far fa-envelope" style='font-size:20px'></i>
          <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>" required>
          <span class="error"> * <?php echo $emailErr;?></span>
          <br><br>
          <i class='fas fa-user-tie' style='font-size:20px'></i>
          <input type="text" name="userName" placeholder="Username"value="<?php echo $userName;?>">
          <span class="error"><?php echo $userNameErr;?></span>
          <br><br>
          <i class='fas fa-key' style='font-size:20px'></i>
          <input type="password" name="password" placeholder="Password" value="<?php echo $password;?>" required>
          <span class="error"> * <?php echo $passErr;?></span>
          <br><br>
          <i class="fas fa-venus-mars" style='font-size:20px'></i>
          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "Checked";?> value="male">  Male
          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "Checked";?> value="female">  Female
          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "Checked";?> value="other">  Other
          <span class="error"> * <?php echo $genderErr;?></span>
          <br><br>
          Agree On <a href="terms.html">Our Terms and Conditions </a>:<br>
          <input type="radio" name="agreeCnd" <?php if (isset($agreeCnd) && $agreeCnd=="agree") echo "Checked";?> value="agree">  I Agree
          <input type="radio" name="agreeCnd" <?php if (isset($agreeCnd) && $agreeCnd=="disAgree") echo "Checked";?> value="disAgree">  I Disagree
          <span class="error"> * <?php echo $agreeCndErr;?></span>
          <br><br>
          <input style="background-color:#5e9cff;border-width: 1px;border-radius:8px;cursor: pointer;" type="submit" name="SubmitForm" value="Register">
        </form>
      </div>
      <div class="reg-image">
        <img class="reg-image-image" src="https://i.imgur.com/ssSIQHn.jpg" alt="sign-up-image"/>
        <p style="margin-top:1em;margin-left:5%;">  Already Registered ? <a href="login.php"> Login Here</a></p>
      </div>
   </div>
   <div class="msg-box">
     <span class="message"><br><?php echo $message;?></span>
   </div>
  </body>
</html>
