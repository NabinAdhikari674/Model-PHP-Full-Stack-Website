<?php
  session_start();
  include_once 'php/databaseUser.php';
  include_once 'php/databasePost.php';
  $postTitle = $postContent = $message = "";
  $message = "You Can Post Cards Now !!";
  if (isset($_SESSION["loggedUser"]))
  {
    $user = $_SESSION["loggedUser"];
    $sql = "SELECT UserName FROM userDetails WHERE Email = '$user' OR UserName='$user'";
    $userQuery = mysqli_query($conn,$sql);
    $userName = $userQuery->fetch_array();
    $userName = $userName['UserName'];
  }
  else {
    $userName = 'admin';
  }
  function userInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  extract($_POST);
  if(isset($_POST['submitPost']))
  {
   $postTitle = userInput($_POST["postTitle"]);
   $postContent = addslashes(userInput($_POST["postContent"]));
   $sql = "INSERT INTO userPosts (UserName,Title,Post) VALUES ('$userName','$postTitle','$postContent')";
   if (mysqli_query($connPost, $sql)) {
     $message = "The Post \"".$_POST["postTitle"]."\" Has Been Sucessfully Submitted !!";
     $postTitle = $postContent = "";
    }
    else {
     echo "Error: " . $sql . " " . mysqli_error($connPost);
    }
  }
  ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=800" />
    <script src="https://kit.fontawesome.com/8ad826539a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="stylesheet" type="text/css" href="css/sidebars.css">
    <link rel="stylesheet" type="text/css" href="css/postFeed.css">
    <link rel="stylesheet" type="text/css" href="css/detailedPost.css">
    <link id="theme" rel="stylesheet" type="text/css" href="css/themes/darkMode.css"/>
    <script type="text/javascript" src="js/master.js"></script>
    <script type="text/javascript" src="js/sidebars.js"></script>
    <script type="text/javascript" src="js/loadMorePosts.js"></script>
    <script type="text/javascript" src="js/reactions.js"></script>
    <script type="text/javascript" src="js/detailedPost.js"></script>
    <title>Home | LeoIndustries</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark leo-navbar" id="leo-navbar"style="position:fixed;width:100%;z-index:3;">
      <a class="navbar-brand" href="index.php">
        <h3 style="font-family:'StrokeyBacon';font-weight:normal;padding:0px;margin:0px;position:relative;"> LEO Industries </h3>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
          <form class="form-inline search-form" role="form" action="" onSubmit="return false;" >
            <div class="form-group has-success has-feedback">
              <label class="control-label" for="inputSuccess4"></label>
              <input type="text" class="form-control search-query-field" id="inputSuccess4" placeholder="Search" required>
              <span class="fas fa-search form-control-feedback search-query-button" style="cursor: pointer;"></span>
            </div>
          </form>
        </ul>

      </div>
    </nav>
      <script>
          var prevScrollpos = window.pageYOffset;
          window.onscroll = function() {
          var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
              document.getElementById("leo-navbar").style.top = "0";
            } else {
              document.getElementById("leo-navbar").style.top = "-50px";
            }
            prevScrollpos = currentScrollPos;
          }
      </script>

    <div class="head-content" id="head-content">
      <center style="padding-top:5em;padding-bottom:0em;">
         <h1> Welcome to Leo Industries </h1>
         <h3>
           <i class='fas fa-user-tie' style='font-size:23px;'></i>
           <span style="font-size:28px;">
             <?php
               if (isset($_SESSION["loggedUser"])) { echo $_SESSION["loggedUser"] . "<a style=\"font-size:15px; \" href=\"php/logout.php\"> Log Out </a>"; }
               else {
                 echo "<h5>Guest</h5>";
                 echo "<h6>Already Have an Account ? "."<a style=\"font-size:15px; \" href=\"php/login.php\"> Login Here </a></h6>";
                 echo "<h6>Not Yet Registered ? "."<a style=\"font-size:15px; \" href=\"php/register.php\"> Register Here </a></h6>";
               }
             ?>
            </span>
         </h3>
       </center>

      <hr width="100%">

      <div class="user-content">
        <?php
          if (isset($_SESSION['loggedUser']))
          {
            ?>
            <div id="carouselExampleControls" class="carousel slide leo-carousel"data-keyboard="false" data-interval="false">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="new-post-form" id="new-post-form">
                    <h6>Want to Post Something ?</h6><hr style="margin-top:0px;">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <p style="text-align:center;margin:0%;margin-bottom:-3%;">
                        <i class="fas fa-user-tie" style='font-size:18px;'></i> <?php echo $_SESSION["loggedUser"] ?>
                        <input type="text" name="postTitle" placeholder=" Title/Heading " required>
                      </p>
                      <br>
                      <input type="text" style="width:100%;margin-top: 0px;margin-bottom:2%;" name="postContent" placeholder=" Write Your Post Here ..." value="<?php echo userInput($postContent);?>"required>
                      <br>
                      <center>
                       <input class="new-post-submit-button" type="submit" name="submitPost" value="Post">
                       </center>
                   </form>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="user-posts">
                  <?php
                    $query = mysqli_query($connPost,"SELECT * FROM userPosts WHERE UserName='$userName' ORDER BY Popularity DESC");
                    while($card = $query->fetch_array())
                    {
                      ?><div class='user-post-card'>
                          <div class="user-post-card-title">
                            <?php echo $card['Title'];?>
                            <small><?php echo nl2br("  | Id : ".$card['PostId']);?></small>
                          </div> <hr style="margin:5px;margin-top:0px;">
                          <div class="user-post-text">&raquo; <?php echo $card['Post'];?> &laquo;</div>
                          <div class="user-post-popu"><small >⚡ <?php echo $card['Popularity'];?></small></div>
                          <button type="button" class="user-card-post-view" value="<?php echo $card['PostId'];?>">View Post</button>
                          <div class="user-post-upd"><small class="text-muted"> Updated At : <?php echo $card['UpdatedAt'];?></small></div>
                      </div><?php
                    }
                ?></div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <?php
          }
        ?>
      </div>



    </div>

    <div class="extra2" id="extra2" style="margin:1%;padding:1%;"></div>

    <div class="home-content" id="home-content">

          <div class="profile-sidebar" id="profile-sidebar">
            <div class="sticky">
              <p>Profile and More</p>
              <ul class="navbar-nav mr-auto nav-fill">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="php/session.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="php/register.php">Register</a>
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
            </div>
          </div>

          <div class="post-feed" id="post-feed">
              <?php
                $GLOBALS['lastPopu']=0;
                $_SESSION["postNumber"] = 0;
                $_SESSION["postList"] = array();
                $query = $connPost->prepare("SELECT * FROM userPosts ORDER BY Popularity DESC LIMIT ?,8");
                $query->bind_param("i",$_SESSION["postNumber"]);
                $query->execute();
                $result = $query->get_result();
                //$query = mysqli_query($connPost,"SELECT * FROM userPosts ORDER BY PostId ASC LIMIT $GLOBALS['postNumber'],8");
                while($card = $result->fetch_array())
                {
                  $_SESSION["postNumber"]+=1;
                  array_push($_SESSION["postList"],(int)$card['PostId']);
                  #UserName,Title,Post,Popularity,CreationAt,UpdatedAt
                  ?><div class='post-feed-card'>
                      <div class="post-feed-title">
                        <?php echo $card['Title'];?>
                        <small><?php echo nl2br("  | Id : ".$card['PostId']);?></small>
                      </div> <hr style="margin:5px;margin-top:3px;">
                      <div class="post-feed-text">&raquo; <?php echo $card['Post'];?> &laquo;</div>
                      <div class="post-feed-popu">
                        &#9889;
                        <span id="popu-counter-<?php echo $card['PostId'];?>"> <?php echo $card['Popularity'];?> </span>
                        <span id="popu-msg-<?php echo $card['PostId'];?>"></span>
                      </div>
                      <form method="post" class="post-feed-react">
                        <button type="button" class="post-feed-reactUp" id="post-feed-reactUp-<?php echo $card['PostId'];?>" value=0 >&#9650;Up</button>
                        <button type="button" class="post-feed-reactDown" id="post-feed-reactDown-<?php echo $card['PostId'];?>" value=0 >&#9660;Meh!</button>
                        <button type="button" name="viewPost" class="post-feed-view-button" id="post-feed-view-button-<?php echo $card['PostId'];?>">View Post</button>
                      </form>
                      <div class="post-upd"><small> Updated At : <?php echo $card['UpdatedAt'];?></small></div>
                  </div><?php
                  $GLOBALS['lastPopu'] = $card['Popularity'];
                }
            ?>
            <script type="text/javascript" language="JavaScript">updateReactions();</script>
           </div>

         <div class="setting-sidebar" id="setting-sidebar">
           <div class="sticky">
             <p>Settings and More</p>
             <ul class="navbar-nav mr-auto nav-fill">
               <li class="nav-item active">
                 <label class="colorModeSwitch">
                    <input type="checkbox" class="themeSwitch">
                    <span class="slider round"></span>
                    <span id="themeID"></span>
                  </label>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="php/session.php">Login</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="php/register.php">Register</a>
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
           </div>
         </div>
     </div>

     <div class="load-more" id="load-more<?php echo $_SESSION["postNumber"];?>">
        <span class="load-more-button" id="<?php echo $_SESSION["postNumber"];?>" title="Click to Show More Post Feeds">Load More Posts ?</span>
        <span class="loading-button" id="<?php echo $GLOBALS['lastPopu'] ?>" style="display:none;">Loading ... </span>
        <span class="load-complete" style="display:none;" title="You Finished All Post Feed Reads :) ">Looks Like You are all Caught Up :) !! </span>
      </div>

















      <div class="extra1" id="extra1" style="margin:1%;padding:1%;"></div>

      <div class="extra" style="margin:1%;padding:1%;">
        <h5 style="background-color:#343a40;margin:1%;">Some Popular Posts : </h5>
        <center><table>
          <tr>
            <th>Username</th>
            <th>Title</th>
            <th>Post</th>
            <th>Popularity</th>
            <th>Creation Date</th>
            <th>Last Updated</th>
          <?php
            $query = mysqli_query($connPost,"SELECT * FROM userPosts ORDER BY Popularity DESC");
            while($row = $query->fetch_array())
            {
              echo "<tr>";
              echo "<td>".$row['UserName']  ."</td>";
              echo "<td>".$row['Title']     ."</td>";
              echo "<td>".$row['Post'] ."</td>";
              echo "<td>".$row['Popularity']  ."</td>";
              echo "<td>".$row['CreationAt']  ."</td>";
              echo "<td>".$row['UpdatedAt']  ."</td>";
              echo "</tr>";
            }
        ?>
      </table></center>
      </div>


  </body>
</html>
