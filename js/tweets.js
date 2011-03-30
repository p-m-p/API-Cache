$(function () {

  var showTweets = function (res) {
    if (res && "results" in res) {
      var $tweets = $("#tweets");
      $tweets.empty();
      $.each(res.results, function (i, tw) {
        var $li = $(document.createElement("li"))
          , $cite = $(document.createElement("cite"))
          , $p = $(document.createElement("p"))
          , img = new Image ();
        $cite.text("@" + tw.from_user);
        $p.text(tw.text);
        img.src = tw.profile_image_url;
        img.width = img.height = 40;
        $li
          .append(img)
          .append($cite)
          .append($p)
          .appendTo($tweets);
      });
    }
  }

  $.getJSON("widgets.php", showTweets);
 

});
