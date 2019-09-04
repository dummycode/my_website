<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Projects</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/handlebars.runtime-v4.1.2.js"></script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({})
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
      })

      function getStats() {
        $.ajax({
          url: "https://evening-shore-05569.herokuapp.com",
          type: "get",
          data: [],
          success: function(response) {
            if (response.answer) {
              $("#result").text("Yes");
              $('body').css('background-color', '#2E7D32');
            } else {
              $("#result").text("No");
              $('body').css('background-color', '#B71C1C');
            }
          },
          error: function(response) {
            $("#result").text("Error")
          }
        });
      }
     </script>
     <style type="text/css">
       body {
         background-color: #0D47A1;
         color: #fff;
       }

       .container {
         text-align: center;
         height: 100%;
         align-items: center;
         display: flex;
         flex-direction: column;
         flex: 1;
         justify-content: center;
         margin-bottom: 150px;
       }

       .container h1 {
         margin: 0;
         font-size: 128px;
         font-weight: 300;
       }

       @media (min-width: 768px) {
         .container h1 {
           font-size: 256px;
         }
       }
     </style>
    </script>
  </head>

  <body onload="getStats()">
    <div class="container">
      <h1 id="result">Loading</h1>
    </div>
  </body>
</html>
