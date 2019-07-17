<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Projects</title>
    <link rel="stylesheet" href="/beta/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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

    <div class="body projects">
      <div card="container projects-favorites">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-4 project-card">
            <div class="project-card__container">
              <div class="project-card__title">Quick Queue</div>
              <div class="project-card__description">This is a description of the Quick Queue project. It should be no longer than 200 characters.</div>
              <div class="project-card__languages">
                <div class="language-tag">JavaScript</div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4 project-card">
            <div class="project-card__container">
              <div class="project-card__title">Quick Queue</div>
              <div class="project-card__description">This is a description of the Quick Queue project. It should be no longer than 200 characters.</div>
              <div class="project-card__languages">
                <div class="language-tag">JavaScript</div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4 project-card">
            <div class="project-card__container">
              <div class="project-card__title">Quick Queue</div>
              <div class="project-card__description">This is a description of the Quick Queue project. It should be no longer than 200 characters.</div>
              <div class="project-card__languages">
                <div class="language-tag">JavaScript</div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4 project-card">
            <div class="project-card__container">
              <div class="project-card__title">Quick Queue</div>
              <div class="project-card__description">This is a description of the Quick Queue project. It should be no longer than 200 characters.</div>
              <div class="project-card__languages">
                <div class="language-tag">JavaScript</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="projects-list">
        <ul>
          <li>Quick Queue</li>
          <li>My Website</li>
          <li>Musuem Mayhem</li>
          <li>Tic Tac Toe</li>
        </ul>
      </div>
      Projects need to go here
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
