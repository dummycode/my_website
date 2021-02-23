<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Projects</title>
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
      const quickQueue = Handlebars.templates['projects/quickQueue']({})
      const myWebsite = Handlebars.templates['projects/myWebsite']({})
      const dino = Handlebars.templates['projects/dino']({})
      const westbrook = Handlebars.templates['projects/westbrook']({})
      const sms = Handlebars.templates['projects/sms']({})
      const cubefield = Handlebars.templates['projects/cubefield']({})
      const warranty = Handlebars.templates['projects/warranty']({})
      const rustos = Handlebars.templates['projects/rustos']({})
      const w2g = Handlebars.templates['projects/w2g']({})
      const plateMate = Handlebars.templates['projects/plateMate']({})
      const projectsList = Handlebars.templates['projects/all']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
        $("#projects__quick-queue").html(quickQueue)
        $("#projects__my-website").html(myWebsite)
        $("#projects__dino").html(dino)
        $("#projects__westbrook").html(westbrook)
        $("#projects__sms").html(sms)
        $("#projects__warranty").html(warranty)
        $("#projects__cubefield").html(cubefield)
        $("#projects__rustos").html(rustos);
        $("#projects__w2g").html(w2g);
        $("#projects__plate-mate").html(plateMate);
        $("#projects-list").html(projectsList)
      })
    </script>
  </head>
  <body>
    <div id="sidebar" class="sidebar"></div>

    <div class="body projects">
      <div class="projects-favorites">
        <div class="row">
          <div id="projects__sms" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__rustos" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__quick-queue" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__w2g" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__my-website" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__westbrook" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__cubefield" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__plate-mate" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__dino" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
          <div id="projects__warranty" class="col-sm-12 col-md-6 col-lg-6 project-card"></div>
        </div>
      </div>
      <div id="projects-list" class="hidden projects-list"></div>

    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
