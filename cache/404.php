<?php  $dir_cms="/";  $dir_theme="/themes/safari/";  $site_name="primal";  $page_active="1";  $page_cache="1";  $page_menu_name="404";  $page_template="subpage";  $page_url="404";  $page_title="Brak treści - 404";  $page_seo_index="0";  $page_meta_description="";  $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">Błąd 404<\/h1>\n<p style=\"text-align: right;\"><strong>Przykro nam<\/strong> ale podana strona nie została znaleziona.<\/p>"}'; $block=json_decode( $blocks , true );  $menus='{"top":[{"type":"cms","key":"home","url":"\/","name":"strona główna"},{"type":"cms","key":"dokumentacja","url":"\/dokumentacja-cms","name":"dokumentacja"},{"type":"cms","key":"lorem","url":"\/formatowanie","name":"formatowanie"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}],"footer":[{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}]}'; $menu=json_decode( $menus , true );  $admin=false;  ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($page_template == 'home'): ?> <title>Brak treści - 404</title> <?php else: ?> <title>Brak treści - 404 - primal</title> <?php endif ?> <meta name="description" content=""> <meta property="og:title" content="Brak treści - 404 - primal"> <meta property="og:description" content="(page_meta_description)"> <?php if ($page_seo_index): ?> <meta name="robots" content="index,follow" /> <?php else: ?> <meta name="robots" content="noindex,nofollow" /> <?php endif ?> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> 
<script>
    // Do not minify this!
</script>
 </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; $rel = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } if ( isset($element['rel']) ) { $rel = ' rel="'.$element['rel'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$rel.' '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <h1 class="section-title" style="text-align: right;">Błąd 404</h1> <p style="text-align: right;"><strong>Przykro nam</strong> ale podana strona nie została znaleziona.</p> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> </div> </div> </div> </div> </section> </main> <footer> <p>primal - <strong>2018</strong><br></p> </footer> <div id="cookieInfo" style="display: none;"> <p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p> <button id="eat-cookie">Akcepuję</button> </div> <script src="/themes/safari/assets/js/script.js"></script> </body> </html>