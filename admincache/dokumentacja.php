<?php $sitename="primal"; $title="Dokumentacja"; $metadescription="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. "; $active=1; $cache=0; $menu_name="Dokumentacja"; $url="dokumentacja"; $cmscatalog="/"; $themecatalog="/themes/safari/"; $template="subpage"; $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>"}'; $siteblock=json_decode( $siteblocks , true ); $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\" >dokumentacja<\/h1><p style=\"text-align: right;\" >Listę działających tagów znajdziesz poniżej.<\/p>","content":"<p style=\"text-align: right;\" >Wkrótce ;)<span id=\"_mce_caret\" data-mce-bogus=\"1\" data-mce-type=\"format-caret\">﻿<\/span><\/p>"}'; $block=json_decode( $blocks , true ); $admin=true; $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ?><!DOCTYPE html> <html lang="pl"> <head> <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <title>Dokumentacja - primal</title> <meta name="description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. "> <meta property="og:title" content="Dokumentacja - primal"> <meta property="og:description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. "> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <ul> <li><a href="/">strona główa</a></li> <li><a href="/dokumentacja" class="active">dokumentacja</a></li> <li><a href="/demo">demo</a></li> <li><a href="https://github.com/deykun/primal-cms" target="_blank"><i class="icon-flow-branch"></i> github</a></li> </ul> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;" >dokumentacja</h1><p style="text-align: right;" >Listę działających tagów znajdziesz poniżej.</p></div> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> <div id="cms-field-content" class="wysiwyg regular" data-block-key="content" data-block-update="false"><p style="text-align: right;" >Wkrótce ;)<span id="_mce_caret" data-mce-bogus="1" data-mce-type="format-caret">﻿</span></p></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false"></div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

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
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/langs/pl.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/js/script.js"></script></body> </html> 