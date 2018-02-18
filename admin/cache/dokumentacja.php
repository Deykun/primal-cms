<?php  $sitename="primal";  $title="Dokumentacja";  $metadescription="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. ";  $active=1;  $cache=0;  $menu_name="Dokumentacja";  $url="dokumentacja";  $dirtheme="/../themes/bear/";  $template="subpage";  $siteblocks='[]'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">dokumentacja<\/h1>\r\n<p style=\"text-align: right;\">Listę działających tag&oacute;w znajdziesz poniżej.<\/p>","content":"<p style=\"text-align: right;\" >Wkrótce ;)<span id=\"_mce_caret\" data-mce-bogus=\"1\" data-mce-type=\"format-caret\">﻿<\/span><\/p>"}'; $block=json_decode( $blocks , true );  $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true );  ?><!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentacja - primal</title>

    <meta name="description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. ">
    <meta property="og:title" content="Dokumentacja - primal">
    <meta property="og:description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. ">

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
                                <li><a href="/dokumentacja" class="active">dokumentacja</a></li>
                                <li><a href="/demo">demo</a></li>
                                <li><a href="https://github.com/deykun" target="_blank"><i class="icon-flow-branch"></i> github</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-lg-9 bg-black child-middle">
                        <div class="text">
                            <div id="cms-field-top" class="wysiwyg regular"  data-wysiwyg-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;">dokumentacja</h1>
<p style="text-align: right;">Listę działających tag&oacute;w znajdziesz poniżej.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9 offset-lg-3 bg-white">
                        <div class="text">
                            <div id="cms-field-content" class="wysiwyg regular"  data-wysiwyg-key="content" data-block-update="false"><p style="text-align: right;" >Wkrótce ;)<span id="_mce_caret" data-mce-bogus="1" data-mce-type="format-caret">﻿</span></p></div>
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
