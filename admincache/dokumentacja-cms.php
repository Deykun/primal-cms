<?php $sitename="primal"; $title="Jak edytować stronę bez MySQL w systemie zarządzania treścią"; $metadescription="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP."; $active=1; $cache=0; $index=1; $menu_name="dokumentacja"; $url="dokumentacja-cms"; $cmscatalog="/"; $themecatalog="/themes/safari/"; $template="subpage"; $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true ); $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">dokumentacja CMSa<\/h1>\n<p style=\"text-align: right;\">Szablony w <strong>primal<\/strong> są zwykłymi plikami <strong>php<\/strong>, możesz więc korzystać bezpośrednio z dokumentacji PHP jeśli na swojej stronie stworzonej z użyciem tego systemu zarządzania treścią chcesz użyć czegoś bardziej skomplikowanego np. skorzystać z funkcji <strong>@mail<\/strong>.<\/p>\n<p style=\"text-align: right;\">Blok z WYSIWYG wygenerujesz prostym zwrotem <strong>(block key=&#39;top&#39;)<\/strong>, a w PHP możesz go wywołać lub sprawdzić czy nie jest pusty analizując wartość zmiennej <strong>$block[&#39;top&#39;]<\/strong>.<\/p>","content":"<h2 style=\"text-align: right;\">Składnia związana bezpośrednio z CMSem<\/h2>\n<p> <\/p>\n<h3 style=\"text-align: left;\">(block key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Generuje edytor WYSIWYG przypisany do wybranej strony.<\/p>\n<p style=\"text-align: justify;\">Ta podstrona na przykład ma wybrany szablon <strong>subpage<\/strong>, ten tekst znajduje się w bloku <strong>(block key=&#39;content&#39;)<\/strong>, a blok wyżej przez <strong>(blok key=&#39;top&#39;)<\/strong>.<\/p>\n<p style=\"text-align: justify;\">Treść wspomnianych bloków jest dostępna w szablonie php jako <strong>$block[&#39;top&#39;]<\/strong> oraz <strong>$block[&#39;content&#39;]<\/strong>.<\/p>\n<h3 style=\"text-align: justify;\">(siteblock key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Generuje edytor WYSIWYG przypisany do całego serwisu.<\/p>\n<p style=\"text-align: justify;\">Dla tej podstrony i wszystkich innych jest to np. <strong>(siteblock key=&#39;footer&#39;)<\/strong> przechowujący stopkę. Edycja stopki na jednej podstronie zmienia ją na wszystkich.<\/p>\n<p>Zmienna <strong>$siteblock[&#39;footer&#39;] <\/strong>przechowuje wartość tego bloku.<\/p>\n<h3>(subtemplate key=&#39;name&#39;)<\/h3>\n<p style=\"text-align: justify;\">Jeden wspólny podszablon dla wielu podstron np. treści bloku - którą można dzięki temu edytować w jednym miejscu.<\/p>\n<h2 style=\"text-align: right;\"> <\/h2>\n<h2 style=\"text-align: right;\">Składnia niezwiązana bezpośrednio z CMS<\/h2>\n<p> <\/p>\n<p style=\"text-align: justify;\">Wszystkie szablony oparte są o w pełni funkcjonalny <strong>php <\/strong>którego funkcje są dostępne w CMSie. <strong>Nie musisz<\/strong> więc uczyć się żadnej dodatkowej składni.<\/p>\n<h3>Warunki<\/h3>\n<p style=\"text-align: left;\">Przykłady warunków:<\/p>\n<h4 style=\"text-align: right;\">Unikalne zachowanie &lt;title&gt; dla szablonu strony głównej<\/h4>\n<pre>&lt;&#63;php if ($template == &#39;home&#39;): &#63;&gt;<br \/> &lt;title&gt;(title)&lt;\/title&gt;<br \/>&lt;&#63;php else: &#63;&gt;<br \/> &lt;title&gt;(title) - (sitename)&lt;\/title&gt;<br \/>&lt;&#63;php endif &#63;&gt;<\/pre>\n<p> <\/p>\n<h4 style=\"text-align: right;\"><code><!--\"php endif \"--><\/code><\/h4>\n<h4 style=\"text-align: right;\">Wywołanie sekcji jeśli ma treść<code><br \/><\/code><\/h4>\n<pre><code>&lt;&#63;php if isset(block[&#39;content&#39;]) || $admin == true : &#63;&gt;<br \/> &lt;section&gt;(block key=&#39;content&#39;)&lt;\/section&gt;<br \/>&lt;&#63;php endif &#63;&gt; <\/code><code><\/code><\/pre>"}'; $block=json_decode( $blocks , true ); $menus='{"top":[{"type":"cms","url":"\/","name":"strona główna"},{"type":"cms","url":"\/dokumentacja-cms","active":true,"name":"dokumentacja"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"<i class=\"icon-flow-branch\"><\/i> github","target":"_blank"}]}'; $menu=json_decode( $menus , true ); $admin=true; $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true ); $homepage="home"; $availablePagesArray='{"home":"strona główna","dokumentacja":"dokumentacja","lorem":"Formatowanie","404":"Błąd 404"}'; $availablePages=json_decode( $availablePagesArray , true ); ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>Jak edytować stronę bez MySQL w systemie zarządzania treścią</title> <?php else: ?> <title>Jak edytować stronę bez MySQL w systemie zarządzania treścią - primal</title> <?php endif ?> <meta name="description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP."> <meta property="og:title" content="Jak edytować stronę bez MySQL w systemie zarządzania treścią - primal"> <meta property="og:description" content="Tworzenie pól WYSIWY w systemie zarządzania treścią primal - flat file CMS. Z bazą danych umieszczoną w pliku JSON na serwerze FTP."> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;">dokumentacja CMSa</h1> <p style="text-align: right;">Szablony w <strong>primal</strong> są zwykłymi plikami <strong>php</strong>, możesz więc korzystać bezpośrednio z dokumentacji PHP jeśli na swojej stronie stworzonej z użyciem tego systemu zarządzania treścią chcesz użyć czegoś bardziej skomplikowanego np. skorzystać z funkcji <strong>@mail</strong>.</p> <p style="text-align: right;">Blok z WYSIWYG wygenerujesz prostym zwrotem <strong>(block key=&#39;top&#39;)</strong>, a w PHP możesz go wywołać lub sprawdzić czy nie jest pusty analizując wartość zmiennej <strong>$block[&#39;top&#39;]</strong>.</p></div> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> <div id="cms-field-content" class="wysiwyg regular" data-block-key="content" data-block-update="false"><h2 style="text-align: right;">Składnia związana bezpośrednio z CMSem</h2> <p> </p> <h3 style="text-align: left;">(block key=&#39;name&#39;)</h3> <p style="text-align: justify;">Generuje edytor WYSIWYG przypisany do wybranej strony.</p> <p style="text-align: justify;">Ta podstrona na przykład ma wybrany szablon <strong>subpage</strong>, ten tekst znajduje się w bloku <strong>(block key=&#39;content&#39;)</strong>, a blok wyżej przez <strong>(blok key=&#39;top&#39;)</strong>.</p> <p style="text-align: justify;">Treść wspomnianych bloków jest dostępna w szablonie php jako <strong>$block[&#39;top&#39;]</strong> oraz <strong>$block[&#39;content&#39;]</strong>.</p> <h3 style="text-align: justify;">(siteblock key=&#39;name&#39;)</h3> <p style="text-align: justify;">Generuje edytor WYSIWYG przypisany do całego serwisu.</p> <p style="text-align: justify;">Dla tej podstrony i wszystkich innych jest to np. <strong>(siteblock key=&#39;footer&#39;)</strong> przechowujący stopkę. Edycja stopki na jednej podstronie zmienia ją na wszystkich.</p> <p>Zmienna <strong>$siteblock[&#39;footer&#39;] </strong>przechowuje wartość tego bloku.</p> <h3>(subtemplate key=&#39;name&#39;)</h3> <p style="text-align: justify;">Jeden wspólny podszablon dla wielu podstron np. treści bloku - którą można dzięki temu edytować w jednym miejscu.</p> <h2 style="text-align: right;"> </h2> <h2 style="text-align: right;">Składnia niezwiązana bezpośrednio z CMS</h2> <p> </p> <p style="text-align: justify;">Wszystkie szablony oparte są o w pełni funkcjonalny <strong>php </strong>którego funkcje są dostępne w CMSie. <strong>Nie musisz</strong> więc uczyć się żadnej dodatkowej składni.</p> <h3>Warunki</h3> <p style="text-align: left;">Przykłady warunków:</p> <h4 style="text-align: right;">Unikalne zachowanie &lt;title&gt; dla szablonu strony głównej</h4> <pre>&lt;&#63;php if ($template == &#39;home&#39;): &#63;&gt;<br /> &lt;title&gt;(title)&lt;/title&gt;<br />&lt;&#63;php else: &#63;&gt;<br /> &lt;title&gt;(title) - (sitename)&lt;/title&gt;<br />&lt;&#63;php endif &#63;&gt;</pre> <p> </p> <h4 style="text-align: right;"><code><!--"php endif "--></code></h4> <h4 style="text-align: right;">Wywołanie sekcji jeśli ma treść<code><br /></code></h4> <pre><code>&lt;&#63;php if isset(block[&#39;content&#39;]) || $admin == true : &#63;&gt;<br /> &lt;section&gt;(block key=&#39;content&#39;)&lt;/section&gt;<br />&lt;&#63;php endif &#63;&gt; </code><code></code></pre></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"><p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false">Akcepuję</div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

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
                    $elementHTML .= '<i class="d-title primal-icon-book" data-title="Podstrona CMS"></i> ';
                    break;
            }
            
            $elementHTML .= $element['name'];
            
            
            $elementHTML .= '<span class="cms-menu-admin"><i class="primal-icon-calendar d-title" data-title="Indeksuj w wyszukiwarkach"></i> <i class="primal-icon-windows d-title" data-title="otwieraj w nowym oknie"></i> <i class="primal-icon-trash d-title" data-title="Usuń z menu"></i></span>';


            $elementHTML .= '</li>';

            $menuHTML .= $elementHTML;
        }

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
            <!--            <label class="primal-tab-label primal-yellow" for="tab-edit-page">ta podstrona <i class="primal-icon-write"></i></label>-->
            <label class="primal-tab-label primal-yellow" for="tab-edit-page"><?php echo $menu_name; ?> <i class="primal-icon-write"></i></label>
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
                <i class="checkbox primal-icon-eye"></i>
                <label for="active">Wyświetlaj stronę</label>
            </div>
            <div class="cms-input chbox">
                <input id="index" name="index" type="checkbox" <?php if ($index==1 ) {echo 'checked'; } ?> >
                <i class="checkbox primal-icon-calendar"></i>
                <label class="admin-input-label" for="index">Indeksuj w wyszukiwarkach</label>
            </div>

            <div class="cms-input chbox">
                <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                <i class="checkbox primal-icon-clock"></i>
                <label class="admin-input-label" for="cache">Korzystaj z pamięci podręcznej</label>
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
                <input id="url" name="url" value="<?php echo $url; ?>" type="text" required <?php if ($url=='404' ) { echo 'disabled'; } ?> data-check="true" data-check-length="3">
                <label for="url">Adres URL</label>
            </div>
            <div class="primal-hidden-fields">
            </div>
            <button class="primal-save">Zaktualizuj stronę <i class="primal-icon-upload"></i></button>
        </form>
    </div>
