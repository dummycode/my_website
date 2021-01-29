<!DOCTYPE html>
<html>
    <head>
        <title>Henry Harris | Temp</title>
        <link rel="stylesheet" href="/assets/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/style.css">

        <script src="/assets/js/jquery-3.4.1.min.js"></script>
        <script src="/assets/js/handlebars.runtime-v4.7.6.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-149253046-1');
            </script>
                <script src="/assets/js/templatesCompiled.js"></script>
            <script>
            const sidebar = Handlebars.templates['sidebar/sidebar']({})
            const sidebarFooterMobile = Handlebars.templates['footer/mobile']({})

            $(document).ready(function () {
            $("#sidebar").html(sidebar)
                $("#sidebar-footer--mobile").html(sidebarFooterMobile)
              })
        </script>
    </head>
    <body style="background-image: url('/assets/img/hexagontile.svg'); background-size: 50px 75px;">
        <h1>Temp</h1>
    </body>
</html>
