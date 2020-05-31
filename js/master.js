$(document).ready(function(){
  //$(document).on('click','.post-feed-view-button',function(){
  //  $.ajax({});
  //});
  darkMode();
  //normalMode();

});
function darkMode()
{
    //$(body).css("color", "white");
    //Meh:#ba7f7e;
    //TextInputBackground : #181a1b;
    //document.querySelector("div[unique='custom name'] ol").style.color = "blue";
    //document.querySelector("input").style.background = "grey";
    document.getElementById("leo-navbar").style.background= "black";
    document.getElementById("leo-navbar").style.color= "grey";
    //document.getElementById("head-content").style.background= "black";
    $("#head-content").css("background", "#050505");
    $(".new-post-form").css("background", "#343a40");
    $(".user-post-card").css("background", "#343a40");
    document.body.style.color = "#d1d1d1";
    document.body.style.backgroundColor = "#212121";
    $(".home-content").css("background-color", "#343a40");
    $(".post-feed").css("background-image", "linear-gradient(#12313b, #138e55)");
    $(".sticky").css("background-image", "linear-gradient(#12313b, #138e55)");
    $(".post-feed-card").css("background-color", "#1d1f20");
    $(".post-feed-card").css("color", "#d1d1d1");
    $(".post-feed-reactUp").css("background-color", "#181a1b");
    $(".post-feed-reactDown").css("background-color", "#181a1b");
    $(".detailed-post-page").css("background-image", "linear-gradient(#12313b, #138e55)");
    $(".detailed-post-card").css("background-color", "#1d1f20");
    $(".detailed-post-card").css("color", "#b5b5b5");
    $(".detailed-post-reactUp").css("background-color", "#181a1b");
    $(".detailed-post-reactDown").css("background-color", "#181a1b");
    $(".detailed-post-comment").css("background-color", "#181a1b");
    $(".detailed-post-share").css("background-color", "#181a1b");
    $(".new-comment-post-box").css("background-color", "grey");
    $(".comments-feed").css("background-color", "#1d1f20");
    $(".comments-feed").css("color", "#d1d1d1");
    $(".comment-head").css("background-color", "#1d1f20");
    $(".comment-content").css("background-color", "#1d1f20");
    $(".no-content").css("background-color", "#1d1f20");


}
function normalMode()
{
  document.getElementById("leo-navbar").style.color= "grey";
  document.getElementById("leo-navbar").style.background= "#343a40";
  $("#head-content").css("background", "linear-gradient(#eee ,skyblue)");
  $(".post-feed").css("background-image", "linear-gradient(skyblue, #47e69c)");
  $(".post-feed-card").css("background-color", "#eee");
  $(".post-feed-reactUp").css("background-color", "#eee");
  $(".post-feed-reactDown").css("background-color", "#eee");
}
