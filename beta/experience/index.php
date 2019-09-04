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
        <div class="section--experience__job"><h7>Software Engineer Intern</h7></div>
        <ul class="section--experience__bullets">
          <li>Consulted on a client project developing a custom content management system built in Ruby on Rails</li>
          <li>Investigated and optimized multiple memory bloating requests cutting the app’s overall memory usage by 60%</li>
          <li>Engaged with a third party to perform load testing and in response implemented Rails template caching to reduce average 	page load times by 300%</li>
          <li>Engineered and implemented multi-index search, providing admins and users a seamless experience managing and 	searching multiple indices</li>
          <li>Initiated conversation and guided team in re-pointing stories to adhere to good Agile processes and provide the client 	meaningful effort estimates</li>

        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--sl">
          <h3>Seller Labs</h3>
        </div>
        <div class="section--experience__job"><h7>Software Engineer Intern</h7></div>
        <ul class="section--experience__bullets">
          <li>Implemented new features for an internal support system for four different products to increase functionality and effectiveness of customer service teams</li>
          <li>Built features independently from user story to release through database design and migration, creating and updating
          API endpoints, and adding or modifying components in a React/Redux UI</li>
          <li>Planned, designed, and implemented an affiliate tracking system to accurately track subscriptions, allowing the marketing team to use the data to strategically target markets and ultimately increase revenue</li>
          <li>Overhauled pulling or pushing customer data from or to a third-party service to eliminate redundant requests and thus reduce server load and decrease operating costs</li>
          <li>Migrated data and refactored separate billing systems into a central system resulting in a streamlined and improved customer experience</li>

        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--tech">
          <h3>Georgia Institute of Technology</h3>
        </div>
        <div class="section--experience__job"><h7>Head Teaching Assistant</h7></div>
        <ul class="section--experience__bullets">
          <li>Overhauled entirety of course in coordination with course professor to adhere to new assessment structure and schedule</li>
          <li>Taught recitation twice a week to 50+ students on topics from digital logic, assembly, and C fundamentals</li>
          <li>Organized, led, and managed team of 10 TAs in charge of 250+ students enrolled in the course per semester</li>
          <li>Designed, authored, and reviewed projects, homework, and tests to effectively evaluate student proficiency</li>
          <li>Held office hours dedicated to one-on-one student help to strengthen knowledge in course materials and topics</li>
        </ul>
      </div>
      <div class="section section--experience">
        <div class="section__title section--experience__title section--experience__title--nedzas">
          <h3>Nedza's Waffles</h3>
        </div>
        <div class="section--experience__job"><h7>Co-Founder</h7></div>
        <ul class="section--experience__bullets">
          <li>Awarded $5,000 through UGA’s Idea Accelerator after pitching product and business plan to a panel of five entrepreneurs</li>
          <li>Managed financials and accounting, created business plans, planned and led catering events, maintained and ordered
inventory, and managed employees</li>
          <li>Designed and developed a website to promote menu, events, and provide a catering request form to increase revenue</li>
          <li>Recruited, screened, interviewed, and trained first 10 employees to run events independently</li>
        </ul>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
