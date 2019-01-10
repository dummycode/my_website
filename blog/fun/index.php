<?php
$page_title = "Fun Blog";
$pwd = '/blog/fun';
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
                This blog is an archive of my fun<sup style="font-size:12px">[<a class="superscript" href="#footer-1">1</a>]</sup> experiences I'd love to share with everyone, in hopes of inspiring others to join me in creating adventure wherever possible.
              </p>
          </div>
          <div class="dir">
            <ul class="directoryList">
                <li class="directoryItem">
                  <strong>12/28/2018</strong> <a href="bulls">Running of the Bulls</a> – Pamplona, Spain
                </li>
            </ul>
        </div>
        <p class="footer" id="footer-1">
          [1] "Fun"
        </p>
      </div>
      <!-- END OF BODY -->

      <!-- START OF SUPER FOOTER -->
      <?php require __DIR__ . '/../../includes/super_footer.php';?>
      <!-- END OF SUPER FOOTER -->

    </div>
    <!-- END OF ARTICLE -->
  </body>
</html>
