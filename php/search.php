<?php
  include_once 'databasePost.php';
  $sQuery = $_GET["sQuery"];
  $sQuery = "%".$sQuery."%";
  $nResults = 0;
  //SELECT * FROM [table name] WHERE name like "Bob%" AND phone_number = '3444444';
  $query = $connPost->prepare("SELECT * FROM userPosts WHERE Title Like ? ORDER BY Popularity DESC");
  $query->bind_param("s",$sQuery);
  $query->execute();
  $result = $query->get_result();
  ?>
  <div class='searchPage'>
    <button class="closeSearchPageButton"> &times; </button>
    <button class="closeSearchPageButton"> &#9881; </button>
    <?php
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI'];
    echo "    Link to this Post : ".$link;
    while($card = $result->fetch_array())
    {
      $nResults+=1;
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
    }
    ?>
    <div style="margin-bottom: 10em;">
      <div class="no-content">
        <center> End Of Search Results [ <?php echo "Total Results : ".$nResults."  || PHP Version : ".phpversion(); ?> ] </center>
      </div>
    </div>
    </div>

    <?php
?>
