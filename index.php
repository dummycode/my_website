<?php
$page_title = "Home";
$selected_page = "home";
$last_updated = 1545939450;
$pwd = '/';
?>
<html>
  <?php include __DIR__ . '/includes/head.php';?>
  <body>
    <div class="article">
      <!-- START OF HEADER -->
        <?php require __DIR__ . '/includes/header.php';?>
      <!-- END OF HEADER -->

      <!-- START OF BODY -->
      <div class="body">
        <p>
          Welcome to the homepage of my site, it is currently very bland and a WIP<sup style="font-size:12px">[<a class="superscript" href="#footer-1">1</a>]</sup>.
          My site consists of a projects archive and two blogs – a technical one and my personal one. Visit the about me page to learn more about who the heck 104101110114121 is.
          Just like every single one of my projects<sup style="font-size:12px">[<a class="superscript" href="#footer-2">2</a>]</sup>, this site is also open sourced. View the source <a href="http://github.com/dummycode/my-website">here</a>.
        </p>
        <p class="footer" id="footer-1">
          [1] Work in progress
        </p>
        <p class="footer" id="footer-2">
          [2] Well, except for the crappy ones, you don't care about those.
        </p>
      </div>
      <!-- END OF BODY -->

      <!-- START OF SUPER FOOTER -->
        <?php require __DIR__ . '/includes/super_footer.php';?>
      <!-- END OF SUPER FOOTER -->

    </div>
    <!-- END OF ARTICLE -->
  </body>
</html>
