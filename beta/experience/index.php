<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
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
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--bnr">
          <h3>Big Nerd Ranch</h3>
        </div>
        <div class="section--experience__job">Software Engineer Intern</div>
        <ul class="section--experience__bullets">
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--sl">
          <h3>Seller Labs</h3>
        </div>
        <div class="section--experience__job">Software Engineer Intern</div>
        <ul class="section--experience__bullets">
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--tech">
          <h3>Georgia Institute of Technology</h3>
        </div>
        <div class="section--experience__job">Head Teaching Assistant</div>
        <ul class="section--experience__bullets">
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--nedzas">
          <h3>Nedza's Waffles</h3>
        </div>
        <div class="section--experience__job">Co-Founder/Business Development</div>
        <ul class="section--experience__bullets">
          <li>Co-founded a dessert-based waffle company that held an average a 4 pop-up shops per week</li>
          <li>Awarded $5,000 through UGA's Idea Accelerator after pitching product and business plan to a panel of
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</li>
        </ul>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
