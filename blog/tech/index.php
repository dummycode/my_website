<?php
$page_title = "Technical Blog";
$pwd = '/blog/tech';
$last_updated = 10;
?>
<html>
    <?php require __DIR__ . '/../../includes/head.php';?>
  <body>
    <div class="article">
      <!-- START OF HEADER -->
      <?php require __DIR__ . '/../../includes/header.php';?>
      <!-- END OF HEADER -->

      <!-- START OF BODY -->
      <div class="body">
          <div class="main">
              <p>
                This blog is desgined to hold technical or intellectual (or not) things I find intriguing.
              </p>
          </div>
          <div class="dir">
            <ul class="directoryList">
                <li class="directoryItem">
                  <strong>12/28/2018</strong> <a href="euler">Euler's Formula</a>
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
