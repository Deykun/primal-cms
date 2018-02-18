<?php  $sitename="primal";  $title="bezbazowy system zarządzania treścią";  $metadescription="Darmowy bezbazowy system zarządzania treścią.";  $active=1;  $cache=0;  $menu_name="Strona główna";  $url="home";  $dirtheme="/../themes/bear/";  $template="home";  $siteblocks='[]'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\">primal<\/h1>\r\n<ul>\r\n<li>przyjazne linki<\/li>\r\n<li>edytor tekstowy<\/li>\r\n<li>pamięć podręczna<\/li>\r\n<li><strong>JSON<\/strong> zamiast MySQL<\/li>\r\n<\/ul>","simplicity":"<h2 class=\"section-title\" style=\"text-align: right;\">prostota<\/h2>\r\n<p style=\"text-align: right;\">Szablony stron w zwykłym pliku <strong>.php<\/strong>.<\/p>\r\n<p style=\"text-align: right;\">Wystarczyło wstawić <span class=\"invert\">(block name=&rdquo;simplicity&rdquo;)<\/span> by wygenerować pole z <strong>edytorem tekstowym<\/strong> dla tej sekcji w panelu administracyjnym.<\/p>","todo":"<h2 class=\"section-title\" style=\"text-align: right;\">to do<\/h2>\r\n<ul style=\"text-align: right;\">\r\n<li>strona logowania<\/li>\r\n<li>znacznik nawigacji <span class=\"invert\">(menu)<\/span><\/li>\r\n<\/ul>","aboutauthor":"<p style=\"text-align: right;\" >autor<\/p><h2 class=\"section-title\" style=\"text-align: right;\" ><span style=\"opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;\" >@<\/span>deykun<\/h2>"}'; $block=json_decode( $blocks , true );  $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true );  ?><!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>primal - bezbazowy system zarządzania treścią</title>

    <meta name="description" content="Darmowy bezbazowy system zarządzania treścią.">
    <meta property="og:title" content="bezbazowy system zarządzania treścią - primal">
    <meta property="og:description" content="Darmowy bezbazowy system zarządzania treścią.">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="/../themes/bear/assets/css/stylesheet.min.css" rel="stylesheet">

</head>
<body>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-3 child-middle">
                        <nav class="nav-top">
                            <ul>
                                <li><a href="/" class="active">strona główa</a></li>
                                <li><a href="/dokumentacja">dokumentacja</a></li>
                                <li><a href="/demo">demo</a></li>
                                <li><a href="https://github.com/deykun" target="_blank"><i class="icon-flow-branch"></i> github</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-xl-9 bg-green child-middle about-img">
                        <div class="text">
                            <div id="cms-field-top" class="wysiwyg regular"  data-wysiwyg-key="top" data-block-update="false"><h1 class="section-title">primal</h1>
<ul>
<li>przyjazne linki</li>
<li>edytor tekstowy</li>
<li>pamięć podręczna</li>
<li><strong>JSON</strong> zamiast MySQL</li>
</ul></div>
                        </div>
                        <img src="/upload/elephant.png">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 bg-black child-middle">
                        <i class="icon-bg icon-code" aria-hidden="true"></i>
                        <div class="text">
                            <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa quibusdam laborum quaerat cumque, architecto enim beatae animi autem, quam mollitia magnam ratione molestiae.</p>-->
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 bg-black child-middle">
                        <div class="text">
                            <div id="cms-field-simplicity" class="wysiwyg regular"  data-wysiwyg-key="simplicity" data-block-update="false"><h2 class="section-title" style="text-align: right;">prostota</h2>
<p style="text-align: right;">Szablony stron w zwykłym pliku <strong>.php</strong>.</p>
<p style="text-align: right;">Wystarczyło wstawić <span class="invert">(block name=&rdquo;simplicity&rdquo;)</span> by wygenerować pole z <strong>edytorem tekstowym</strong> dla tej sekcji w panelu administracyjnym.</p></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 bg-green child-middle">
                        <i class="icon-bg icon-traffic-cone" aria-hidden="true"></i>
                        <div class="text">
                            <div id="cms-field-todo" class="wysiwyg regular"  data-wysiwyg-key="todo" data-block-update="false"><h2 class="section-title" style="text-align: right;">to do</h2>
<ul style="text-align: right;">
<li>strona logowania</li>
<li>znacznik nawigacji <span class="invert">(menu)</span></li>
</ul></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 bg-white child-middle">
                        <div class="text">
                            <div id="cms-field-aboutauthor" class="wysiwyg regular"  data-wysiwyg-key="aboutauthor" data-block-update="false"><p style="text-align: right;" >autor</p><h2 class="section-title" style="text-align: right;" ><span style="opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;" >@</span>deykun</h2></div>
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
