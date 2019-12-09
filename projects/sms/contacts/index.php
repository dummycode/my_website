<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/bundle.js"></script>
  </head>
  <body>
    <div class="sms-contacts">
      <p><a href="..">Back</a></p>
      <h1>Contacts</h1>
      <form id="sms__form--contact" class="sms__form" autocomplete="off">
        <input type="text" name="name" placeholder="Name"></textarea>
        <input type="text" name="phone_number" placeholder="Phone number"></textarea>
        <input type="submit" value="Add">
        <p class="sms__form-result"></p>
      </form>

      <p id="sms-contacts__loading">Loading contacts...</p>
      <ul class="sms-contacts__list"></ul>
    </div>
  </body>
</html>
