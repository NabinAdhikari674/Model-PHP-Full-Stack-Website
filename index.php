<?php
  session_start();
  include_once 'database.php';
 ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8ad826539a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="master.css">
    <title>Home | LeoIndustries</title>
  </head>
  <body style="background-color:#e6eeff;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">LeoIndustries</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-fill">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="session.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Services
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Web Development</a>
              <a class="dropdown-item" href="#">Machine Learning</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Game Development</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Help</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <center style="padding-top:2em;padding-bottom:0em;"><h1> Welcome to Leo Industries </h1></center>
    <center>
      <h3>
        <i class='fas fa-user-tie' style='font-size:23px;'></i>
        <span style="font-size:28px;">
          <?php
            if (isset($_SESSION["loggedUser"])) { echo $_SESSION["loggedUser"] . "<a style=\"font-size:15px; \" href=\"logout.php\"> Log Out </a>"; }
            else {
              echo "<h5>Guest</h5>";
              echo "<h6>Already Have an Account ? "."<a style=\"font-size:15px; \" href=\"login.php\"> Login Here </a></h6>";
            }
          ?>
         </span>
      </h3>
    </center>

  </body>
</html>
