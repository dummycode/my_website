<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Projects</title>
    <link rel="stylesheet" href="/beta/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese">
    <link rel="stylesheet" href="/beta/assets/style.css">

    <script src="/beta/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/beta/assets/js/handlebars.runtime-v4.1.2.js"></script>
    <script src="/beta/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({})
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})
      const quickQueue = Handlebars.templates['projects/quickQueue']({})
      const myWebsite = Handlebars.templates['projects/myWebsite']({})
      const dino = Handlebars.templates['projects/dino']({})
      const westbrook = Handlebars.templates['projects/westbrook']({})
      const projectsList = Handlebars.templates['projects/all']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
        $("#projects__quick-queue").html(quickQueue)
        $("#projects__my-website").html(myWebsite)
        $("#projects__dino").html(dino)
        $("#projects__westbrook").html(westbrook)
        $("#projects-list").html(projectsList)
      })
    </script>
  </head>
  <body>
    <div id="sidebar" class="sidebar"></div>

    <div class="body projects">
      <div class="projects-favorites">
        <div class="row">
          <div id="projects__quick-queue" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__my-website" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__dino" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__westbrook" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
        </div>
      </div>
      <div id="projects-list" class="hidden projects-list"></div>

    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
