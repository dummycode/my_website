<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Blog</title>
    <link rel="stylesheet" href="/beta/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese">
    <link rel="stylesheet" href="/beta/assets/style.css">

    <script src="/beta/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/beta/assets/js/handlebars.runtime-v4.1.2.js"></script>
    <script src="/beta/assets/js/templatesCompiled.js"></script>
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
              <a href="/beta/blog/2">Using PostgreSQL's JSONB Data Type in Rails</a><span class="blog-list__tag blog-list__tag--tech"></span>
            </h3>
            <p class="blog-list__date">July 30th, 2019</p>
          </li>
          <li class="blog-list__item">
            <h3>
              <a href="/beta/blog/1">Running of The Bulls</a><span class="blog-list__tag blog-list__tag--fun"></span>
            </h3>
            <p class="blog-list__date">December 28th, 2018</p>
          </li>
        </ul>
      </div>

    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
