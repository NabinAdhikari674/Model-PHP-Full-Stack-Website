<?php
    include 'databasePost.php';
    session_start();
    // Count all records except already displayed
    $query = $connPost->prepare("SELECT * FROM userPosts ORDER BY Popularity DESC LIMIT ?,8");
    $query->bind_param("i",$_POST["postNumber"]);
    $query->execute();
    $result = $query->get_result();
    $number=0;
    $_SESSION["postList"] = array();
    //$query = mysqli_query($connPost,"SELECT * FROM userPosts ORDER BY PostId ASC LIMIT $GLOBALS['postNumber'],8");
    while($card = $result->fetch_array())
    {
      $_POST["postNumber"]+=1;
      $number+=1;
      array_push($_SESSION["postList"],(int)$card['PostId']);
      #UserName,Title,Post,Popularity,CreationAt,UpdatedAt
      ?><div class='post-feed-card'>
          <div class="post-feed-title">
            <?php echo $card['Title'];?>
            <small style="color:grey;"><?php echo nl2br("  | Id : ".$card['PostId']);?></small>
          </div> <hr style="margin:5px;margin-top:3px;">
          <div class="post-feed-text">&raquo; <?php echo $card['Post'];?> &laquo;</div>
          <div class="post-feed-popu">
            <small > &#9889;
              <span id="popu-counter-<?php echo $card['PostId'];?>"> <?php echo $card['Popularity'];?> </span>
              <span id="popu-msg-<?php echo $card['PostId'];?>"></span>
            </small>
          </div>
          <form method="post" class="post-feed-react">
            <button type="button" class="post-feed-reactUp" id="post-feed-reactUp-<?php echo $card['PostId'];?>" value=0 >&#9650;Up</button>
            <button type="button" class="post-feed-reactDown" id="post-feed-reactDown-<?php echo $card['PostId'];?>" value=0 >&#9660;Meh!</button>
            <button type="button" name="viewPost" class="post-feed-view-button" id="post-feed-view-button-<?php echo $card['PostId'];?>">View Post</button>
          </form>
          <div class="post-upd"><small style="color:grey;"> Updated At : <?php echo $card['UpdatedAt'];?></small></div>
      </div><?php
      $_POST['lastPopu'] = $card['Popularity'];
    }
    if ($number==8){
    ?>
    <div class="load-more" id="load-more<?php echo $_POST['postNumber'] ?>">
      <span class="load-more-button"  id="<?php echo $_POST['postNumber']; ?>" title="Click to Show More Post Feeds">Load More Posts ?</span>
      <span class="loading-button" id="<?php echo $_POST['lastPopu']; ?>" style="display:none;">Loading ... </span>
    </div>
  <?php }
  else
  { ?>
    <div class="load-more" id="load-complete-div">
      <span class="load-more-button"  id="<?php echo $_POST['postNumber']; ?>"  style="display:none;">Load More Posts ?</span>
      <span class="load-complete"  id="<?php echo $_POST['postNumber']; ?>" title="You Finished All Post Feed Reads :) ">Looks Like You are all Caught Up :) !!</span>
    </div>

    <?php
  }
?>
