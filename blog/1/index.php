<head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gist-embed/2.4/gist-embed.min.js"></script>
</head>

<body>
  <h1>brainteaser #1</h1>
  <p>
    shorten this Java code down to a single line* <br>
    no, you cannot just remove the newline characters. see below <br>
    needs to work for any positive integer value of max <br>
    <strong>must</strong> use a for loop <br> <br>
    <small>*singe line: one statement, aka one semicolon (excluding those used in the for loop)</small>
   </p>
  <code data-gist-id="9a6304e6bcc180ceefb82e8533b9f3ac" data-gist-hide-footer="true"></code>
  <div class="showAnswer">
    <p><a href="#">answer (click to view)</a></p>
  </div>
  <script>
    $(".showAnswer").click(function() {
      $(".code").toggle();
    });
  </script>
  <div class="code" hidden="true">
    <code data-gist-id="fc5cc52b90ebacd78c32813edf6cdcaf" data-gist-hide-footer="true"></code>
  </div>
</body>