<!--    <input class="primal-tab-radio" id="tab-global" type="radio" name="primaltab" checked>-->
    <input class="primal-tab-radio" id="tab-global" type="radio" name="primaltab">
    <div class="primal-tab" id="primal-cms-edit-page">
        <form id="primal-edit-page-form" action="index.php?page=<?php echo $url; ?>&action=site_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-global">serwis <i class="primal-icon-book"></i></label>
            <div class="cms-input">
                <input id="sitename" name="sitename" value="<?php echo $sitename; ?>" type="text" required>
                <label for="sitename">Nazwa portalu</label>
            </div>
            <div class="cms-input">
                <select name="homepage" id="homepage">
                    <?php 
                        foreach($availablePages as $index => $pageOption) {

                            if ($homepage == $index) { 
                                echo '<option value="'.$index.'" selected>'.$pageOption.' (obecna)</option>' ;
                            } else {
                                echo '<option value="'.$index.'">'.$pageOption.'</option>' ;
                            }
                        }
                    ?>
                </select>
                <label for="homepage">Strona główna</label>
            </div>
            <div class="cms-input primal-menu-input">
                <?php
                    foreach( $menu as $index => $element ) {
                        echo '<label>Menu "'.$index.'"</label>';
                        echo adminMenuHTML( $element );
                    }
                ?>
            </div>
            <!-- new menu item -->

            <div class="cms-input primal-menu-item">
                <div class="cms-input rdbox option">
                    <input id="addlink" name="addmenuitem" type="checkbox" >
                    <i class="checkbox primal-icon-plus"></i>
                    <label for="addlink">Dodaj link</label>
                    <div class="more-when-checked">
                        <div class="cms-input option">
                            <i class="checkbox primal-icon-reply"></i>
                            <label for="addlink">Anuluj</label>
                        </div>
                        <div class="cms-input">
                            <input id="itemname" type="text" name="itemname" type="text" placeholder="np. GitHub">
                            <label for="itemname">Nazwa w menu</label>
                        </div>
                        <div class="cms-input">
                            <input id="itemurl" type="text" name="itemurl" type="text" placeholder="np. https://github.com/deykun/primal-cms">
                            <label for="itemurl">Adres url</label>
                        </div>
                        <span id="primal-addlink" class="primal-save">Dodaj element <i class="checkbox primal-icon-plus"></i></span>
                    </div>
                </div>
                <div class="cms-input rdbox option">
                    <input id="addcmspage" name="addmenuitem" type="checkbox" >
                    <i class="checkbox primal-icon-plus"></i>
                    <label for="addcmspage">Dodaj podstronę</label>
                    <div class="more-when-checked">
                        <div class="cms-input option">
                            <i class="checkbox primal-icon-reply"></i>
                            <label for="addcmspage">Anuluj</label>
                        </div>
                        <div class="cms-input">
                            <select name="itemcmspage" id="itemcmspage">
                                <?php 
                                    foreach($availablePages as $index => $pageOption) {
                                        if ($index != 404) {
                                            echo '<option value="'.$index.'">'.$pageOption.'</option>' ;   
                                        }
                                    }
                                ?>
                            </select>
                            <label for="itemcmspage">Podstrona CMS</label>
                        </div>
                        <span class="primal-save">Dodaj element <i class="checkbox primal-icon-plus"></i></span>
                    </div>
                </div>
                <input id="closeaddmenu" name="addmenuitem" type="radio" style="display:none;">
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