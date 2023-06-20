<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <title>{$page_header|default:"Workout World"}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
    <link rel="stylesheet" href="{$conf->app_url}/assets/css/own.css" />
    <noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
    <!-- Page Wrapper -->
    <div id="page-wrapper">
    <!-- Header -->
        <header id="header" class="alt">
            <h1>Workout World</h1>
            <nav>
                <a href="#menu">Menu</a>
            </nav>
        </header>
    
    <!-- Menu -->
        <nav id="menu">
            <div class="inner">
                <h2>Menu</h2>
                <ul class="links">
                    {if forms_view}
                    <li><a href="{$conf->action_url}workoutListShow">Wróć</a></li>
                    {/if}
                    <li><a href="{$conf->action_url}loginView">Zaloguj</a></li>
                    <li><a href="{$conf->action_url}registerView">Zarejestruj</a></li>
                </ul>
		<a href="#" class="close">Close</a>
            </div>
        </nav>
                
    <!-- LOGO -->
    <section id="banner">
        <div class="inner">
            <h2>Workout World</h2>
        </div>
    </section>
    
        {block name=top}Default page content{/block}
        {block name=bottom} Default page content{/block}
    <!-- Footer -->
        <section id="footer">
            <div class="inner">
                <ul class="copyright">
                    <li>&copy; Untitled Inc. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    <li>&copy; Mikołaj Myrlak. 2023</li></li>
                </ul>
            </div>
        </section>
    </div>
<!-- Scripts -->
<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
<script src="{$conf->app_url}/assets/js/jquery.scrollex.min.js"></script>
<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
<script src="{$conf->app_url}/assets/js/util.js"></script>
<script src="{$conf->app_url}/assets/js/main.js"></script>
</body>
</html>