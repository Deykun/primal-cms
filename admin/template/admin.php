<link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

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

    echo '<pre>';
        print_r( $menu );
    echo '</pre>';
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
