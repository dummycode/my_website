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
          <h1>Liz Hogan Portfolio</h1>
        <p>
<iframe
    src="PORTFOLIO.pdf#toolbar=0&navpanes=0&scrollbar=0"
    frameBorder="0"
    scrolling="auto"
    height="600px"
    width="100%"
></iframe>
        </p>
      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
