$(document).ready(function(){
    document.getElementById("leo-navbar").style.top = "0";
    $('.themeMsg').html("Toggle to Switch Theme");
    const themeCSS = document.getElementById('theme');
    const storedTheme = localStorage.getItem('theme');
    if(storedTheme){
        themeCSS.href = storedTheme;
        //console.log("Notice : Theme Toggled from LocalStorage Data");
    }
    $(document).on('click','.themeSwitch',function(){
      //console.log("Request : Toggle Theme");
      if(themeCSS.href.includes('normalMode*'))
      {
            themeCSS.href = 'css/themes/darkMode.css';
            //console.log("Notice : Theme Toggled To Dark Mode");
            $('.themeMsg').html("Toggle to Switch Theme");
      }
      else if (themeCSS.href.includes('darkMode'))
      {
            themeCSS.href = 'css/themes/normalMode.css';
            //console.log("Notice : Theme Toggled To Normal Mode");
            $('.themeMsg').html("Toggle to Switch Theme");
      }

      localStorage.setItem('theme',themeCSS.href);

    });


    $('.search-query-field').keypress(function(e){
        if(e.which == 13){
          //e.preventDefault(); //prevent page refresh on press "ENTER"
          $('.search-query-button').click();
        }
    });
    $(document).on('click','.search-query-button',function(){
      //console.log("Search Requested");
      document.body.style.overflow = "hidden";
      document.getElementById("leo-navbar").style.top = "0";
      var sQuery = $('.search-query-field').val();
      if (sQuery)
      {
        $.ajax({
            type:'GET',
            url:'../php/search.php',
            data: {sQuery: sQuery},
            success:function(html){
              if(html){
                document.getElementById("leo-navbar").style.top = "0";
                //console.log("Sucessful Search Req Performed");
                $(html).hide().appendTo(".head-content").fadeIn(300);
                }
              }
        });
      }
      else { //console.log("Empty Search Query");
      }
    });
    $(document).on('click','.closeSearchPageButton',function(){
      $('.searchPage').remove();
      document.body.style.overflow = "scroll";
    });



    $('.newPostContent').keypress(function(e){
        if(e.which == 13){
          //e.preventDefault(); //prevent page refresh on press "ENTER"
          //$('.new-post-submit-button').click();
        }
    });
    $(document).on('click','.new-post-submit-button',function(){
      //console.log("New Post Submit Req");
      var newPostTitle = $('.newPostTitle').val();
      var newPostContent = $('.newPostContent').val();
      if (newPostContent && newPostTitle)
      {
        console.log("Trying to Submit New Post ");
        $.ajax({
            type:'POST',
            url:'../php/newPost.php',
            data: {newPostTitle: newPostTitle, newPostContent:newPostContent},
            success:function(html){
              if(html){
                alert("Your Post\n  Title : "+newPostTitle+"\nis now Live :)");
                $('.newPostTitle').val("");
                $('.newPostContent').val("");
                $(html).hide().prependTo(".post-feed").fadeIn(1000);
                console.log("Sucessful Post Submission ");
                }
              }
        });

      }
      else { console.log("Empty New Post"); }
    });
});
