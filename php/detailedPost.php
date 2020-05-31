<?php
  session_start();
  include_once 'databasePost.php';
  $postId = $_GET['postId'];
  if ($_SESSION['loggedUser']) { $loggedUser = $_SESSION['loggedUser']; }
  else { $loggedUser = 'Guest'; }

  $query = mysqli_query($connPost,"SELECT * FROM userPosts WHERE PostId='$postId'");
  while ($card = $query->fetch_array())
  {
    ?>
    <div class='detailed-post-page'>
        <button class="close-detailed-post-button"> &times; </button>
        <button class="close-detailed-post-button"> &#9881; </button>
        <?php
        //$link = "://";//$link .= $_SERVER['HTTP_HOST'];//$link .= $_SERVER['REQUEST_URI'];
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI'];
        echo "    Link to this Post : ".$link;
        ?>

        <div class='detailed-post-card'>
            <div class="detailed-post-title">
              <?php echo $card['Title'];?>
              <small style="color:grey;"><?php echo nl2br("  | Id : ".$card['PostId']);?></small>
              <span class="comment-author"><a href="#"> <?php echo $card['UserName']; ?> </a></span>
            </div> <hr style="margin:5px;margin-top:3px;">
            <div class="detailed-post-text">&raquo; <?php echo $card['Post'];?> &laquo;</div>
            <div class="detailed-post-popu">
             &#9889;
             <span id="popu-counter-<?php echo $card['PostId'];?>"> <?php echo $card['Popularity'];?> </span>
             <span id="popu-msg-<?php echo $card['PostId'];?>"></span> ~ React or Comment to this Post &#8628;
            </div>
            <form method="post" class="detailed-post-react">
              <button type="button" class="detailed-post-reactUp" id="post-feed-reactUp-<?php echo $card['PostId'];?>" value=0 >&#9650;Up</button>
              <button type="button" class="detailed-post-reactDown" id="post-feed-reactDown-<?php echo $card['PostId'];?>" value=0 >&#9660;Meh!</button>
              <button type="button" class="detailed-post-comment" id="post-feed-reactDown-<?php echo $card['PostId'];?>" >
                <i class="fas fa-comment-alt" style="font-size:15px;"></i> Comment
              </button>
              <button type="button" class="detailed-post-share" id="post-feed-reactDown-<?php echo $card['PostId'];?>" >
                <i class="fas fa-share-alt-square" style="font-size:17px;"></i> Share
              </button>
            </form>
            <div class="detailed-post-upd"><small class="text-muted"> Updated At : <?php echo $card['UpdatedAt'];?></small></div>
        </div>

        <div class="new-comment-post-box" id="new-comment-post-box-<?php echo $link;?>">
          <small>Commenting as : <?php echo $loggedUser; ?></small>
          <span class="close-comment-post-button"> &times; </span>
          <form method="post" class="new-comment-post-form">
            <textarea name="newCommentPost" id ="newCommentPost-<?php echo $postId;?>" placeholder=" What are your thoughts ?" required="required"></textarea>
            <button type="button" class="post-a-new-comment" id="post-a-new-comment-<?php echo $postId;?>" >
              <i class="fas fa-comment-alt" style="font-size:15px;"></i> Comment
            </button>
          </form>
          <div class="alert-user-cmt-div" style="display:none;">
            <span class="closebtn-alert" onclick="this.parentElement.style.display='none';"> &times;</span>
            <div class="alert-user-on-cmt"></div>
          </div>

        </div>

        <div class="comments-feed" id="comments-feed">
          <?php
            $query = mysqli_query($connPost,"SELECT * FROM postComments WHERE PostId='$postId'");
            $cmtNum = 0;

            while ($data = $query->fetch_array())
            {
              $cmtNum +=1;
            ?>
            <div class="comment-box">
              <div class="user-avatar"> <i class='fas fa-user-tie' style='font-size:23px;'></i> </div>
              <div class="comment-head">
                <span class="comment-author"><a href="#"><?php echo $data['UserName']; ?></a></span>
                <span class="user-tag">User Tag</span>
                <span class="last-updated">Updated At : <?php echo $data['UpdatedAt']; ?></span>
                <span class="comment-react">
                  <i class="fa fa-heart comment-heart"> Like</i>
                  <i class="fa fa-reply comment-reply"> Reply</i>
                 </span>
              </div>
              <div class="comment-content"> <?php echo $data['Comment']; ?> </div>
            </div><?php
            }
           if ( $cmtNum == 0)
           {
             echo "<div class=\"no-content\"><center> Be First To Comment On this Post !! </center></div>";
           }?>
        </div>

    </div>
    <?php
  }
?>
