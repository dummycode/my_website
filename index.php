<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
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
      <div id="me" class="section">
        <div class="section__title">
          <h1>Me</h1>
        </div>
        <p>
          Hi, my name is Henry Harris. I am currently a software engineer at Palantir Technologies. Previously, I received my Bachelor of Science in Computer Science from the Georgia Institute of Technology, better known as Georgia Tech.
          At Palantir, most of my time has been dedicated to working on Palantir Gotham's suite of artificial intelligence (AI) tools, the platform's core data model, and the Palantir ontology.
        </p>
      </div>
      <div id="story" class="section">
        <div class="section__title">
          <h1>Story</h1>
        </div>
        <p>
          My story with computers began way back when I was a middle schooler, playing Minecraft with my two brothers on our private server.
          Wanting to write custom server plugins, I started watching <a href="https://www.youtube.com/user/thenewboston">thenewboston</a>'s Java tutorials on YouTube.
          The moment I saw the words "Hello World" pop up in my console, I knew programming was for me.
        </p>
        <p>
          Since, I have taken AP Computer Science, chosen Computer Science as my major, gotten heavily involved in the College of Computing at Georgia Tech, interned at three software companies, started my first full-time software engineering job, built countless personal projects, and I continue to love it just as much to this day.
        </p>
      </div>
      <div id="hobbies" class="section">
        <div class="section__title">
          <h1>Hobbies</h1>
        </div>
        <p>
          In my free time I enjoy exercising and the great outdoors -- specifically running, ultrarunning, climbing, mountaineering, alpinism, and skiing.
          I currently live in central Colorado, in a small town called Salida, where I am able to trail run and explore the high peaks right from my front door.
          While my main motivation for training is to be capable of moving through the mountains quickly, I enjoy the occasional sufferfest at an organized event as well.
          Follow my adventure on <a href="https://www.strava.com/athletes/20856911">Strava</a>.
        </p>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
