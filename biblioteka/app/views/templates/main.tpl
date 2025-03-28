<!DOCTYPE HTML>
<!--
    Library System by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>{$page_title|default:"Biblioteka Miejska"}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="{$page_description|default:"Twoje miejsce dla książek i wiedzy"}">
    <link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
    <noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
    <script type="text/javascript" src="{$conf->app_url}/js/functions.js"></script>
</head>

<body class="is-preload">
    <div id="wrapper" class="fade-in">
        <header id="header">
            <h2>Biblioteka Miejska<h2>
        </header>
        <nav id="nav">
            <ul class="links">
                <li><a href="{$conf->action_root}aboutUs">O Bibliotece</a></li>
                <li><a href="{$conf->action_root}catalog">Katalog</a></li>
                <li><a href="{$conf->action_root}rent">Wypożycz książkę</a></li>
                {if isset($smarty.session.user)}
                    <li><a>Zalogowano jako: 
                        {$smarty.session.user->name} {$smarty.session.user->surname}</a></li>
                    <li><a href="{$conf->action_root}rentHistory">Historia wypożyczeń</a></li>
                    {if isset($smarty.session.user->roles) && in_array('Bibliotekarz', $smarty.session.user->roles)}
                        <li class="dropdown">
                            <a href="#" class="dropbtn">Panel Pracownika</a>
                            <div class="dropdown-content">
                                <a href="{$conf->action_root}employeeRents">Zarządzanie wypożyczeniami</a>
                                <a href="{$conf->action_root}addUser">Dodaj użytkownika</a>
                                <a href="{$conf->action_root}displayUsers">Edytuj użytkownika</a>
                            </div>
                        </li>
                    {/if}
                    <li style="margin-left:auto;"><a style="font-size:25px;" href="{$conf->action_root}logout" >Wyloguj</a></li>
                {else}
                    <li><a href="{$conf->action_root}loginShow"">Zaloguj</a></li>
                    <li><a href="{$conf->action_root}registerShow">Rejestracja</a></li>
                {/if}
            </ul>
        </nav>
        
        <div id="main">
            {block name=top}{/block}
            {block name=messages}
            {if $msgs->isMessage()}
                <div class="messages bottom-margin">
                    <ul>
                        {foreach $msgs->getMessages() as $msg}
                            {strip}
                                <li class="msg {if $msg->isError()}error{/if}{if $msg->isWarning()}warning{/if} {if $msg->isInfo()}info{/if}">{$msg->text}</li>
                            {/strip}
                        {/foreach}
                    </ul>
                </div>
            {/if}
        {/block}
        </div>

        <footer id="footer">
            <section>
                <form method="post" action="#">
                    <div class="fields">
                        <div class="field">
                            <label for="name">Imię</label>
                            <input type="text" name="name" id="name" />
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                        <div class="field">
                            <label for="message">Wiadomość</label>
                            <textarea name="message" id="message" rows="3" style="resize: none"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Wyślij wiadomość" /></li>
                    </ul>
                </form>
            </section>
            <section class="split contact">
                <section class="alt">
                    <h3>Adres</h3>
                    <p>ul. Książkowa 10, Warszawa</p>
                </section>
                <section>
                    <h3>Telefon</h3>
                    <p>555 123 456</p>
                </section>
                <section>
                    <h3>Adres email</h3>
                    <p>kontakt@bibliotekamiejska.pl</p>
                </section>
                <section>
                    <h3>Copyright</h3>
                    <ul class="icons alt">
                        <li>&copy; {block name=footer}Biblioteka Miejska{/block}. Wszelkie prawa zastrzeżone.</li>
                        <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    </ul>
                </section>
            </section>
        </footer>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

        </div>
    </body>
</html>