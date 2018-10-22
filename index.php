<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PrepInterview</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/hover.css">
  <!-- <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="topnav sticky-top" id="myTopnav">
    <a href="index.php" class="active">Home</a>
    <a href="populateTopicNames.php">Topics</a>
    <a href="groups.php">Groups</a>
    <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
        <i class="fa fa-bars"></i>
      </a>
    <div class="topnav-right">
      <?php
      if (isset($_SESSION["user_id"])) {
          echo '<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
      } else {
          echo '<a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a>';
      }
       ?>
      <!-- <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
      <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a> -->
    </div>
  </div>
  <!--     <script type="text/javascript">
      function navigationMenu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
    x.className += " responsive";
    } else {
    x.className = "topnav";
    }
    }
    </script> -->
  <div class="container">
    <div class="split left">
      <h1>A huge collection of topics</h1>
      <h1 class="hid">A huge collection</h1>
      <h1 class="hid2">of Topics</h1>
      <main class="hexagon-container">
        <div class="hexagon color-angular" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-angular-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-angular-icon">Angular icon</title><path d="M9.93 12.645h4.134L11.996 7.74"/><path d="M11.996.009L.686 3.988l1.725 14.76 9.585 5.243 9.588-5.238L23.308 3.99 11.996.01zm7.058 18.297h-2.636l-1.42-3.501H8.995l-1.42 3.501H4.937l7.06-15.648 7.057 15.648z"/></svg>
        </div>
        <div class="hexagon color-html" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-html5-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-html5-icon">HTML5 icon</title><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/></svg>
        </div>
        <div class="hexagon color-git" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-git-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-git-icon">Git icon</title><path d="M23.546 10.93L13.067.452c-.604-.603-1.582-.603-2.188 0L8.708 2.627l2.76 2.76c.645-.215 1.379-.07 1.889.441.516.515.658 1.258.438 1.9l2.658 2.66c.645-.223 1.387-.078 1.9.435.721.72.721 1.884 0 2.604-.719.719-1.881.719-2.6 0-.539-.541-.674-1.337-.404-1.996L12.86 8.955v6.525c.176.086.342.203.488.348.713.721.713 1.883 0 2.6-.719.721-1.889.721-2.609 0-.719-.719-.719-1.879 0-2.598.182-.18.387-.316.605-.406V8.835c-.217-.091-.424-.222-.6-.401-.545-.545-.676-1.342-.396-2.009L7.636 3.7.45 10.881c-.6.605-.6 1.584 0 2.189l10.48 10.477c.604.604 1.582.604 2.186 0l10.43-10.43c.605-.603.605-1.582 0-2.187"/></svg>
        </div>
        <div class="hexagon color-vuejs" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-vuejs-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-vuejs-icon">Vue.js icon</title><path d="M19.197 1.608l.003-.006h-4.425L12 6.4v.002l-2.772-4.8H4.803v.005H0l12 20.786L24 1.608"/></svg>
        </div>
        <div class="hexagon color-javascript" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-javascript-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-javascript-icon">JavaScript icon</title><path d="M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.205.24 1.17-.87 1.545-1.966 1.41-.811-.18-1.26-.586-1.755-1.336l-1.83 1.051c.21.48.45.689.81 1.109 1.74 1.756 6.09 1.666 6.871-1.004.029-.09.24-.705.074-1.65l.046.067zm-8.983-7.245h-2.248c0 1.938-.009 3.864-.009 5.805 0 1.232.063 2.363-.138 2.711-.33.689-1.18.601-1.566.48-.396-.196-.597-.466-.83-.855-.063-.105-.11-.196-.127-.196l-1.825 1.125c.305.63.75 1.172 1.324 1.517.855.51 2.004.675 3.207.405.783-.226 1.458-.691 1.811-1.411.51-.93.402-2.07.397-3.346.012-2.054 0-4.109 0-6.179l.004-.056z"/></svg>
        </div>
        <div class="hexagon color-circleci" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-circleci-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-circleci-icon">CircleCI icon</title><path d="M8.963 12c0-1.584 1.284-2.855 2.855-2.855 1.572 0 2.856 1.284 2.856 2.855 0 1.572-1.284 2.856-2.856 2.856-1.57 0-2.855-1.284-2.855-2.856zm2.855-12C6.215 0 1.522 3.84.19 9.025c-.01.036-.01.07-.01.12 0 .313.252.576.575.576H5.59c.23 0 .433-.13.517-.333.997-2.16 3.18-3.672 5.712-3.672 3.466 0 6.286 2.82 6.286 6.287 0 3.47-2.82 6.29-6.29 6.29-2.53 0-4.714-1.5-5.71-3.673-.097-.19-.29-.336-.517-.336H.755c-.312 0-.575.253-.575.576 0 .037.014.072.014.12C1.514 20.16 6.214 24 11.818 24c6.624 0 12-5.375 12-12 0-6.623-5.376-12-12-12z"/></svg>
        </div>
        <div class="hexagon color-webpack" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-webpack-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-webpack-icon">Webpack icon</title><path d="M21.0157 18.1202L12.351 23v-3.8007l5.3986-2.9567 3.266 1.8776zm.5927-.5344V7.3805l-3.1708 1.822v6.5593l3.1708 1.824zm-18.6827.5344L11.5904 23v-3.8007l-5.3986-2.9567-3.266 1.8776zm-.5927-.5344V7.3805l3.1707 1.822v6.5593l-3.1707 1.824zm.371-10.8656l8.8864-5.0056v3.6748L5.8974 8.507l-.0434.0248-3.15-1.8116zm18.5335 0L12.351 1.7146v3.6748l5.693 3.1177.0434.0248 3.15-1.8116zm-9.647 11.6146l-5.3262-2.9155V9.642l5.326 3.062v5.6308zm.7605 0l5.326-2.9155V9.642l-5.326 3.062v5.6308zM6.625 8.9734l5.3467-2.928 5.3468 2.928-5.3468 3.0744L6.625 8.9734z"/></svg>
        </div>
        <div class="hexagon color-bootstrap" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-bootstrap-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-bootstrap-icon">Bootstrap icon</title><path d="M20 0H4C1.793.006.006 1.793 0 4v16c0 2.2 1.8 4 4 4h16c2.2 0 4-1.8 4-4V4c0-2.2-1.8-4-4-4zm-2.187 16.855c-.2.482-.517.907-.923 1.234-.42.34-.952.62-1.607.82-.654.203-1.432.305-2.333.305H6.518v-14h6.802c1.258 0 2.266.283 3.02.86.76.58 1.138 1.444 1.138 2.61 0 .705-.172 1.31-.518 1.81-.344.497-.84.886-1.48 1.156v.046c.854.18 1.515.585 1.95 1.215s.658 1.426.658 2.387c0 .538-.104 1.05-.3 1.528l.025.027zm-2.776-3.45c-.41-.375-.986-.558-1.73-.558H8.985v4.368h4.334c.74 0 1.32-.192 1.73-.58.41-.385.62-.934.62-1.64-.007-.69-.21-1.224-.62-1.59h-.017zm-.6-2.823c.396-.336.59-.817.59-1.444 0-.704-.175-1.204-.53-1.49-.352-.285-.86-.433-1.528-.433h-4v3.863h4c.583 0 1.08-.17 1.464-.496z"/></svg>
        </div>
        <div class="hexagon color-python" onclick="window.location.href='populateTopicNames.php'">
          <svg viewBox="0 0 24 24" aria-labelledby="simpleicons-python-icon" xmlns="http://www.w3.org/2000/svg" role="img"><title id="simpleicons-python-icon">Python icon</title><path d="M14.31.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.83l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.23l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05L0 11.97l.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.24-.01h.16l.06.01h8.16v-.83H6.24l-.01-2.75-.02-.37.05-.34.11-.31.17-.28.25-.26.31-.23.38-.2.44-.18.51-.15.58-.12.64-.1.71-.06.77-.04.84-.02 1.27.05 1.07.13zm-6.3 1.98l-.23.33-.08.41.08.41.23.34.33.22.41.09.41-.09.33-.22.23-.34.08-.41-.08-.41-.23-.33-.33-.22-.41-.09-.41.09-.33.22z"/><path d="M21.1 6.11l.28.06.32.12.35.18.36.27.36.35.35.47.32.59.28.73.21.88.14 1.04.05 1.23-.06 1.23-.16 1.04-.24.86-.32.71-.36.57-.4.45-.42.33-.42.24-.4.16-.36.09-.32.05-.24.02-.16-.01h-8.22v.82h5.84l.01 2.76.02.36-.05.34-.11.31-.17.29-.25.25-.31.24-.38.2-.44.17-.51.15-.58.13-.64.09-.71.07-.77.04-.84.01-1.27-.04-1.07-.14-.9-.2-.73-.25-.59-.3-.45-.33-.34-.34-.25-.34-.16-.33-.1-.3-.04-.25-.02-.2.01-.13v-5.34l.05-.64.13-.54.21-.46.26-.38.3-.32.33-.24.35-.2.35-.14.33-.1.3-.06.26-.04.21-.02.13-.01h5.84l.69-.05.59-.14.5-.21.41-.28.33-.32.27-.35.2-.36.15-.36.1-.35.07-.32.04-.28.02-.21V6.07h2.09l.14.01.21.03zm-6.47 14.25l-.23.33-.08.41.08.41.23.33.33.23.41.08.41-.08.33-.23.23-.33.08-.41-.08-.41-.23-.33-.33-.23-.41-.08-.41.08-.33.23z"/></svg>
        </div>
        <div class="hexagon color-css" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-css3-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-css3-icon">CSS3 icon</title><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.565-2.438L1.5 0zm17.09 4.413L5.41 4.41l.213 2.622 10.125.002-.255 2.716h-6.64l.24 2.573h6.182l-.366 3.523-2.91.804-2.956-.81-.188-2.11h-2.61l.29 3.855L12 19.288l5.373-1.53L18.59 4.414z"/></svg>
        </div>
        <div class="hexagon color-atom" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-atom-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-atom-icon">Atom icon</title><path d="M20.496 9.026c-2.183-.93-5.116-1.53-8.25-1.695-.5-.03-.987-.04-1.45-.04 2.318-2.83 4.802-4.73 6.437-4.79.322-.013.595.055.813.196.706.458.905 1.768.545 3.59-.04.25.12.493.36.54.25.05.49-.11.54-.36.45-2.28.12-3.846-.94-4.538-.38-.248-.84-.365-1.35-.346-2.05.077-4.94 2.3-7.59 5.72-1.154.035-2.24.13-3.232.287-.646-2.897-.39-4.977.594-5.477.138-.073.285-.11.457-.124.697-.054 1.66.395 2.71 1.27.194.16.486.14.646-.06.163-.195.134-.48-.06-.645C9.466 1.51 8.304 1 7.354 1.07c-.286.025-.556.098-.803.22-1.19.607-1.67 2.327-1.37 4.838.07.52.16 1.062.29 1.62C2.19 8.404.1 9.718.01 11.372c-.06 1.17.865 2.284 2.68 3.222.224.115.502.03.62-.2.114-.224.03-.5-.2-.616C1.66 13.032.88 12.19.927 11.42c.05-1.08 1.772-2.19 4.76-2.78.27.994.62 2.032 1.05 3.09-1.018 1.888-1.756 3.747-2.137 5.4-.56 2.465-.26 4.22.86 4.948.36.234.78.35 1.247.35.935 0 2.067-.46 3.347-1.372.21-.15.256-.435.11-.64-.147-.206-.433-.256-.64-.106-1.544 1.103-2.844 1.472-3.562 1.003-.76-.495-.926-1.943-.46-3.976.32-1.386.907-2.93 1.708-4.52.2.438.41.876.63 1.313 1.425 2.796 3.17 5.227 4.91 6.845 1.386 1.29 2.674 1.963 3.735 1.963.35 0 .68-.075.976-.223 1.145-.585 1.64-2.21 1.398-4.575-.224-2.213-1.06-4.91-2.354-7.6-.11-.227-.384-.323-.61-.216-.23.11-.33.385-.22.612 2.69 5.602 2.88 10.19 1.37 10.96-1.59.813-5.424-2.355-8.39-8.18-.34-.655-.637-1.3-.9-1.93.34-.608.7-1.22 1.095-1.83.395-.604.806-1.188 1.224-1.745h.394c.54 0 1.126.01 1.734.048 6.53.343 10.975 2.56 10.884 4.334-.04.765-.924 1.538-2.425 2.12-.234.096-.352.36-.26.596.07.18.24.292.426.292.058 0 .114-.01.167-.03 1.905-.74 2.95-1.756 3.01-2.93.07-1.33-1.17-2.61-3.5-3.6v-.01zM8.08 9.45c-.27.415-.52.827-.764 1.244-.292-.768-.532-1.51-.723-2.215.713-.11 1.485-.19 2.31-.24-.28.39-.554.794-.82 1.21v-.01z"/><circle cx="12.005" cy="12" r="1.375"/></svg>
        </div>
        <div class="hexagon color-gulp" onclick="window.location.href='populateTopicNames.php'">
          <svg aria-labelledby="simpleicons-gulp-icon" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-gulp-icon">Gulp icon</title><path d="M15.156 19.432l.636-1.084s-1.444.591-3.86.591c-2.418 0-3.84-.568-3.84-.568l.711 1.183.252 3.729c0 .403 1.314.718 2.936.718 1.623 0 2.938-.314 2.938-.718l.229-3.835v-.016zm.615-7.046c-.769.046-1.153.903-1.539 1.805-.143.33-.63 1.737-.948 1.563-.318-.173.413-1.329.619-2.017-.237.174-1.105.849-1.329.215-.358.314-1.129.48-1.042-.329-.191.345-.621.823-1.139.614-.673-.255.395-2.411.66-2.307.266.121-.053.6-.136.794-.186.419-.398.958-.255 1.063.24.194.904-.703.919-.719.124-.165.479-1.229.763-1.107.285.134-.711 1.541-.34 1.826.076.06.383-.03.569-.239.12-.12.078-.42.479-1.378.404-.959.764-2.156 1.039-2.066s.049.703-.051.943c-.464 1.078-1.268 2.844-.89 2.71.374-.135.569-.135.943-.569.374-.434.345-1.152.599-1.137.24.014.21.254.15.418.24-.27 1.152-.868 1.363-.284.254.688-1.304 1.692-.914 1.632.375-.045.988-.434 1.258-.793l.719-6.5s-.734.6-5.361.6-5.284-.584-5.284-.584l.613 5.93c.33-.928 1.108-2.814 2.322-2.74.554.03 1.303 1.109.658 1.139-.27.015-.3-.539-.614-.614-.239-.046-.554.135-.763.345-.404.404-1.304 2.006-1.184 2.801.15 1.018 1.407-.346 1.617-.75.149-.283.254-1.138.568-1.048.33.09-.029.974-.27 1.737-.27.869-.404 1.781-.732 1.676-.33-.104.209-1.227.178-1.422-.313.299-.883 1.02-1.631.659l.374 3.699s1.019.793 4.073.793 4.118-.793 4.118-.793l.479-4.283c-.389.39-1.617 1.063-1.692.3-.059-.614 1.333-1.498.974-1.514l.06-.069zM17.346.669l-2.659 2.8-.486 1.901c1.881.12 3.189.386 3.189.694 0 .419-2.414.757-5.391.757s-5.39-.343-5.39-.763c0-.419 2.414-.764 5.391-.764.423 0 .844 0 1.264.016l.561-2.276L16.65.039c.068-.09.28-.015.474.15.194.149.299.344.239.434v.03l-.017.016zm-3.834 5.795s-.523 0-.61-.08c-.022-.025-.036-.058-.036-.09 0-.058.039-.091.09-.11l.044.075c-.021.006-.029.015-.033.023 0 .041.314.069.555.066.239-.003.531-.023.533-.064 0-.012-.023-.023-.061-.033l.045-.072c.063.02.117.058.117.121 0 .11-.141.128-.23.141-.107.015-.412.023-.412.023h-.002z"/></svg>
        </div>
      </main>
      <a href="populateTopicNames.php" class="button1">Show more</a>
    </div>
    <div class="split right">
      <h1 class="group">Groups</h1>
      <h3 class="group">Join the different community groups</h3>
      <h4 class="group">Explore more interview questions, by joining different groups</h4>
      <a href="login.php" class="button">Get Started</a>
    </div>
  </div>
  <script>
    const left = document.querySelector(".left");
    const right = document.querySelector(".right");
    const container = document.querySelector(".container");
    left.addEventListener("mouseenter", () => {
      container.classList.add("hover-left");
    });
    left.addEventListener("mouseleave", () => {
      container.classList.remove("hover-left");
    });
    right.addEventListener("mouseenter", () => {
      container.classList.add("hover-right");
    });
    right.addEventListener("mouseleave", () => {
      container.classList.remove("hover-right");
    });
  </script>
  <script src="js/app.js"></script>
</body>

</html>
