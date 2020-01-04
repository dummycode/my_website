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
    <div class="sms">
      <p class="sms__header">
        <a href="contacts">Manage Contacts</a>
        <a href="groups">Manage Groups</a>
        <a href="messages">View Messages</a>
        <a href="logout">Logout</a>
      </p>
      <form id="sms__form" class="sms__form" autocomplete="off">
        <textarea name="message" placeholder="Enter message..." class="sms__message-field"></textarea>
        <select type="select" name="group" class="sms-group-select">
          <option>Loading...</option>
        </select>
        <span id="sms__message-field-count" class="sms__message-field-count">0/160</span>
        <input type="submit" value="Send">
        <p class="sms__form-result"></p>
      </form>
    </div>
  </body>
</html>
