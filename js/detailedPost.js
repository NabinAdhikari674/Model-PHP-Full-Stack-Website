$(document).ready(function(){
    $(document).on('click','.post-feed-view-button',function(){
        var ID = $(this).attr('id');
        var postId = ID.substring(ID.lastIndexOf("-") + 1, ID.length);
        //console.log("PostID : "+ID+" View");
        document.body.style.overflow = "hidden";
        document.getElementById("leo-navbar").style.top = "0";
        //$('.load-more-button').hide();
        $.ajax({
            type:'GET',
            url:'../php/detailedPost.php',
            data: {postId: postId},
            success:function(html){
              if(html){
                //$('#load-more'+ID).remove();
                //alert("AJAX request successfully completed");
                //$('.home-content').append(html);
                document.getElementById("leo-navbar").style.top = "0";
                $(html).hide().appendTo(".head-content").fadeIn(300);
                }

              }
        });
    });
    $(document).on('click','.post-a-new-comment',function(){
        //alert("Posting a New Comment");
        var ID = $(this).attr('id');
        var postId = ID.substring(ID.lastIndexOf("-") + 1, ID.length);
        var comment = $("#newCommentPost-"+postId).val();
        if (comment)
        {$.ajax({
            type:'POST',
            url:'../php/postNewComment.php',
            data: {postId: postId,comment:comment},
            success:function(html){
              if(html)
              {
                $(html).hide().prependTo(".comments-feed").fadeIn(1000);
                $('.new-comment-post-box').hide();
                $("#newCommentPost-"+postId).val("");
                //$('.alert-user-cmt-div').show();
                //$('.alert-user-on-cmt').append(" Connection Sucessful ! ");
                //$("Comment Posted !!").hide().appendTo(".alert-user-on-cmt").fadeIn(1000);
                //comments-feed
                //$(html).hide().prependTo(".comments-feed").fadeIn(1000);
              }
                else
                {
                 alert("Could not Post The Comment :( Try Again !!");
                }

              }
            });}
        else
        {
            alert("Comment Cannot Be Empty !!");
        }

    });
    $(document).on('click','.close-detailed-post-button',function(){
      $('.detailed-post-page').remove();
      document.body.style.overflow = "scroll";
    });
    $(document).on('click','.detailed-post-comment',function(){
      $('.new-comment-post-box').show();
    });
    $(document).on('click','.close-comment-post-button',function(){
      $('.new-comment-post-box').hide();
    });
});
