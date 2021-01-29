<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-149253046-1');
    </script>
    <script src="/assets/js/handlebars.runtime-v4.7.6.js"></script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({})
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})

      $(document).ready(function () {
        $("#sidebar").html(sidebar)
        $("#sidebar-footer--mobile").html(sidebarFooterMobile)
      })
    </script>
    <script src="http://d3js.org/d3.v3.min.js"></script>

    <script type="text/javascript"charset="utf-8">
        d3.text("summits.csv", function(data) {
            const parsedCSV = d3.csv.parseRows(data);
            const summits = parsedCSV;

            const table = d3.select("#summits")[0][0];

            summits.forEach(function (summit) {
                const tr = table.insertRow(-1);
                summit.forEach(function (data) {
                    var td = document.createElement('td');
                    td = tr.insertCell(-1);
                    td.innerHTML = data;
                });
            });
        });
    </script>
  </head>

  <body>
    <div id="sidebar" class="sidebar"></div>
    <div class="body">
      <div class="section">
        <div class="section__title">
          <h1>Climbing</h1>
        </div>
        <p>I have had the opportunity to climb some of the world's most popular, difficult, and fun mountains. Here is a list of some of the hills I have been fortunate enough to summit.</p>
      </div>

      <div class="section">
        <div class="section__title">
          <h1>Summits</h1>
        </div>
        <table id="summits" class="summits">
            <thead>
                <tr>
                    <th>Summit</th>
                    <th>Country</th>
                    <th>Elevation (m)</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
