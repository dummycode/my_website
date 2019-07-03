<?php
$page_title = "About";
$selected_page = "about";
$last_updated = 1545938900;
$pwd = '/about'
?>
<html>
    <?php require __DIR__ . '/../includes/head.php';?>
    <body>
        <div class="article">
        <!-- START OF HEADER -->
        <?php require __DIR__ . '/../includes/header.php';?>
        <!-- END OF HEADER -->

        <!-- START OF BODY -->
        <div class="body">
            <div class="main">
                <img src="https://104101110114121.s3.us-east-2.amazonaws.com/images/me.jpeg" class="headshot" />
                <p>
                    Hi. Yep, that's me. My name is Henry Harris. I am currently at 3rd year Computer Science major at the Georgia Institute of Technology, better known as Georgia Tech.
                    I am also a candidate for a minor in Computing and Business through the Denning Technology and Management program.
                </p>
                <p>
                    My story with computers began when I as a middle schooler, playing Minecraft with my two brothers on our private server.
                    Wanting to write custom server plugins, I started watching thenewboston's Java tutorials on YouTube. From the moment I saw the words "Hello World" pop up in my console, I knew programming was for me.
                    Since, I've taken AP Computer Science, chosen Computer Science as my major, worked two software engineering internships, built countless projects, and still continue to love it to this day.
                </p>
                <p>
                    In my free time I enjoy exercising and the great outdoors – specifically lifting weights, rock climbing, and hiking.
                    I also love to travel the world as evident in my <a href="/blog/fun">blog</a>. My favorite trip ever is the trip to Morocco I took while I studied abroad in Barcelona during the summer of 2018.
                    There, we visited Fes, toured the Atlas Mountains, road camels into the Sahara desert where we spent the night in traditional Berber tents, played Moroccan drums with
                    locals in Tingher Province, and navigated the bustling markets of Marrakech.
                </p>
            </div>
        </div>
        <!-- END OF BODY -->

        <!-- START OF SUPER FOOTER -->
        <?php require __DIR__ . '/../includes/super_footer.php';?>
        <!-- END OF SUPER FOOTER -->

        </div>
        <!-- END OF ARTICLE -->
    </body>
</html>
