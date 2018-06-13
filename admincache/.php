<?php $sitename="primal"; $title="primal"; $metadescription=""; $active=0; $cache=0; $menu_name="strona główna"; $url=""; $cmscatalog="/"; $themecatalog="/themes/safari/"; $template="home"; $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true ); $blocks='{"top":"<h1 class=\"section-title\">primal<\/h1>\n<ul>\n<li>przyjazne linki<\/li>\n<li>edytor tekstowy<\/li>\n<li>pamięć podręczna<\/li>\n<li><strong>JSON<\/strong> zamiast MySQL<\/li>\n<\/ul>","simplicity":"<h2 class=\"section-title\" style=\"text-align: right;\" >prostota<\/h2><p style=\"text-align: right;\" >Szablony stron w zwykłym pliku <strong>.php<\/strong>.<\/p><p style=\"text-align: right;\" >Wystarczyło wstawić <span class=\"invert\">(block key=”simplicity”)<\/span> by wygenerować pole z <strong>edytorem tekstowym<\/strong> dla tej sekcji w panelu administracyjnym.<\/p>","todo":"<h2 class=\"section-title\" style=\"text-align: right;\">to do<\/h2>\n<ul style=\"text-align: right;\">\n<li>dodawanie podstron<\/li>\n<\/ul>","aboutauthor":"<p style=\"text-align: right;\" >autor<\/p><h2 class=\"section-title\" style=\"text-align: right;\" ><span style=\"opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;\" >@<\/span>deykun<\/h2>"}'; $block=json_decode( $blocks , true ); $menus='{"top":[{"type":"cms","url":"\/","active":true,"name":"strona główna"},{"type":"cms","url":"\/dokumentacja","name":"dokumentacja"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"<i class=\"icon-flow-branch\"><\/i> github","target":"_blank"}]}'; $menu=json_decode( $menus , true ); $admin=true; $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>primal</title> <?php else: ?> <title>primal - primal</title> <?php endif ?> <meta name="description" content=""> <meta property="og:title" content="primal - primal"> <meta property="og:description" content=""> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-xl-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-xl-9 bg-green child-middle about-img"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title">primal</h1> <ul> <li>przyjazne linki</li> <li>edytor tekstowy</li> <li>pamięć podręczna</li> <li><strong>JSON</strong> zamiast MySQL</li> </ul></div> </div> <img src="/upload/elephant.png"> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-6 bg-black child-middle"> <i class="icon-bg icon-code" aria-hidden="true"></i> </div> <div class="col-12 col-lg-6 bg-black child-middle"> <div class="text"> <div id="cms-field-simplicity" class="wysiwyg regular" data-block-key="simplicity" data-block-update="false"><h2 class="section-title" style="text-align: right;" >prostota</h2><p style="text-align: right;" >Szablony stron w zwykłym pliku <strong>.php</strong>.</p><p style="text-align: right;" >Wystarczyło wstawić <span class="invert">(block key=”simplicity”)</span> by wygenerować pole z <strong>edytorem tekstowym</strong> dla tej sekcji w panelu administracyjnym.</p></div> </div> </div> <div class="col-12 col-lg-6 bg-green child-middle"> <i class="icon-bg icon-traffic-cone" aria-hidden="true"></i> <div class="text"> <div id="cms-field-todo" class="wysiwyg regular" data-block-key="todo" data-block-update="false"><h2 class="section-title" style="text-align: right;">to do</h2> <ul style="text-align: right;"> <li>dodawanie podstron</li> </ul></div> </div> </div> <div class="col-12 col-lg-6 bg-white child-middle"> <div class="text"> <div id="cms-field-aboutauthor" class="wysiwyg regular" data-block-key="aboutauthor" data-block-update="false"><p style="text-align: right;" >autor</p><h2 class="section-title" style="text-align: right;" ><span style="opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;" >@</span>deykun</h2></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"><p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false">Akcepuję</div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

<?php 
   function adminMenuHTML( $menu ) {
        $menuHTML = '<ul>';
        foreach( $menu as $key => $element ) {


            /* Paramaters */
            $elementClass = '';
            $target = '';

            if ( isset($element['active']) ) { $elementClass .= 'active '; }
            if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } 

            $dataTarget = 'false';
            if ( isset( $element['target'] ) ) {
                $dataTarget = 'true';
            }
            
            $elementHTML = '<li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" data-target="'.$dataTarget.'">';

            switch ( $element['type']) {
                case "url":
                    $elementHTML .= '<i class="d-title primal-icon-browser" data-title="Strona WWW"></i> ';
                    break;
                case "cms":
                    $elementHTML .= '<i class="d-title primal-icon-book" data-title="Podstrona"></i> ';
                    break;
            }
            
            $elementHTML .= $element['name'];
            
            
            $elementHTML .= '<span class="cms-menu-admin"><i class="primal-icon-windows d-title" data-title="W nowym oknie"></i> <i class="primal-icon-trash d-title" data-title="Usuń"></i></span>';


            $elementHTML .= '</li>';

            $menuHTML .= $elementHTML;
        }
       
        $menuHTML .= '<li><i class="primal-icon-plus"></i> Dodaj</li>';

        $menuHTML .= '</ul>';

        return $menuHTML;
    }

//    echo '<pre>';
//        print_r( $menu );
//    echo '</pre>';
?>


<div id="primal-admin-panel">
    <input class="primal-tab-radio" id="tab-edit-page" type="radio" name="primaltab">
    <div class="primal-tab" id="primal-cms-edit-page">
        <form id="primal-edit-page-form" action="index.php?page=<?php echo $url; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-edit-page">ta podstrona <i class="primal-icon-write"></i></label>
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
                <input id="url" name="url" value="<?php echo $url; ?>" type="text" required <?php if ($url=='404' ) { echo 'disabled'; } ?>>
                <label for="url">Adres URL</label>
            </div>
            <div class="primal-hidden-fields">
            </div>
            <button class="primal-save">Zaktualizuj stronę <i class="primal-icon-upload"></i></button>
        </form>
    </div>
    <input class="primal-tab-radio" id="tab-global" type="radio" name="primaltab" checked>
    <div class="primal-tab" id="primal-cms-edit-page">
        <form id="primal-edit-page-form" action="index.php?page=<?php echo $url; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-global">serwis <i class="primal-icon-book"></i></label>
            <div class="cms-input">
                <input id="title" name="title" value="<?php echo $sitename; ?>" type="text" required>
                <label for="title">Nazwa portalu</label>
            </div>
            <div class="cms-input primal-menu-input">
                
                <?php
                    foreach( $menu as $index => $element ) {
                        echo '<label>Menu "'.$index.'"</label>';
                        echo adminMenuHTML( $element );
                    }
                ?>
            </div>
            <div class="primal-hidden-fields">
            </div>
            <button class="primal-save">Zaktualizuj portal <i class="primal-icon-upload"></i></button>
        </form>
    </div>

    <input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab">
    <div class="primal-quick-nav">
        <label class="primal-quick-btn" for="tab-cms-close-all"><i class="primal-icon-up"></i></label>
        <a class="primal-quick-btn primal-ajax-link" href="<?php echo $cmscatalog; ?>index.php?page=<?php echo $page; ?>&action=logout"><i class="primal-icon-moon"></i></a>
    </div>
</div>

<div id="primal-reaction"></div>
<script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
<script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/langs/pl.js"></script>
<script src="<?php echo $cmscatalog; ?>admin/assets/js/script.js"></script>
</body> </html> 