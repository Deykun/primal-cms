<?php  $sitename="primal";  $title="Brak strony";  $metadescription="ds";  $active=1;  $cache=0;  $menu_name="Błąd 404";  $url="404";  $dirtheme="/themes/bear/";  $template="404";  $siteblocks='[]'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">404<\/h1>\r\n<p style=\"text-align: right;\"><strong>Przykro nam,<\/strong> ale szukana strona nie została znaleziona.<\/p>","":null}'; $block=json_decode( $blocks , true );  ?><!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brak strony - primal</title>

    <meta name="description" content="ds">
    <meta property="og:title" content="Brak strony - primal">
    <meta property="og:description" content="ds">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="/themes/bear/assets/css/stylesheet.min.css" rel="stylesheet">

</head>

<body>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 child-middle">
                        <nav class="nav-top">
                            <ul>
                                <li><a href="/">strona główa</a></li>
                                <li><a href="/dokumentacja">dokumentacja</a></li>
                                <li><a href="/demo">demo</a></li>
                                <li><a href="https://github.com/deykun" target="_blank"><i class="icon-flow-branch"></i> github</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-lg-9 bg-black child-middle">
                        <div class="text">
                            <h1 class="section-title" style="text-align: right;">404</h1>
<p style="text-align: right;"><strong>Przykro nam,</strong> ale szukana strona nie została znaleziona.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p><i class="icon-browser"></i> <strong>primal</strong> | 2018</p>
    </footer>
    <!--
    <div id="cookieInfo" style="display: none;">
        <p>Używamy plików <strong>cookies</strong> w celu ułatwienia korzystania z naszej strony. Brak zmiany w ustawieniach przeglądarki oznacza zgodę na ich wykorzystywanie.</p>
        <button id="eat-cookie">Rozumiem</button>
    </div>
-->
    <script src="assets/other/tinymce/tinymce.min.js"></script>
    <script src="assets/other/tinymce/langs/pl.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="/themes/bear/assets/js/script.js"></script>
</body>

</html>
