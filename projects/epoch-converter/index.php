<?php
// Includes parameters
$page_title = "Epoch Converter";

$epoch = isset($_GET['epoch']) ? $_GET['epoch'] : time();
$dt = new DateTime("@$epoch");
$humanReadableTime = $dt->format('l, F jS, Y h:i:s A');

$last_updated = 1546548525;
?>

<html>
    <?php require __DIR__ . '/../../includes/head.php'; ?>
  <head>
    <script>
      window.setInterval(function() {
        currentTime();
      }, 1000);

      function currentTime() {
        var currTimeElem = document.getElementById("currentTime");
        var newEpoch = Math.round(Number(new Date().getTime() / 1000));
        currTimeElem.innerHTML = newEpoch;
        var nowLinkElem = document.getElementById("nowLink");
        nowLinkElem.setAttribute("href", "?epoch=" + newEpoch);
      }
    </script>
  </head>

  <body onload="currentTime()">
    <div class="article">
        <!-- START OF HEADER -->
        <?php require __DIR__ . '/../../includes/header.php';?>
        <!-- END OF HEADER -->

      <!-- START OF BODY -->
      <div class="body">
        <p>
            <?php echo '<strong>' . $epoch . '</strong> in human readable time is <strong>' . $humanReadableTime . '</strong>' ?>
        </p>
        <div class="dir">
          <ul class="directoryList">
            <li class="directoryItem">
              <a href="#README">README</a>
            </li>
            <li class="directoryItem">
              <a href="#src">src</a>
            </li>
            <li class="directoryItem">
              <a id="nowLink" href="#">now</a> -> <span id="currentTime"></span>
            </li>
          </ul>
        </div>
      </div>
      <!-- END OF BODY -->

      <!-- START OF SUPER FOOTER -->
        <?php require __DIR__ . '/../../includes/super_footer.php';?>
      <!-- END OF SUPER FOOTER -->

    </div>
    <!-- END OF ARTICLE -->
  </body>
</html>
