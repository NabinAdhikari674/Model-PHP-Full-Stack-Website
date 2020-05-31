<?php
  include_once 'databasePost.php';
  //include_once 'databaseUser.php';
  session_start();
  $userName = $_SESSION["loggedUser"];

  if($_POST['activity']=='updateReactions')
  {
    $postList = (array)$_SESSION["postList"];
    $reactionList = array();
    foreach ($_SESSION["postList"] as $postId)
    {
      $query = mysqli_query($connPost,"SELECT Reaction FROM postReactions WHERE UserName='$userName' AND PostId='$postId'");
      $reaction = $query->fetch_array();
      if($reaction)
      { array_push($reactionList,$reaction['Reaction']); }
      else
      { array_push($reactionList,0); }
    }
    //echo "".implode(',',$postList)."=>";
    //echo "".implode(',',$reactionList)."";
    $data = array();
    $data['postList'] = $postList;
    $data['reactionList'] = $reactionList;
    echo json_encode($data);
  }
?>
