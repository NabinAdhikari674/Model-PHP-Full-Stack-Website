<?php
  session_start();
  //include_once 'php/databaseUser.php';
  include_once 'databasePost.php';

  function userInput($data) {
    //$data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function siteOutput($data){
    $data = stripslashes($data);
    return $data;
  }
   $postTitle = userInput($_POST["newPostTitle"]);
   $postContent = userInput($_POST["newPostContent"]);
   $userName = $_SESSION["loggedUser"];

   $query = $connPost->prepare("INSERT INTO userPosts (UserName,Title,Post) VALUES (?,?,?)");
   $query->bind_param("sss",$userName,$postTitle,$postContent);
   if ($query->execute())
   {
     $postId = (int)$connPost->insert_id;
     ?><div class='post-feed-card'>
         <div class="post-feed-title">
           <?php echo siteOutput($postTitle);?>
           <small style="color:grey;"><?php echo nl2br("  | Id : ".$postId);?></small>
         </div> <hr style="margin:5px;margin-top:3px;">
         <div class="post-feed-text">&raquo; <?php echo siteOutput($postContent);?> &laquo;</div>
         <div class="post-feed-popu">
           <small > &#9889;
             <span id="popu-counter-<?php echo $postId;?>"> 0 </span>
             <span id="popu-msg-<?php echo $postId;?>">~ React to this Post &#8628;</span>
           </small>
         </div>
         <form method="post" class="post-feed-react">
           <button type="button" class="post-feed-reactUp" id="post-feed-reactUp-<?php echo $postId;?>" value=0 >&#9650;Up</button>
           <button type="button" class="post-feed-reactDown" id="post-feed-reactDown-<?php echo $postId;?>" value=0 >&#9660;Meh!</button>
           <button type="button" name="viewPost" class="post-feed-view-button" id="post-feed-view-button-<?php echo $postId;?>">View Post</button>
         </form>
         <div class="post-upd"><small style="color:grey;"> Updated At : Just Now </small></div>
     </div><?php

   }
   else { echo "Error: " . mysqli_error($connPost); }
?>
