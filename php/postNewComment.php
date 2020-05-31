<?php
  session_start();
  include_once 'databasePost.php';
  //echo $_POST['postId']." : ".$_POST['comment'];
  $postId = $_POST['postId'];
  $comment = $_POST['comment'];

  function userInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_SESSION['loggedUser']))
  {
    $userName = $_SESSION['loggedUser'];
    $comment = addslashes(userInput($comment));

    $sql = "INSERT INTO postComments (PostId,ParentId,UserName,Comment) VALUES ('$postId',0,'$userName','$comment')";
    if (mysqli_query($connPost, $sql)) {
      ?>
      <div class="comment-box">
        <div class="user-avatar"> <i class='fas fa-user-tie' style='font-size:23px;'></i> </div>
        <div class="comment-head">
          <span class="comment-author"><a href="#"><?php echo $userName; ?></a></span>
          <span class="user-tag">User Tag</span>
          <span class="last-updated">Updated At : <?php echo "Just Now"; ?></span>
          <span class="comment-react">
            <i class="fa fa-heart comment-heart"> Like</i>
            <i class="fa fa-reply comment-reply"> Reply</i>
           </span>
        </div>
        <div class="comment-content"> <?php echo $comment; ?> </div>
      </div>
      <?php
     }
     else {
      echo " Error: " . $sql . " " . mysqli_error($connPost);
     }
  }
  else {
    echo "<script>alert(\" You Have to be LoggedIn to Post Comments. You can LogIn/Register from HomePage.\");</script>";
    //echo json_encode($msg,$postURL);
  }

?>
