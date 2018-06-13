<?php  $sitename="primal";  $title="Jak edytować stronę bez MySQL w systemie zarządzania treścią";  $metadescription="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP.";  $active=1;  $cache=0;  $seoindex=1;  $menu_name="dokumentacja";  $url="dokumentacja-cms";  $cmscatalog="/";  $themecatalog="/themes/safari/";  $template="subpage";  $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">dokumentacja CMSa<\/h1>\n<p style=\"text-align: right;\">Szablony w <strong>primal<\/strong> są zwykłymi plikami <strong>php<\/strong>, możesz więc korzystać bezpośrednio z dokumentacji PHP jeśli na swojej stronie stworzonej z użyciem tego systemu zarządzania treścią chcesz użyć czegoś bardziej skomplikowanego np. skorzystać z funkcji <strong>@mail<\/strong>.<\/p>\n<p style=\"text-align: right;\">Blok z WYSIWYG wygenerujesz prostym zwrotem <strong>(block key=&#39;top&#39;)<\/strong>, a w <strong>PHP<\/strong> możesz go wywołać lub sprawdzić czy nie jest pusty analizując wartość zmiennej <strong>$block[&#39;top&#39;]<\/strong>.<\/p>","content":"<h2 style=\"text-align: right;\">Składnia związana bezpośrednio z CMSem<\/h2>\n<p> <\/p>\n<h3 style=\"text-align: left;\">(block key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Generuje edytor WYSIWYG przypisany do wybranej strony.<\/p>\n<p style=\"text-align: justify;\">Ta podstrona na przykład ma wybrany szablon <strong>subpage<\/strong>, ten tekst znajduje się w bloku <strong>(block key=&#39;content&#39;)<\/strong>, a blok wyżej przez <strong>(blok key=&#39;top&#39;)<\/strong>.<\/p>\n<p style=\"text-align: justify;\">Treść wspomnianych bloków jest dostępna w szablonie php jako <strong>$block[&#39;top&#39;]<\/strong> oraz <strong>$block[&#39;content&#39;]<\/strong>.<\/p>\n<h3 style=\"text-align: justify;\">(siteblock key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Generuje edytor WYSIWYG przypisany do całego serwisu.<\/p>\n<p style=\"text-align: justify;\">Dla tej podstrony i wszystkich innych jest to np. <strong>(siteblock key=&#39;footer&#39;)<\/strong> przechowujący stopkę. Edycja stopki na jednej podstronie zmienia ją na wszystkich.<\/p>\n<p>Zmienna <strong>$siteblock[&#39;footer&#39;] <\/strong>przechowuje wartość tego bloku.<\/p>\n<h3>(subtemplate key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Jeden wspólny podszablon dla wielu podstron np. treści bloku - którą można dzięki temu edytować w jednym miejscu.<\/p>\n<h2 style=\"text-align: right;\"> <\/h2>\n<h2 style=\"text-align: right;\">Składnia niezwiązana bezpośrednio z CMS<\/h2>\n<p> <\/p>\n<p style=\"text-align: justify;\">Wszystkie szablony oparte są o w pełni funkcjonalny <strong>php <\/strong>którego funkcje są dostępne w CMSie. <strong>Nie musisz<\/strong> więc uczyć się żadnej dodatkowej składni.<\/p>\n<h3>Warunki<\/h3>\n<p style=\"text-align: left;\">Przykłady warunków:<\/p>\n<h4 style=\"text-align: right;\">Unikalne zachowanie &lt;title&gt; dla szablonu strony głównej<\/h4>\n<pre>&lt;&#63;php if ($template == &#39;home&#39;): &#63;&gt;<br \/> &lt;title&gt;(title)&lt;\/title&gt;<br \/>&lt;&#63;php else: &#63;&gt;<br \/> &lt;title&gt;(title) - (sitename)&lt;\/title&gt;<br \/>&lt;&#63;php endif &#63;&gt;<\/pre>\n<p> <\/p>\n<h4 style=\"text-align: right;\"><code><!--\"php endif \"--><\/code><\/h4>\n<h4 style=\"text-align: right;\">Wywołanie sekcji jeśli ma treść<code><br \/><\/code><\/h4>\n<pre><code>&lt;&#63;php if isset(block[&#39;content&#39;]) || $admin == true : &#63;&gt;<br \/> &lt;section&gt;(block key=&#39;content&#39;)&lt;\/section&gt;<br \/>&lt;&#63;php endif &#63;&gt; <\/code><code><\/code><\/pre>"}'; $block=json_decode( $blocks , true );  $menus='{"top":[{"type":"cms","key":"home","url":"\/","name":"strona główna"},{"type":"cms","key":"dokumentacja","url":"\/dokumentacja-cms","active":true,"name":"dokumentacja"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","rel":"nofollow"}],"footer":[{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","rel":"nofollow"}]}'; $menu=json_decode( $menus , true );  $admin=false;  ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>Jak edytować stronę bez MySQL w systemie zarządzania treścią</title> <?php else: ?> <title>Jak edytować stronę bez MySQL w systemie zarządzania treścią - primal</title> <?php endif ?> <meta name="description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP."> <meta property="og:title" content="Jak edytować stronę bez MySQL w systemie zarządzania treścią - primal"> <meta property="og:description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP."> <?php if ($seoindex): ?> <meta name="robots" content="index,follow" /> <?php else: ?> <meta name="robots" content="noindex,nofollow" /> <?php endif ?> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> 
<script>
    // Do not minify this!
