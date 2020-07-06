<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/handlebars.runtime-v4.1.2.js"></script>
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
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--sfdc">
          <h1>Salesforce</h1>
        </div>
        <div class="section--experience__job">Software Engineer Intern</div>
        <p class="section--experience__description">
          Member of the Identity team at Heroku: responsible for all things authentication and authorization for Heroku's Platform API
        </p>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--bnr">
          <h1>Big Nerd Ranch</h1>
        </div>
        <div class="section--experience__job">Software Engineer Intern</div>
        <p class="section--experience__description">
          Consulted on a client project developing a custom content management system built in Ruby on Rails with a React Redux UI
        </p>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--sl">
          <h1>Seller Labs</h1>
        </div>
        <div class="section--experience__job">Software Engineer Intern</div>
        <p class="section--experience__description">
          Worked on an internal account management and billing system with PHP Laravel backend and a React Redux frontend
        </p>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--tech">
          <h1>Georgia Institute of Technology</h1>
        </div>
        <div class="section--experience__job">Head Teaching Assistant</div>
        <p class="section--experience__description">
          Organize, lead, and manage team of ten TAs in charge of 250+ students
        </p>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--nedzas">
          <h1>Nedza's Waffles</h1>
        </div>
        <div class="section--experience__job">Co-Founder</div>
        <p class="section--experience__description">
          Won University of Georgia's Idea Accelerator and grew company to ten employees working multiple events per week
        </p>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
