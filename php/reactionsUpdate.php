<?php
  include_once 'databasePost.php';
  //include_once 'databaseUser.php';
  session_start();
  if (isset($_SESSION["loggedUser"]))
  { $userName = $_SESSION["loggedUser"]; }
  else
  {
    exit (" <b>Oops ! </b> You Have to be <b>Logged In</b> to React to Posts !! [ You can Log In from the Navigation Bar at the Top of this Page ]");
  }

  $postId = $_POST['postId'];
  $reaction = $_POST['reaction'];
  //$buttonValue = $_POST['buttonValue'];
  if($_POST['reaction'] == 1)
  {
    $amount = +1;
    if($_POST['aStatus'] == 'on')
    { $amount = +2; }
  }
  elseif ($_POST['reaction'] == 2)
  {
    $amount = -1;
    if($_POST['aStatus'] == 'on')
    { $amount = -2; }
  }



  //Upped OR Downed
  if ($_POST['buttonValue']==0)
  {
    //echo "Making it Cool"; //echo "Making it Meh";
    $query = mysqli_query($connPost,"SELECT PostId FROM postReactions WHERE PostId='$postId' AND UserName='$userName' LIMIT 1");
    if ($query->fetch_array())
    {
      //User+PostId already Exists
      $query = "UPDATE postReactions SET Popularity=Popularity+'$amount',Reaction='$reaction' WHERE PostId='$postId' AND UserName='$userName'";
      if (mysqli_query($connPost,$query))
      {
        if (mysqli_query($connPost,"UPDATE userPosts SET Popularity=Popularity+'$amount' WHERE PostId='$postId'"))
        { echo "Success"; }
        else { echo "0.Update.0.Error: " . mysqli_error($connPost); }
      }
      else { echo "0.Update.1.Error: " . mysqli_error($connPost); }
    }
    else
    {
      //User+PostId DO not Exist
      $query = mysqli_query($connPost,"SELECT Popularity FROM userPosts WHERE PostId='$postId'");
      $popularity = $query->fetch_array();
      $popularity = $popularity['Popularity']+$amount;
      $query = "INSERT INTO postReactions (PostId,UserName,Reaction,Popularity) VALUES ('$postId','$userName','$reaction','$popularity')";
      if (mysqli_query($connPost,$query))
      {
        if (mysqli_query($connPost,"UPDATE userPosts SET Popularity=Popularity+'$amount' WHERE PostId='$postId'"))
        { echo "NewReaction"; }
        else { echo "0.Update.2.Error: " . mysqli_error($connPost); }
      }
      else { echo "0.Insert.0.Error: " . mysqli_error($connPost); }
    }
  }
  //UppedCanceled OR MehCancelled
  if ($_POST['buttonValue']==1)
  {
    $query = "UPDATE postReactions SET Reaction=0,Popularity=Popularity-'$amount'  WHERE PostId='$postId' AND UserName='$userName'";
    if (mysqli_query($connPost,$query))
    {
      if (mysqli_query($connPost,"UPDATE userPosts SET Popularity=Popularity-'$amount' WHERE PostId='$postId'"))
      { echo "Updated"; }
      else { echo "1.Update.0.Error: " . mysqli_error($connPost); }
    }
    else { echo "1.Update.1.Error : " . mysqli_error($connPost); }
  }

?>
