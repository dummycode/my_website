<?php
$page_title = 'Projects';
$pwd = '/projects';
$last_updated = 1546548225;
?>
<html>
  <?php require __DIR__ . '/../includes/head.php';?>
  <body>
    <div class="article">
      <!-- START OF HEADER -->
      <?php require __DIR__ . '/../includes/header.php';?>
      <!-- END OF HEADER -->

      <!-- START OF BODY -->
      <div class="body">
        <p>
            Below are some of my personal projects that I'd like to highlight.
            If you want to dive deeper, you can see a complete list of my free
            software on my <a href="http://github.com/dummycode">GitHub</a>.
        </p>
        <div class="dir">
          <ul class="directoryList">
              <li class="directoryItem">
                <a href="website">my website</a>
              </li>
              <li class="directoryItem">
                <a href="quick-queue">quick queue</a>
              </li>
              <li class="directoryItem">
                <a href="tic-tac-toe">tic tac toe</a>
              </li>
              <li class="directoryItem">
                <a href="epoch-converter">epoch converter</a>
              </li>
              <li class="directoryItem">
                <a href="museum-mayhem">museum mayhem</a>
              </li>
              <li class="directoryItem">
                <a href="westbrook">is westbrook averaging a triple double</a>
              </li>
          </ul>
        </div>
      </div>
      <!-- END OF BODY -->

      <!-- START OF SUPER FOOTER -->
        <?php require __DIR__ . '/../includes/super_footer.php';?>
      <!-- END OF SUPER FOOTER -->

    </div>
    <!-- END OF ARTICLE -->
  </body>
</html>
