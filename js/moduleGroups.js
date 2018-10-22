var groupConstants = {
  count: 10,
  postsCompleteFlag: false,
  clear: function() {
    groupConstants.count = 10;
    groupConstants.postsCompleteFlag = false;
  }
};

var MESSAGES = {
  postsCompleteMsg: "There are no more posts to view"
};

var modGroup = {};

modGroup.getMorePosts = function() {
  if (groupConstants.postsCompleteFlag) {
    $("#loadMoreBtn").text(MESSAGES.postsCompleteMsg);
  }
  console.log("fetching more posts");
  for (var i = 0; i < 10; i++) {
    $("#posts_pane").append('<div class="post"> \
            <div class="post_header")"> \
              <p><b>Posted by </b><br> Time <br> Tags \
              </p> \
            </div> \
            <img src="images/giphy9.gif"></img> \
          </div>');
  }
};

modGroup.addCurrentPost = function(data) {
  console.log(data);
  console.log("adding current post");
  var htmlcontent = modGroup.generatePostContent(data);

  if (htmlcontent) {
    $("#posts_pane").prepend(htmlcontent);
  }
};

modGroup.callJavascipt = function(data) {
  console.log(data);
};
// document.getElementById("myTextarea").value


modGroup.generatePostContent = function(data) {
  switch (data.type) {
    case "pdf":
      return modGroup.generatePdfPost(data);
      break;
    case "text":
      return modGroup.generateTextPost(data);
      break;
    case "jpg":
    case "jpeg":
    case "png":
    case "gif":
      return modGroup.generateImagePost(data);
      break;
    default:
  }
};

modGroup.generatePdfPost = function(data) {
  console.log("modGroup.generatePdfPost with data -->" + JSON.stringify(data));
  var htmlstring = ""
  return htmlstring;
};

modGroup.generateTextPost = function(data) {
  console.log("modGroup.generateTextPost with data -->" + JSON.stringify(data));
  var htmlstring = ""
  htmlstring += '<div class="post"> \
            <div class="post_header"> \
              <p><b>' + data.username + '</b><br>' + data.created_at + '<br>' + data.tags + '</p></div > \
    <div class="post_content"> \
      <p>' + data.content + '</p> \
    </div> \
  </div>';
  console.log(htmlstring);
  return htmlstring;
};

modGroup.generateImagePost = function(data) {
  console.log("modGroup.generateImagePost with data -->" + JSON.stringify(data));
  var htmlstring = ""

  htmlstring += '<div class="post"> \
            <div class="post_header"> \
              <p><b>' + data.username + '</b><br>' + 'Created: ' + data.created_at + '<br>' + data.tags + '</p></div > \
              <img src = "images/giphy9.gif"> </img></div > ';

  return htmlstring;
};