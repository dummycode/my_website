<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/sms.js"></script>
  </head>
  <body>
    <div class="sms">
      <p><a href="contacts">Manage Contacts</a><a href="messages">View Messages</a><a href="logout">Logout</a></p>
      <form id="sms__form" class="sms__form" autocomplete="off">
        <textarea name="message" placeholder="Enter message..." class="sms__message-field"></textarea>
        <span id="sms__message-field-count" class="sms__message-field-count">0/160</span>
        <input type="submit" value="Send">
        <p class="sms__form-result"></p>
      </form>
    </div>
  </body>
</html>
