<?php $sitename="primal"; $title="primal - bezbazowy system zarządzania treścią"; $metadescription="Darmowy bezbazowy system zarządzania treścią."; $active=1; $cache=0; $menu_name="Strona główna"; $url="home"; $cmscatalog="/"; $themecatalog="/themes/safari/"; $template="home"; $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true ); $blocks='{"top":"<h1 class=\"section-title\">primal<\/h1>\n<ul>\n<li>przyjazne linki<\/li>\n<li>edytor tekstowy<\/li>\n<li>pamięć podręczna<\/li>\n<li><strong>JSON<\/strong> zamiast MySQL<\/li>\n<\/ul>","simplicity":"<h2 class=\"section-title\" style=\"text-align: right;\" >prostota<\/h2><p style=\"text-align: right;\" >Szablony stron w zwykłym pliku <strong>.php<\/strong>.<\/p><p style=\"text-align: right;\" >Wystarczyło wstawić <span class=\"invert\">(block key=”simplicity”)<\/span> by wygenerować pole z <strong>edytorem tekstowym<\/strong> dla tej sekcji w panelu administracyjnym.<\/p>","todo":"<h2 class=\"section-title\" style=\"text-align: right;\" >to do<\/h2><ul style=\"text-align: right;\" ><li>dodawanie podstron<br><\/li><li>znacznik nawigacji <span class=\"invert\">(menu)<\/span><\/li><\/ul>","aboutauthor":"<p style=\"text-align: right;\" >autor<\/p><h2 class=\"section-title\" style=\"text-align: right;\" ><span style=\"opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;\" >@<\/span>deykun<\/h2>"}'; $block=json_decode( $blocks , true ); $admin=true; $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ?><!DOCTYPE html> <html lang="pl"> <head> <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>primal - bezbazowy system zarządzania treścią</title> <?php else: ?> <title>primal - bezbazowy system zarządzania treścią - primal</title> <?php endif ?> <meta name="description" content="Darmowy bezbazowy system zarządzania treścią."> <meta property="og:title" content="primal - bezbazowy system zarządzania treścią - primal"> <meta property="og:description" content="Darmowy bezbazowy system zarządzania treścią."> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-xl-3 child-middle"> <nav class="nav-top"> <ul> <li><a href="/" class="active">strona główa</a></li> <li><a href="/dokumentacja">dokumentacja</a></li> <li><a href="/demo">demo</a></li> <li><a href="https://github.com/deykun/primal-cms" target="_blank"><i class="icon-flow-branch"></i> github</a></li> </ul> </nav> </div> <div class="col-12 col-xl-9 bg-green child-middle about-img"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title">primal</h1> <ul> <li>przyjazne linki</li> <li>edytor tekstowy</li> <li>pamięć podręczna</li> <li><strong>JSON</strong> zamiast MySQL</li> </ul></div> </div> <img src="/upload/elephant.png"> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-6 bg-black child-middle"> <i class="icon-bg icon-code" aria-hidden="true"></i> </div> <div class="col-12 col-lg-6 bg-black child-middle"> <div class="text"> <div id="cms-field-simplicity" class="wysiwyg regular" data-block-key="simplicity" data-block-update="false"><h2 class="section-title" style="text-align: right;" >prostota</h2><p style="text-align: right;" >Szablony stron w zwykłym pliku <strong>.php</strong>.</p><p style="text-align: right;" >Wystarczyło wstawić <span class="invert">(block key=”simplicity”)</span> by wygenerować pole z <strong>edytorem tekstowym</strong> dla tej sekcji w panelu administracyjnym.</p></div> </div> </div> <div class="col-12 col-lg-6 bg-green child-middle"> <i class="icon-bg icon-traffic-cone" aria-hidden="true"></i> <div class="text"> <div id="cms-field-todo" class="wysiwyg regular" data-block-key="todo" data-block-update="false"><h2 class="section-title" style="text-align: right;" >to do</h2><ul style="text-align: right;" ><li>dodawanie podstron<br></li><li>znacznik nawigacji <span class="invert">(menu)</span></li></ul></div> </div> </div> <div class="col-12 col-lg-6 bg-white child-middle"> <div class="text"> <div id="cms-field-aboutauthor" class="wysiwyg regular" data-block-key="aboutauthor" data-block-update="false"><p style="text-align: right;" >autor</p><h2 class="section-title" style="text-align: right;" ><span style="opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;" >@</span>deykun</h2></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"><p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false">Akcepuję</div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

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
            <div class="cms-input chbox">
                <input id="active" name="active" type="checkbox" <?php if ($active==1 ) {echo 'checked'; } ?> >
                <span class="checkbox primal-icon-eye"></span>
                <label for="active">Wyświetlaj</label>
            </div>
            <div class="cms-input chbox">
                <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                <span class="checkbox primal-icon-clock"></span>
                <label class="admin-input-label" for="cache">Pamięć podręczna</label>
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
            <div class="cms-input">
                <input id="url" name="url" value="<?php echo $url; ?>" type="text" required <?php if ($url == '404') { echo 'disabled'; } ?>>
                <label for="url">Adres URL</label>
            </div>
            <div class="primal-hidden-fields">
            </div>
            <button class="primal-save">Zapisz <i class="primal-icon-upload"></i></button>
            <div class="cms-copyrights">
                Primal CMS - <a class="primal-link" href="<?php echo $cmscatalog; ?>index.php?page=<?php echo $page; ?>&action=logout">wyloguj</a>
            </div>
        </form>
    </div>
    
    <input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab" checked>
    <div id="primal-reaction"></div>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/langs/pl.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/js/script.js"></script></body> </html> 