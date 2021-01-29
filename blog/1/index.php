<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Blog</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/style.css" />

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/handlebars.runtime-v4.7.6.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-149253046-1');
    </script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({});
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({});

      $(document).ready(function() {
        $('#sidebar').html(sidebar);
        $('#sidebar-footer--mobile').html(sidebarFooterMobile);
      });
    </script>
  </head>
  <body>
    <div id="sidebar" class="sidebar"></div>

    <div class="body">
      <div class="blog-header">
        <h3 class="blog-header__title">
          Running of The Bulls
          <span class="blog-list__tag blog-list__tag--fun"></span>
        </h3>
        <p class="blog-header__date">December 28th, 2018</p>
      </div>
      <div class="blog-content">
        <p>
          I want you to picture a 500kg bull chasing you. Imagine it with sharp
          horns. Multiply it. By six to be exact. Place yourself in a small,
          crowded street with a thousand other people. Terrifying, eh? Well,
          purposefully putting myself in that exact same situation was the
          stupidest, yet best thing I've ever done.
        </p>
        <p>
          <img
            src="https://104101110114121.s3.us-east-2.amazonaws.com/images/rotb.jpeg"
            class="blog-content__image--inline"
          />
          <span class="blog-content__image-caption"
            >Max, Jaleen, and me after running</span
          >
        </p>
        <p>
          The festival of San Fermín is a week-long, historically rooted
          celebration held anually in the city of Pamplona, Spain. During this
          week, over a million Spainards and foreigners transform the quaint
          town of Pamplona into one giant party. My friends and I travelled from
          Spain, where we were studying for the summer, to Pamplona to join in
          on the fun.
        </p>
        <p>
          After a night out and a few (2) short hours spent attempting to sleep
          (none was had) on a park bench cuddling in the cold, we set off just
          before sunrise to join in the daily tradition of running with the
          bulls.
        </p>
        <p>
          We hustled across the city to line up. As we entered the street where the bulls ran, we strategically tried to position ourselves just before Dead Man's Corner. Yes, you read that right, Dead Man's Corner. This way, once the bulls were released, we would have time to jog past the corner and onto the final straight away before the bulls caught us. We reasoned this to be the safest approach.
        </p>
        <p>
          The scene before the run was very ominous. Where we were lined up, there were these creepy animated videos being shown on the big screens telling you what to and what not to do. Things like, don't climb the walls, don't run, and to roll towards the sides and protect your head if you fall.
        </p>
        <p>
      As I stood there, I realized we are literally live entertainment for the Spainards. Here I was, amongst a thousand other dumbass Americans and Austraillans, with another thousand Spaniards watching us from the safety of buildings or the barricades. Wow, we were really in for it.
</p>
<p>

</p>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
