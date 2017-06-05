<?php

// Includes parameters
$page_title = "Epoch Converter";

$epoch = isset($_GET['epoch']) ? $_GET['epoch'] : time();
$dt = new DateTime("@$epoch");
$humanReadableTime = $dt->format('m-d-Y H:i:s T');

?>

<html>
  <?php include('../../includes/head.php'); ?>
  <head>
    <script>
      window.setInterval(function(){
        currentTime();
      }, 1000);
      function currentTime() {
        var currentTimeElem = document.getElementById("currentTime");
        var newEpoch = Math.round(Number(new Date().getTime() / 1000));
        currentTimeElem.innerHTML = newEpoch;
        currentTimeElem.setAttribute("href", "?epoch=" + newEpoch);
      }
    </script>
  </head>
  <body onload="currentTime()">
    <h1>
      Epoch Converter
    </h1>
    <p>
      <ul class="directoryList">
        <li class="directoryItem">
          <a href=".">.</a>
        </li>
        <li class="directoryItem">
          <a href="..">..</a>
        </li>
        <li class="directoryItem">
          <a href="#README">README</a>
        </li>
        <li class="directoryItem">
          <a href="#src">src</a>
        </li>
        <li class="directoryItem">
          <a id="currentTime" href="#"></a>
      </ul>
    </p>
    <p>
      <?php echo $epoch . ' in human readable time is ' . $humanReadableTime ?>
    </p>
  </body>
</html>
