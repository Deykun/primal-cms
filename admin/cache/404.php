<?php  $sitename="primal";  $title="Brak strony";  $metadescription="ds";  $active=1;  $cache=0;  $menu_name="Błąd 404";  $url="404";  $dirtheme="/../themes/bear/";  $template="404";  $siteblocks='[]'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">404<\/h1>\r\n<p style=\"text-align: right;\"><strong>Przykro nam,<\/strong> ale szukana strona nie została znaleziona.<\/p>","":null}'; $block=json_decode( $blocks , true );  $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true );  ?><!DOCTYPE html>
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
    <link href="/../themes/bear/assets/css/stylesheet.min.css" rel="stylesheet">

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
                            <div id="cms-field-top" class="wysiwyg regular"  data-wysiwyg-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;">404</h1>
<p style="text-align: right;"><strong>Przykro nam,</strong> ale szukana strona nie została znaleziona.</p></div>
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
    <script src="/../themes/bear/assets/js/script.js"></script>
<link href="assets/css/stylesheet.min.css" rel="stylesheet">

    <input class="primal-tab-radio" id="tab-edit-page" type="checkbox" name="primaltab">
    <div class="primal-tab" id="primal-cms-edit-page">
        <form id="primal-edit-page-form" action="index.php?page=<?php echo $page; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-edit-page">edytuj tę stronę <i class="primal-icon-browser"></i></label>

            <div class="cms-input">
                <input id="title" name="title" value="<?php echo $title; ?>" type="text" required>
                <label for="title">Tytuł strony</label>
            </div>

            <div class="cms-input">
                <input id="menu_name" name="menu_name" value="<?php echo $menu_name; ?>" type="text" required>
                <label for="menu_name">Nazwa w menu</label>
            </div>

            <div class="cms-input">
                <textarea id="metadescription" name="metadescription"><?php echo $metadescription; ?></textarea>
                <label for="metadescription">Opis meta</label>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="cms-input">
                        <input id="active" name="active" type="checkbox" <?php if ($active==1 ) {echo 'checked'; } ?> >
                        <label for="active">Wyświetlaj</label>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="cms-input">
                        <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                        <label class="admin-input-label" for="cache">Pamięć podręczna</label>
                    </div>
                </div>
            </div>
            <div class="cms-input">
                <select name="template" id="template">
                    <?php 
                        foreach($availableTemplates as $templateOption) {

                            if ($template == $templateOption) { 
                                echo '<option value="'.$templateOption.'" selected>'.$templateOption.' (obecny)</option>' ;
                            } else {
                                echo '<option value="'.$templateOption.'">'.$templateOption.'</option>' ;
                            }
                        }
                    ?>
                </select>
                <label for="template">Szablon</label>
            </div>
            <div class="primal-hidden-fields">
                
            </div>
            <button class="primal-save">Zapisz <i class="primal-icon-upload"></i></button>
            <div class="cms-copyrights">
                Primal CMS
            </div>
        </form>
    </div>
    
    <input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab">
    <div id="primal-reaction"></div>
</body>

</html>
