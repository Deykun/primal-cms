<?php  $dir_cms="/";  $dir_theme="/themes/safari/";  $site_name="primal";  $page_active="1";  $page_cache="0";  $page_menu_name="strona główna";  $page_template="home";  $page_url="home";  $page_title="primal - bezbazowy system zarządzania treścią";  $page_seo_index="1";  $page_meta_description="Darmowy nie wymagający bazy MySQL system zarządzania trescią.";  $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\">primal<\/h1>\n<ul>\n<li>przyjazne linki<\/li>\n<li>edytor tekstowy<\/li>\n<li>pamięć podręczna<\/li>\n<li><strong>JSON<\/strong> zamiast <strong>MySQL<\/strong><\/li>\n<\/ul>","simplicity":"<h2 class=\"section-title\" style=\"text-align: right;\">prostota<\/h2>\n<p style=\"text-align: right;\">Szablony stron w zwykłym pliku <strong>.php<\/strong>.<\/p>\n<p style=\"text-align: right;\">Wystarczyło wstawić <span class=\"invert\">(block key=”simplicity”)<\/span> by wygenerować pole z <strong>edytorem tekstowym<\/strong> dla tej sekcji w panelu administracyjnym.<\/p>","todo":"<h2 class=\"section-title\" style=\"text-align: right;\">to do<\/h2>\n<ul style=\"text-align: right;\">\n<li>dodawanie podstron<\/li>\n<\/ul>","aboutauthor":"<p style=\"text-align: right;\" >autor<\/p><h2 class=\"section-title\" style=\"text-align: right;\" ><span style=\"opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;\" >@<\/span>deykun<\/h2>"}'; $block=json_decode( $blocks , true );  $menus='{"top":[{"type":"cms","key":"home","url":"\/","active":true,"name":"strona główna"},{"type":"cms","key":"dokumentacja","url":"\/dokumentacja-cms","name":"dokumentacja"},{"type":"cms","key":"lorem","url":"\/formatowanie","name":"formatowanie"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}],"footer":[{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}]}'; $menu=json_decode( $menus , true );  $admin=false;  ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($page_template == 'home'): ?> <title>primal - bezbazowy system zarządzania treścią</title> <?php else: ?> <title>primal - bezbazowy system zarządzania treścią - primal</title> <?php endif ?> <meta name="description" content="Darmowy nie wymagający bazy MySQL system zarządzania trescią."> <meta property="og:title" content="primal - bezbazowy system zarządzania treścią - primal"> <meta property="og:description" content="(page_meta_description)"> <?php if ($page_seo_index): ?> <meta name="robots" content="index,follow" /> <?php else: ?> <meta name="robots" content="noindex,nofollow" /> <?php endif ?> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> 
<script>
    // Do not minify this!
</script>
 </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-xl-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; $rel = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } if ( isset($element['rel']) ) { $rel = ' rel="'.$element['rel'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$rel.' '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-xl-9 bg-green child-middle about-img"> <div class="text"> <h1 class="section-title">primal</h1> <ul> <li>przyjazne linki</li> <li>edytor tekstowy</li> <li>pamięć podręczna</li> <li><strong>JSON</strong> zamiast <strong>MySQL</strong></li> </ul> </div> <img src="/upload/elephant.png"> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-6 bg-black child-middle"> <i class="icon-bg icon-code" aria-hidden="true"></i> </div> <div class="col-12 col-lg-6 bg-black child-middle"> <div class="text"> <h2 class="section-title" style="text-align: right;">prostota</h2> <p style="text-align: right;">Szablony stron w zwykłym pliku <strong>.php</strong>.</p> <p style="text-align: right;">Wystarczyło wstawić <span class="invert">(block key=”simplicity”)</span> by wygenerować pole z <strong>edytorem tekstowym</strong> dla tej sekcji w panelu administracyjnym.</p> </div> </div> <div class="col-12 col-lg-6 bg-green child-middle"> <i class="icon-bg icon-traffic-cone" aria-hidden="true"></i> <div class="text"> <h2 class="section-title" style="text-align: right;">to do</h2> <ul style="text-align: right;"> <li>dodawanie podstron</li> </ul> </div> </div> <div class="col-12 col-lg-6 bg-white child-middle"> <div class="text"> <p style="text-align: right;" >autor</p><h2 class="section-title" style="text-align: right;" ><span style="opacity: 0.2; font-size: 25px; display: inline-block; vertical-align: middle; margin-right: 3px;" >@</span>deykun</h2> </div> </div> </div> </div> </section> </main> <footer> <p>primal - <strong>2018</strong><br></p> </footer> <div id="cookieInfo" style="display: none;"> <p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p> <button id="eat-cookie">Akcepuję</button> </div> <script src="(dir_theme)assets/js/script.js"></script> <link href="<?php echo $dir_cms; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">
<?php

   Global $lang;
   $lang = array();
   require(__DIR__.'/../admin/langs/en.php');

   function translate($key) {
        global $lang;
        
        if ( isset( $lang[$key] ) ) {
            return $lang[$key];
        } else { 
            return $key;
        }
    }
?>
<input id="prmial-admin-switch" name="primaladmin" type="checkbox" style="display:none;" checked>
<div id="primal-admin-panel">
    <input class="primal-tab-radio" id="tab-login-form" type="checkbox" name="primaltab">
    <div class="primal-tab" id="primal-cms-login-form">
        <form id="primal-login-form" action="index.php?page=login&action=login" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-login-form"><?php echo $site_name; ?> <i class="primal-icon-users"></i></label>
            <div class="cms-input">
                <input id="user" name="user" type="text" required>
                <label for="user">
                    <?php echo translate('field_user'); ?>
                </label>
            </div>
            <div class="cms-input">
                <input id="password" name="password" type="password" required>
                <label for="password">
                    <?php echo translate('field_password'); ?>
                </label>
            </div>
            <button class="primal-save">
                <?php echo translate('button_log_in'); ?>
                <i class="primal-icon-user"></i>
            </button>
        </form>
    </div>
</div>
<div id="primal-reaction"></div>
<script src="<?php echo $dir_cms; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
<script src="<?php echo $dir_cms; ?>admin/assets/other/tinymce/langs/pl.js"></script>
<script src="<?php echo $dir_cms; ?>admin/assets/js/script.js"></script></body> </html>