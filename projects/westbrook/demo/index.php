<?php
// Includes parameters
$page_title = "Westbrook Demo";

?>

<html>
  <?php require __DIR__ . '/../../../includes/head.php'; ?>
  <head>
    <script>
      function getStats() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost:8081", true);
        xhr.onload = function (e) {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              if (xhr.responseText === "True") {
                document.getElementById("result").innerHTML = "Yes";
                document.body.style.backgroundColor = "#3c763d";
              } else {
                document.getElementById("result").innerHTML = "No";
                document.body.style.backgroundColor = "#a94442";
              }
            } else {
              document.getElementById("result").innerHTML = "ERROR";
            }
          }
        };
        xhr.onerror = function (e) {
          console.log(e.message);
          document.getElementById("result").innerHTML = "ERROR";
        };
        xhr.send(null);
      }
    </script>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/746852/739588/css/fonts.css" />
    <style type="text/css">
      html,
      body {
        margin: 0;
        padding: 0;
        height: 100%;
      }
      body {
        font-family: "Whitney SSm A", "Whitney SSm B", "Helvetica Neue", Helvetica, Arial, Sans-Serif;
        background-color: #31708f;
        color: #fff;
        -moz-font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
      }
      .container {
        text-align: center;
        height: 100%;
      }
      @media (max-width: 480px) {
        .container {
          position: relative;
          top: 50%;
          height: initial;
          -webkit-transform: translateY(-50%);
          -ms-transform: translateY(-50%);
          transform: translateY(-50%);
        }
      }
      .container h1 {
        margin: 0;
        font-size: 130px;
        font-weight: 300;
      }
      @media (min-width: 480px) {
        .container h1 {
          position: relative;
          top: 50%;
          -webkit-transform: translateY(-50%);
          -ms-transform: translateY(-50%);
          transform: translateY(-50%);
        }
      }
      @media (min-width: 768px) {
        .container h1 {
          font-size: 220px;
        }
      }
    </style>
  </head>

  <body onload="getStats()">
    <div class="container">
      <h1 id="result"></h1>
    </div>
  </body>

</html>
