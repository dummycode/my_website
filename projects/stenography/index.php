<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-149253046-1');
    </script>
    <script src="/assets/js/handlebars.runtime-v4.1.2.js"></script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({})
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
      })
    </script>
    <script>
    </script>
  </head>

  <body>
    <div id="sidebar" class="sidebar"></div>
    <div class="body">
      <div class="section">
        <div class="section__title">
          <h1>Stenography</h1>
        </div>
        <p>Stenography is the practice of concealing a file, message, image, or video within another file, message, image, or video.</p>
        <p>In order to encode an image inside of another image, we can use a basic strategy.</p>
      </div>

      <div class="section">
        <div class="section__title">
          <h1>Example</h1>
        </div>
        <p>Example</p>
      </div>

      <div class="section">
        <div class="section__title">
          <h1>Demo</h1>
        </div>
        <p>Encode</p>
        <form id="encode-form" method="POST" action="http://enigmatic-brook-56715.herokuapp.com/encode" enctype="multipart/form-data">
          Background Image: <input type="file" name="base_image"><br>
          Secret Image: <input type="file" name="secret_image"><br>
          <br>
          <input type="submit" value="Encode">
        </form>

        <br>

        <p>Decode</p>
        <form id="decode-form" method="POST" action="http://enigmatic-brook-56715.herokuapp.com/decode" enctype="multipart/form-data">
          Image: <input type="file" name="image"><br>
          <br>
          <input type="submit" value="Decode">
        </form>

      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
