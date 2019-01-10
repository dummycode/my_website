<!DOCTYPE html>
<html lang="en">
<head>
    <title>Happy Valentine's Day!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Cutive+Mono);

        body {
            font: 16px/20px 'Cutive Mono', serif;
        }

        a {
            color: #222;
        }

        .wrap {
            max-width: 500px;
            margin: 30px auto;
            text-align: center;
        }

        .secret_message {
            margin-top: 10px;
            text-align: left;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrap">
            <p id="header">click <a href="#" class="start">here</a> to start</p>
            <div class="secret_message" data-text="Hey Ellie,<br>
                <p><center><strong>Happy Valentine's Day!</strong></center></p>
                You are awesome, you know that right?<br>
                But... here are a few specific reasons why <strong>I</strong> like you.<br><br>
                Disclaimer: list in no particular order<br><br>
                <strong>1011 reasons why I like you?</strong><br>
                <ul>
                    <li>You are awesome!</li>
                    <li>You share my love for Avatar (mostly Appa &#x1F60D;&#x1F60D;)</li>
                    <li>You are beautiful</li>
                    <li>You are intelligent</li>
                    <li>print(&quotYou code &#x1F60E;&quot)</li>
                    <li>You are caring</li>
                    <li>You are athletic</li>
                    <li>You always save me a spot in the CULC</li>
                    <li>You keep the goth side of me from revealing itself &#x1F609;</li>
                    <li>You are funny</li>
                    <li>You are smart enough to figure out why I have written 1011 but only mentioned 11 things
                        (see <a href='http://bit.ly/1FX4Q3H'>binary numbers</a> if 1301 hasn't got you up to speed yet ;)</li>
                </ul><br>
                <strong>- Henry &#x1F496;</strong>"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function typeWriter(text, n) {
            if (n < (text.length)) {
                $('.secret_message').html(text.substring(0, n + 1) + (n !== text.length - 1 ? "|" : ""));
                n++;
                setTimeout(function () {
                    typeWriter(text, n)
                }, 30);
            }
        }

        $('.start').click(function (e) {
            e.stopPropagation();
            var text = $('.secret_message').data('text');
            $("p:first").text("");
            setTimeout(function () {
              typeWriter(text, 0)
            }, 500);
        });
    </script>
</body>
</html>
