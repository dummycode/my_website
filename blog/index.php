<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Blog</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/handlebars.runtime-v4.7.6.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-149253046-1');
    </script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({})
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
      })
    </script>
  </head>
  <body>
    <div id="sidebar" class="sidebar"></div>

    <div class="body">
      <div class="blog-list">
        <ul>
          <li class="blog-list__item">
            <h3>
              <a href="/blog/2">Using PostgreSQL's JSONB Data Type in Rails</a> <span class="blog-list__tag blog-list__tag--tech"></span>
            </h3>
            <p class="blog-list__date">July 30th, 2019</p>
          </li>
          <li class="blog-list__item">
            <h3>
              <a href="/blog/1">Running of The Bulls</a> <span class="blog-list__tag blog-list__tag--fun"></span>
            </h3>
            <p class="blog-list__date">December 28th, 2018</p>
          </li>
        </ul>
      </div>

    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
