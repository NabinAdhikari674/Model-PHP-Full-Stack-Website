$(document).ready(function(){
    $(document).on('click','.post-feed-reactUp',function(){
        var ID = $(this).attr('id');
        var buttonValue = $(this).attr('value');
        var postId = ID.substring(ID.lastIndexOf("-") + 1, ID.length);
        var reactDownStatus = $('#post-feed-reactDown-'+postId).attr('value');
        if (reactDownStatus==1)
        { aStatus='on';}
        else if (reactDownStatus==0)
        { aStatus='off';}

        $.ajax({
            type:'POST',
            url:'../php/reactionsUpdate.php',
            data: {postId:postId,reaction:1,buttonValue:buttonValue,aStatus:aStatus},
            success:function(response){
              if(response=='Success')
              {
                $('#'+ID).css("color", "blue");
                $('#post-feed-reactUp-'+postId).val(1);
                $('#post-feed-reactDown-'+postId).css("color", "grey");
                $('#post-feed-reactDown-'+postId).val(0);
                console.log("| PostID:"+postId+" Upped |");
                updatePopPanel(postId,buttonValue,aStatus,'up');

              }
              else if (response=='Updated')
              {
                $('#'+ID).css("color", "grey");
                $('#post-feed-reactUp-'+postId).val(0);
                console.log("| PostID:"+postId+" UpRetracted |");
                updatePopPanel(postId,buttonValue,aStatus,'up');
              }
              else if(response=='NewReaction')
              {
                $('#'+ID).css("color", "blue");
                $('#post-feed-reactUp-'+postId).val(1);
                $('#post-feed-reactDown-'+postId).css("color", "grey");
                $('#post-feed-reactDown-'+postId).val(0);
                console.log("| *PostID:"+postId+" Upped |");
                updatePopPanel(postId,buttonValue,aStatus,'up');
              }
              else
              { console.log(response); }
            }
        });
    });

    $(document).on('click','.post-feed-reactDown',function(){
        var ID = $(this).attr('id');
        var buttonValue = $(this).attr('value');
        var postId = ID.substring(ID.lastIndexOf("-") + 1, ID.length);
        var reactUpStatus = $('#post-feed-reactUp-'+postId).attr('value');
        if (reactUpStatus==1)
        { aStatus='on';}
        else if (reactUpStatus==0)
        { aStatus='off';}

        $.ajax({
            type:'POST',
            url:'../php/reactionsUpdate.php',
            data: {postId:postId,reaction:2,buttonValue:buttonValue,aStatus:aStatus},
            success:function(response){
              if(response=='Success')
              {
                $('#'+ID).css("color", "#e8807d");
                $('#post-feed-reactDown-'+postId).val(1);
                $('#post-feed-reactUp-'+postId).css("color", "grey");
                $('#post-feed-reactUp-'+postId).val(0);
                console.log("| PostID:"+postId+" Meh-ed |");
                updatePopPanel(postId,buttonValue,aStatus,'down');
              }
              else if (response=='Updated')
              {
                $('#'+ID).css("color", "grey");
                $('#post-feed-reactDown-'+postId).val(0);
                console.log("| PostID:"+postId+" MehRetracted |");
                updatePopPanel(postId,buttonValue,aStatus,'down');
              }
              else if(response=='NewReaction')
              {
                $('#'+ID).css("color", "#983a37");
                $('#post-feed-reactDown-'+postId).val(1);
                $('#post-feed-reactUp-'+postId).css("color", "grey");
                $('#post-feed-reactUp-'+postId).val(0);
                console.log("| *PostID:"+postId+" Meh-ed |");
                updatePopPanel(postId,buttonValue,aStatus,'down');
              }
              else
              { console.log(response); }
            }
        });
    });

});

function updateReactions()
{
  $.ajax({
      type:'POST',
      url:'../php/reactionsCheck.php',
      data: {activity:'updateReactions'},
      success:function(response){
        if(response){
          var data = JSON.parse(response);
          $.each(data.reactionList, function( index, value )
          {
            if(value==0)
            {
              $('#post-feed-reactUp-'+data.postList[index]).val(0);
              $('#popu-msg-'+data.postList[index]).html("~ React to this Post &#8628;");
            }
            if(value==1)
            {
              $('#post-feed-reactUp-'+data.postList[index]).val(1);
              $('#popu-msg-'+data.postList[index]).html("+You Upped !!");
              $('#post-feed-reactUp-'+data.postList[index]).css("color","blue");
            }
            if(value==2)
            {
              //alert('#post-feed-reactUp'+data.postList[index]);
              $('#post-feed-reactDown-'+data.postList[index]).val(1);
              $('#popu-msg-'+data.postList[index]).html("-You Meh-ed !!");
              $('#post-feed-reactDown-'+data.postList[index]).css("color","#e8807d");
            }

          });
        }
        else {
          console.log(" Update Reaction Request to updateReactions.php ERROR");
        }
          //$("#load-more"+ID+8).detach().appendTo("#post-feed");
      }
   });
   //$('load-more').parentNode.removeChild('load-more');
};

function updatePostReaction()
{

}

function updatePopPanel(postId,status,aStatus,flow)
{
  var counter = parseInt($("#popu-counter-"+postId).html());

  if(flow=='up')
  {if(status==0)
    {if(aStatus=='off')
      {
        counter+=1;
        $("#popu-counter-"+postId).html(counter);
        $("#popu-msg-"+postId).html("+You Upped !!");
      }
     else if (aStatus=='on')
      {
        counter+=2;
        $("#popu-counter-"+postId).html(counter);
        $("#popu-msg-"+postId).html("+You Upped !!");
      }
    }
   else if (status==1)
    {if (aStatus=='off')
      counter-=1;
      $("#popu-counter-"+postId).html(counter);
      $("#popu-msg-"+postId).html("~ You Retracted Up !");
     }
  }

  else if(flow=='down')
  {if(status==0)
    {if(aStatus=='off')
      {
        counter-=1;
        $("#popu-counter-"+postId).html(counter);
        $("#popu-msg-"+postId).html("-You Meh-ed !!");
      }
     else if (aStatus=='on')
      {
        counter-=2;
        $("#popu-counter-"+postId).html(counter);
        $("#popu-msg-"+postId).html("-You Meh-ed !!");
      }
    }
   else if (status==1)
    {if (aStatus=='off')
      counter+=1;
      $("#popu-counter-"+postId).html(counter);
      $("#popu-msg-"+postId).html("~ You Retracted Meh !");
     }
  }

}
