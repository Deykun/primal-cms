<?php  $sitename="primal";  $title="Brak treści";  $metadescription="";  $active=1;  $cache=0;  $seoindex=0;  $menu_name="Błąd 404";  $url="404";  $cmscatalog="/";  $themecatalog="/themes/safari/";  $template="subpage";  $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true );  $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">404<\/h1>\r\n<p style=\"text-align: right;\"><strong>Przykro nam,<\/strong> ale szukana strona nie została znaleziona.<\/p>"}'; $block=json_decode( $blocks , true );  $menus='{"top":[{"type":"cms","key":"home","url":"\/","name":"strona główna"},{"type":"cms","key":"dokumentacja","url":"\/dokumentacja-cms","name":"dokumentacja"},{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}],"footer":[{"type":"url","url":"https:\/\/github.com\/deykun\/primal-cms","name":"github","target":"_blank","rel":"nofollow"}]}'; $menu=json_decode( $menus , true );  $admin=true;  $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true );  $homepage="home"; $availablePagesArray='{"home":"strona główna","dokumentacja":"dokumentacja","lorem":"Formatowanie","404":"Błąd 404"}'; $availablePages=json_decode( $availablePagesArray , true );  ?><!DOCTYPE html> <html lang="pl"> <head> <?php $key = []; $key["name"] = "header"; ?><meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>Brak treści</title> <?php else: ?> <title>Brak treści - primal</title> <?php endif ?> <meta name="description" content=""> <meta property="og:title" content="Brak treści - primal"> <meta property="og:description" content=""> <?php if ($seoindex): ?> <meta name="robots" content="index,follow" /> <?php else: ?> <meta name="robots" content="noindex,nofollow" /> <?php endif ?> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> 
<script>
    // Do not minify this!
</script>
 </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <?php $key = []; $key["name"] = "menu"; $key["menu"] = "top"; ?><?php if (!function_exists('menuHTML')) { function menuHTML( $menu ) { $menuHTML = '<ul>'; foreach( $menu as $key => $element ) { /* Paramaters */ $elementClass = ''; $target = ''; $rel = ''; if ( isset($element['active']) ) { $elementClass .= 'active '; } if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } if ( isset($element['rel']) ) { $rel = ' rel="'.$element['rel'].'" '; } $elementHTML = '<li>'; $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$rel.' '.$target.'>'; $elementHTML .= $element['name']; $elementHTML .= '</a>'; if ( isset( $element['menu'] ) ) { $elementHTML .= menuHTML( $element['menu'] ); } $elementHTML .= '</li>'; $menuHTML .= $elementHTML; } $menuHTML .= '</ul>'; return $menuHTML; } } echo menuHTML( $menu[$key['menu']] ); ?> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;">404</h1> <p style="text-align: right;"><strong>Przykro nam,</strong> ale szukana strona nie została znaleziona.</p></div> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> <div id="cms-field-content" class="wysiwyg regular" data-block-key="content" data-block-update="false"></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"><p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false">Akcepuję</div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

<?php 
   function adminMenuHTML( $name, $menu ) {
        $menuHTML = '<ul data-name="'.$name.'">';
        foreach( $menu as $key => $element ) {


            /* Paramaters */
            $elementClass = '';
            $target = '';

            $dataTarget = 'false';
            $dataRel = 'false';
            $dataUrl = '';
            $dataKey = '';
            
            if ( isset($element['active']) ) { $elementClass .= 'active '; }
            if ( isset($element['target']) ) { $dataTarget = 'true'; } 
            if ( isset($element['rel']) ) { $dataRel = 'true'; } 
            if ( isset($element['url']) ) { $dataUrl = $element['url']; } 
            if ( isset($element['key']) ) { $dataKey = $element['key']; } 
            
            $elementHTML = '<li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" data-type="'.$element['type'].'" data-target="'.$dataTarget.'" data-rel="'.$dataRel.'" data-url="'.$dataUrl.'" data-key="'.$dataKey.'" data-name="'.str_replace('"','&quot;',$element['name']).'">';

            switch ( $element['type']) {
                case "url":
                    $elementHTML .= '<i class="d-title primal-icon-browser" data-title="Strona WWW"></i> ';
                    break;
                case "cms":
                    $elementHTML .= '<i class="d-title primal-icon-book" data-title="Podstrona CMS"></i> ';
                    break;
            }
            
            $elementHTML .= $element['name'];
            
            
            $elementHTML .= '<span class="cms-menu-admin"><i class="primal-icon-calendar d-title" data-title="Indeksuj w wyszukiwarkach"></i> <i class="primal-icon-windows d-title" data-title="Otwieraj w nowym oknie"></i> <i class="primal-icon-trash d-title" data-title="Usuń z menu"></i></span>';


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
            <div class="cms-input" data-characters="<?php echo strlen($metadescription);?> z.">
                <textarea id="metadescription" name="metadescription"><?php echo $metadescription; ?></textarea>
                <label for="metadescription">Opis meta</label> 
            </div>
            <div class="cms-input chbox">
                <input id="active" name="active" type="checkbox" <?php if ($active==1 ) {echo 'checked'; } ?> >
                <i class="checkbox primal-icon-eye"></i>
                <label for="active">Wyświetlaj stronę</label>
            </div>
            <div class="cms-input chbox">
                <input id="seoindex" name="seoindex" type="checkbox" <?php if ($seoindex==1 ) {echo 'checked'; } ?> >
                <i class="checkbox primal-icon-calendar"></i>
                <label class="admin-input-label" for="seoindex">Indeksuj w wyszukiwarkach</label>
            </div>

            <div class="cms-input chbox">
                <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                <i class="checkbox primal-icon-clock"></i>
                <label class="admin-input-label" for="cache">Korzystaj z pamięci podręcznej</label>
            </div>


            <div class="cms-input cms-select">
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
    <div class="primal-tab" id="primal-cms-edit-portal">
        <form id="primal-edit-portal-form" action="index.php?page=<?php echo $url; ?>&action=site_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-global">serwis <i class="primal-icon-book"></i></label>
            <div class="cms-input">
                <input id="sitename" name="sitename" value="<?php echo $sitename; ?>" type="text" required>
                <label for="sitename">Nazwa portalu</label>
            </div>
            <div class="cms-input cms-select">
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
            <?php
                foreach( $menu as $key => $element ) {
                    echo '<div class="cms-input primal-menu-input" data-menu="'.$key.'">';
                    echo '<label>Menu "'.$key.'"</label>';
                    echo adminMenuHTML( $key, $element );
                    echo '</div>';
                }
            ?>
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
                        <div class="cms-input cms-select">
                            <select name="itemmenuurl" id="itemmenuurl">
                              <?php
                                foreach( $menu as $index => $element ) {
                                    echo '<option value="'.$index.'">'.$index.'</option>'; 
                                }
                                ?>
                            </select>
                            <label for="itemmenuurl">Menu</label>
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
                        <div class="cms-input cms-select">
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
                         <div class="cms-input cms-select">
                            <select name="itemmenucms" id="itemmenucms">
                              <?php
                                foreach( $menu as $index => $element ) {
                                    echo '<option value="'.$index.'">'.$index.'</option>'; 
                                }
                                ?>
                            </select>
                            <label for="itemmenucms">Menu</label>
                        </div>
                        <span id="primal-addcmslink" class="primal-save">Dodaj element <i class="checkbox primal-icon-plus"></i></span>
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