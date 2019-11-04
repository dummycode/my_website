<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/sms.js"></script>
  </head>
  <body>
    <div class="sms-groups">
      <p><a href="..">Back</a></p>
      <h1>Groups</h1>
      <form id="sms__form--group" class="sms__form" autocomplete="off">
        <input type="text" name="name" placeholder="Name"></textarea>
        <input type="submit" value="Add">
        <p class="sms__form-result"></p>
      </form>

      <p id="sms-groups__loading">Loading groups...</p>
      <ul class="sms-groups__list"></ul>
    </div>
  </body>
</html>
