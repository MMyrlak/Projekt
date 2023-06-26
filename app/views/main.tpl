<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <title>{$page_header|default:"Workout World"}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
    <link rel="stylesheet" href="{$conf->app_url}/assets/css/own.css" />
    <noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
    <script src="https://kit.fontawesome.com/cfee8e482b.js" crossorigin="anonymous"></script>
    
</head>
<body class="is-preload">
    <!-- Page Wrapper -->
    <div id="page-wrapper">
    <!-- Header -->
        <header id="header" class="alt">
            <h1>{$page_header|default:"Workout World"}</h1>
            <nav>
                <a href="#menu">Menu</a>
            </nav>
        </header>
    
    <!-- Menu -->
        <nav id="menu">
            <div class="inner">
                <h2>Menu</h2>
                <ul class="links">
                    {if $forms_view}
                        <li><a href="{url action='workoutListShow'}">Wróć</a></li>
                    {/if}
                    {if !isset($user->role)}
                    <li><a href="{url action='loginView'}">Zaloguj</a></li>
                    <li><a href="{url action='registerView'}">Zarejestruj</a></li>
                    {elseif $user->role == "user"}
                    <li><a href="{url action='myAccount'}">{$user->login}</a></li>
                    <li><a href="{url action='logout'}">Wyloguj</a></li>
                    {elseif $user->role == "admin"}
                    <li><a href="{url action='myAccount'}">{$user->login}</a></li>
                    <li><a href="{url action='workoutView'}">Dodaj Ćwiczenie</a></li>
                    <li><a href="{url action='logout'}">Wyloguj</a></li>
                    {/if}
                </ul>
		<a href="#" class="close">Close</a>
            </div>
        </nav>
                
    <!-- LOGO -->
    <section id="banner">
        <div class="inner">
            <h2>{$page_header|default:"Workout World"}</h2>
        </div>
    </section>
    <div class="inner">
        {block name=top}{/block}
        {block name=bottom}Default page content{/block}
    </div>
    <!-- Footer -->
        <section id="footer">
            <div class="inner">
                <ul class="copyright">
                    <li>&copy; Mikołaj Myrlak. 2023</li>
                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    <li><a href="https://www.fabrykasily.pl/atlas-cwiczen"> Fabryka Siły </a></li>
                </ul>
            </div>
        </section>
    </div>
<!-- Scripts -->
<script src="{$conf->app_url}/assets/js/ajax.js"></script>
<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
<script src="{$conf->app_url}/assets/js/jquery.scrollex.min.js"></script>
<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
<script src="{$conf->app_url}/assets/js/util.js"></script>
<script src="{$conf->app_url}/assets/js/main.js"></script>
</body>
</html>