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
    <script src="https://d3js.org/d3.v3.min.js"></script>

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

        // Sort table
        function sortSummits(n, isDate = false) {
            let i, x, y, shouldSwitch, switchcount = 0;
            const table = document.getElementById("summits");
            let switching = true;
            let dir = "asc";

            while (switching) {
                switching = false;
                let rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];

                    const x_inner = x.innerHTML.toLowerCase();
                    const y_inner = y.innerHTML.toLowerCase();
                    let x_val = x_inner;
                    let y_val = y_inner;
                    if (isDate) {
                        x_val = new Date(x_val);
                        y_val = new Date(y_val);
                    }

                    if (dir == "asc") {
                        if (x_val > y_val) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x_val < y_val) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
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
                    <th onclick="sortSummits(0)">Summit</th>
                    <th onclick="sortSummits(1)">Country</th>
                    <th onclick="sortSummits(2)">Elevation (m)</th>
                    <th onclick="sortSummits(3, true)">Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
