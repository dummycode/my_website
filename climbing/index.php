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
    <script src="/assets/js/handlebars.runtime-v4.1.2.js"></script>
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
            var parsedCSV = d3.csv.parseRows(data);
            console.log(parsedCSV);

            const table = d3.select("#summits")[0][0];
            console.log(table);
            var rowCnt = table.rows.length;
            console.log(rowCnt);
            var tr = table.insertRow(rowCnt);
            tr = table.insertRow(rowCnt);

            var td = document.createElement('td');          // TABLE DEFINITION.
            td = tr.insertCell(0);
            td.innerHTML = "Test";

            /*table.selectAll('td').data(parsedCSV).text(function(d) {
                const data = Object.values(d)[0];
                console.log(data);
                return data;
            });*/
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
                <tr>
                    <td>Chimborazo</td>
                    <td>Ecuador</td>
                    <td>6,263</td>
                    <td>01/06/2021</td>
                </tr>
            </tbody>
        </table>
      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