</script>
 </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } if ( isset($element['rel']) ) { $target = ' rel="'.$element['rel'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <h1 class="section-title" style="text-align: right;">dokumentacja CMSa</h1> <p style="text-align: right;">Szablony w <strong>primal</strong> są zwykłymi plikami <strong>php</strong>, możesz więc korzystać bezpośrednio z dokumentacji PHP jeśli na swojej stronie stworzonej z użyciem tego systemu zarządzania treścią chcesz użyć czegoś bardziej skomplikowanego np. skorzystać z funkcji <strong>@mail</strong>.</p> <p style="text-align: right;">Blok z WYSIWYG wygenerujesz prostym zwrotem <strong>(block key=&#39;top&#39;)</strong>, a w <strong>PHP</strong> możesz go wywołać lub sprawdzić czy nie jest pusty analizując wartość zmiennej <strong>$block[&#39;top&#39;]</strong>.</p> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> <h2 style="text-align: right;">Składnia związana bezpośrednio z CMSem</h2> <p> </p> <h3 style="text-align: left;">(block key=&#39;name&#39;)</h3> <p style="text-align: justify;">Generuje edytor WYSIWYG przypisany do wybranej strony.</p> <p style="text-align: justify;">Ta podstrona na przykład ma wybrany szablon <strong>subpage</strong>, ten tekst znajduje się w bloku <strong>(block key=&#39;content&#39;)</strong>, a blok wyżej przez <strong>(blok key=&#39;top&#39;)</strong>.</p> <p style="text-align: justify;">Treść wspomnianych bloków jest dostępna w szablonie php jako <strong>$block[&#39;top&#39;]</strong> oraz <strong>$block[&#39;content&#39;]</strong>.</p> <h3 style="text-align: justify;">(siteblock key=&#39;name&#39;)</h3> <p style="text-align: justify;">Generuje edytor WYSIWYG przypisany do całego serwisu.</p> <p style="text-align: justify;">Dla tej podstrony i wszystkich innych jest to np. <strong>(siteblock key=&#39;footer&#39;)</strong> przechowujący stopkę. Edycja stopki na jednej podstronie zmienia ją na wszystkich.</p> <p>Zmienna <strong>$siteblock[&#39;footer&#39;] </strong>przechowuje wartość tego bloku.</p> <h3>(subtemplate key=&#39;name&#39;)</h3> <p style="text-align: justify;">Jeden wspólny podszablon dla wielu podstron np. treści bloku - którą można dzięki temu edytować w jednym miejscu.</p> <h2 style="text-align: right;"> </h2> <h2 style="text-align: right;">Składnia niezwiązana bezpośrednio z CMS</h2> <p> </p> <p style="text-align: justify;">Wszystkie szablony oparte są o w pełni funkcjonalny <strong>php </strong>którego funkcje są dostępne w CMSie. <strong>Nie musisz</strong> więc uczyć się żadnej dodatkowej składni.</p> <h3>Warunki</h3> <p style="text-align: left;">Przykłady warunków:</p> <h4 style="text-align: right;">Unikalne zachowanie &lt;title&gt; dla szablonu strony głównej</h4> <pre>&lt;&#63;php if ($template == &#39;home&#39;): &#63;&gt;<br /> &lt;title&gt;(title)&lt;/title&gt;<br />&lt;&#63;php else: &#63;&gt;<br /> &lt;title&gt;(title) - (sitename)&lt;/title&gt;<br />&lt;&#63;php endif &#63;&gt;</pre> <p> </p> <h4 style="text-align: right;"><code><!--"php endif "--></code></h4> <h4 style="text-align: right;">Wywołanie sekcji jeśli ma treść<code><br /></code></h4> <pre><code>&lt;&#63;php if isset(block[&#39;content&#39;]) || $admin == true : &#63;&gt;<br /> &lt;section&gt;(block key=&#39;content&#39;)&lt;/section&gt;<br />&lt;&#63;php endif &#63;&gt; </code><code></code></pre> </div> </div> </div> </div> </section> </main> <footer> <p>primal - <strong>2018</strong><br></p> </footer> <div id="cookieInfo" style="display: none;"> <p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p> <button id="eat-cookie">Akcepuję</button> </div> <script src="/themes/safari/assets/js/script.js"></script> </body> </html>