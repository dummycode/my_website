<?php
  $epoch = isset($_GET['epoch']) ? $_GET['epoch'] : time();
?>


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
    <script src="/assets/bundle.js"></script>

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
      <div class="section">
        <div class="section__title">
          <h3>Pace Calculator</h3>
        </div>
        <form id="pace-form" onsubmit="return false;">
          <p>Time</p>
          <input name="hours" id="hoursInput" type="numeric" step="any" min="0" max="60" placeholder="00"/><span class="timeUnit">h</span>
          <input name="minutes" id="minutesInput" type="numeric" step="any" min="0" max="59" placeholder="00"/><span class="timeUnit">m</span>
          <input name="seconds" id="secondsInput" type="numeric" step="any" min="0" max="59" placeholder="00"/><span class="timeUnit">s</span>

          <p>Distance</p>
          <input name="distance" id="distanceInput" type="numeric" step="any" min="0" placeholder="00" />
          <button name="mileUnit" class="distanceUnit selected" value="mile">Mile(s)</button>
          <button name="kmUnit" class="distanceUnit" value="km">KM(s)</button>
          <button name="mUnit" class="distanceUnit" value="m">Meter(s)</button>
            <select name="raceUnit" id="raceUnit" class="distanceUnit">
                <option disabled selected value>Race</option>
              <option value="marathon">Marathon</option>
              <option value="half">Half</option>
              <option value="tenMile">10 mile</option>
              <option value="tenK">10k</option>
              <option value="fiveK">5k</option>
              <option value="mile">Mile</option>
            </select>

          <p>Pace</p>
          <input name="pace" id="paceInput" type="text" step="any" placeholder="Distance" disabled="true"/>
          <button name="mileUnit" class="paceUnit selected" value="mile">Mile</button>
          <button name="kmUnit" class="paceUnit" value="km">KM</button>
                <select name="mUnit" id="paceMeterUnit" class="paceUnit">
                <option disabled selected value>m</option>
              <option value="1600">1600m</option>
              <option value="800">800m</option>
              <option value="400">400m</option>
              <option value="200">200m</option>
              <option value="100">100m</option>
            </select>


          <p>Splits</p>
            <input name="split" id="splitInput" type="text" step="any" placeholder="Splits" disabled="true" />
              <button name="mileUnit" class="splitUnit selected" value="mile">Mile</button>
              <button name="kmUnit" class="splitUnit" value="km">KM</button>
                <select name="mUnit" id="splitMeterUnit" class="splitUnit">
                <option disabled selected value>m</option>
              <option value="1600">1600m</option>
              <option value="800">800m</option>
              <option value="400">400m</option>
              <option value="200">200m</option>
              <option value="100">100m</option>
            </select>
            <table id="splits-table">
                <tr><th>Lap</th><th>Time</th><th>Distance</th></tr>
            </table>
</div>
        </form>
      </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
