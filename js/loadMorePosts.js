$(document).ready(function(){
    $(document).on('click','.load-more-button',function(){
        var ID = $(this).attr('id');
        var pid = parseInt(ID)+8;
        var Popu = $(".loading-button").attr('id');
        $('.load-more-button').hide();
        $('.loading-button').show();
        $.ajax({
            type:'POST',
            url:'../php/loadMorePosts.php',
            data: {postNumber: ID, lastPopu:Popu},
            success:function(html){
              if(html){
                //$('#load-more'+ID).remove();
                //alert("AJAX request successfully completed");
                //$('.post-feed').append(html);
                $(html).hide().appendTo(".post-feed").fadeIn(1000);
                updateReactions();
                if ($('#load-more'+pid).length)
                {
                  //var lastPopu= $('.loading-button').attr('id');
                  $('#load-more'+pid).remove();
                  $(".load-more-button").prop('id',pid);
                  $(".load-more").prop('id','load-more'+pid);
                  $('.loading-button').hide();
                  $('.load-more-button').show();
                }
                else if ($('#load-complete-div').length)
                {
                  $('#load-complete-div').remove();
                  $('.loading-button').hide();
                  $('.load-more-button').hide();
                  $('.load-complete').show();
                  //$(".load-more-button").prop('id',pid);
                }
                }

              }
                //$("#load-more"+ID+8).detach().appendTo("#post-feed");
        });
    });
});
