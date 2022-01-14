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
        const version = 1;
        d3.text("summits.csv" + "?v" + version, function(data) {
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

        d3.text("ultras.csv" + "?v" + version, function(data) {
            const parsedCSV = d3.csv.parseRows(data);
            const ultras = parsedCSV;

            const table = d3.select("#ultras")[0][0];

            ultras.forEach(function (ultra) {
                const tr = table.insertRow(-1);
                ultra.forEach(function (data) {
                    var td = document.createElement('td');
                    td = tr.insertCell(-1);
                    td.innerHTML = data;
                });
            });
        });

        // Sort table
        function sortTable(tableName, n, isDate = false) {
            let i, x, y, shouldSwitch, switchcount = 0;
            const table = document.getElementById(tableName);
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
          <h1>Summits</h1>
        </div>
        <p>
            I have had the opportunity to climb some of the world's most popular, difficult, and fun mountains.
            Here is a list of some of the hills I have been fortunate enough to summit.
        </p>
        <table id="summits" class="summits">
            <thead>
                <tr>
                    <th onclick="sortTable('summits', 0)">Summit</th>
                    <th onclick="sortTable('summits', 1)">Country</th>
                    <th onclick="sortTable('summits', 2)">Elevation (m)</th>
                    <th onclick="sortTable('summits', 3, true)">Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>

      <div class="section">
        <div class="section__title">
          <h1>Running</h1>
        </div>
        <p>
            I have also been tirelessly running some of the best trails in the world in hopes of pushing my body to the limit.
            Here are the top ultra distance routes I have defeated. Well, rather, those that have defeated me.
        </p>
        <table id="ultras" class="ultras">
            <thead>
                <tr>
                    <th onclick="sortTable('ultras', 0)">Name</th>
                    <th onclick="sortTable('ultras', 1)">Country</th>
                    <th onclick="sortTable('ultras', 2)">Distance (km)</th>
                    <th onclick="sortTable('ultras', 3)">Vertical (m)</th>
                    <th onclick="sortTable('ultras', 4, true)">Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>

    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
