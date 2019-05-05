<link href="<?php echo $dir_cms; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

<?php

   Global $lang;
   $lang = array();
   require(__DIR__.'/../admin/langs/'.$admin_lang.'.php');

   function translate($key) {
        global $lang;
        
        if ( isset( $lang[$key] ) ) {
            return $lang[$key];
        } else { 
            return $key;
        }
    }

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

    <input id="prmial-admin-switch" name="primaladmin" type="checkbox" style="display:none;" checked>
    <label id="primal-admin-panel-trigger" for="prmial-admin-switch"><i class="primal-icon-cog"></i></label>
    <div id="primal-admin-panel">
        <input class="primal-tab-radio" id="tab-edit-page" type="radio" name="primaltab">
        <div class="primal-tab" id="primal-cms-edit-page">
            <form id="primal-edit-page-form" action="index.php?page=<?php echo $page_url; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
                <label class="primal-tab-label primal-yellow" for="tab-edit-page">
                    <?php echo $page_menu_name; ?> <i class="primal-icon-write"></i>
                </label>
                <div class="cms-input">
                    <input id="title" name="title" value="<?php echo $page_title; ?>" type="text" required>
                    <label for="title">
                        <?php echo translate('field_title'); ?>
                    </label>
                </div>
                <div class="cms-input">
                    <input id="menu_name" name="menu_name" value="<?php echo $page_menu_name; ?>" type="text" required>
                    <label for="menu_name">
                        <?php echo translate('field_menu_name'); ?>
                    </label>
                </div>
                <div class="cms-input" data-characters="<?php echo strlen($page_meta_description);?> <?php echo translate('field_tip_metadescription_characters'); ?>">
                    <textarea id="metadescription" name="metadescription"><?php echo $page_meta_description; ?></textarea>
                    <label for="metadescription">
                        <?php echo translate('field_metadescription'); ?>
                    </label>
                </div>
                <div class="cms-input chbox">
                    <input id="active" name="active" type="checkbox" <?php if ($page_active) {echo 'checked'; } ?> >
                    <i class="checkbox primal-icon-eye"></i>
                    <label for="active">
                        <?php echo translate('field_active'); ?>
                    </label>
                </div>
                <div class="cms-input chbox">
                    <input id="seo_index" name="seo_index" type="checkbox" <?php if ($page_seo_index) {echo 'checked'; } ?> >
                    <i class="checkbox primal-icon-calendar"></i>
                    <label class="admin-input-label" for="seo_index">
                        <?php echo translate('field_seoindex'); ?>
                    </label>
                </div>

                <div class="cms-input chbox">
                    <input id="cache" name="cache" type="checkbox" <?php if ($page_cache) {echo 'checked'; } ?> >
                    <i class="checkbox primal-icon-clock"></i>
                    <label class="admin-input-label" for="cache">
                        <?php echo translate('field_cache'); ?>
                    </label>
                </div>


                <div class="cms-input cms-select">
                    <select name="template" id="template">
                    <?php 
                        foreach($availableTemplates as $templateOption) {

                            if ($page_template == $templateOption) { 
                                echo '<option value="'.$templateOption.'" selected>'.$templateOption.' ('.translate('select_active').')</option>' ;
                            } else {
                                echo '<option value="'.$templateOption.'">'.$templateOption.'</option>' ;
                            }
                        }
                    ?>
                </select>
                    <label for="template">
                        <?php echo translate('field_template'); ?>
                    </label>
                </div>
                <div class="cms-input">
                    <input id="url" name="url" value="<?php echo $page_url; ?>" type="text" required data-check="true" data-check-length="3">
                    <label for="url">
                        <?php echo translate('field_url'); ?>
                    </label>
                </div>
                <div class="primal-hidden-fields">
                </div>
                <button class="primal-save">
                    <?php echo translate('button_update_subpage'); ?>
                    <i class="primal-icon-upload"></i>
                </button>
            </form>
        </div>
        <!--    <input class="primal-tab-radio" id="tab-global" type="radio" name="primaltab" checked>-->
        <input class="primal-tab-radio" id="tab-global" type="radio" name="primaltab">
        <div class="primal-tab" id="primal-cms-edit-portal">
            <form id="primal-edit-portal-form" action="index.php?page=<?php echo $page_url; ?>&action=site_update" method="post" class="primal-tab-content primal-form">
                <label class="primal-tab-label primal-yellow" for="tab-global">
                    <?php echo translate('tab_site_title'); ?> 
                    <i class="primal-icon-book"></i>
                </label>
                <div class="cms-input">
                    <input id="site_name" name="site_name" value="<?php echo $site_name; ?>" type="text" required>
                    <label for="site_name">
                        <?php echo translate('field_sitename'); ?>
                    </label>
                </div>
                <div class="cms-input cms-select">
                    <select name="homepage" id="homepage">
                    <?php 
                        foreach($availablePages as $index => $pageOption) {

                            if ($homepage == $index) { 
                                echo '<option value="'.$index.'" selected>'.$pageOption.' ('.translate('select_active').')</option>' ;
                            } else {
                                echo '<option value="'.$index.'">'.$pageOption.'</option>' ;
                            }
                        }
                    ?>
                </select>
                    <label for="homepage">
                        <?php echo translate('field_homepage'); ?>
                    </label>
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
                            <input id="addlink" name="addmenuitem" type="checkbox">
                            <i class="checkbox primal-icon-plus"></i>
                            <label for="addlink">
                                <?php echo translate('field_addlink'); ?>
                            </label>
                            <div class="more-when-checked">
                                <div class="cms-input option">
                                    <i class="checkbox primal-icon-reply"></i>
                                    <label for="addlink">
                                        <?php echo translate('cancel'); ?>
                                    </label>
                                </div>
                                <div class="cms-input">
                                    <input id="itemname" type="text" name="itemname" type="text" placeholder="GitHub">
                                    <label for="itemname">
                                        <?php echo translate('field_menu_name'); ?>
                                    </label>
                                </div>
                                <div class="cms-input">
                                    <input id="itemurl" type="text" name="itemurl" type="text" placeholder="https://github.com/deykun/primal-cms">
                                    <label for="itemurl">
                                        <?php echo translate('field_url'); ?>
                                    </label>
                                </div>
                                <div class="cms-input cms-select">
                                    <select name="itemmenuurl" id="itemmenuurl">
                              <?php
                                foreach( $menu as $index => $element ) {
                                    echo '<option value="'.$index.'">'.$index.'</option>'; 
                                }
                                ?>
                            </select>
                                    <label for="itemmenuurl">
                                        <?php echo translate('field_menu'); ?>
                                    </label>
                                </div>
                                <span id="primal-addlink" class="primal-save">
                                    <?php echo translate('button_add_element'); ?>
                                    <i class="checkbox primal-icon-plus"></i>
                                </span>
                            </div>
                        </div>
                        <div class="cms-input rdbox option">
                            <input id="addcmspage" name="addmenuitem" type="checkbox">
                            <i class="checkbox primal-icon-plus"></i>
                            <label for="addcmspage">
                                <?php echo translate('field_menu'); ?>
                            </label>
                            <div class="more-when-checked">
                                <div class="cms-input option">
                                    <i class="checkbox primal-icon-reply"></i>
                                    <label for="addcmspage">
                                        <?php echo translate('cancel'); ?>
                                    </label>
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
                                    <label for="itemcmspage">
                                        <?php echo translate('field_itemcmspage'); ?>
                                    </label>
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
                                <span id="primal-addcmslink" class="primal-save">
                                    <?php echo translate('button_add_element'); ?>
                                    <i class="checkbox primal-icon-plus"></i>
                                </span>
                            </div>
                        </div>
                        <input id="closeaddmenu" name="addmenuitem" type="radio" style="display:none;">
                    </div>

                    <div class="primal-hidden-fields">
                    </div>
                    <button class="primal-save">
                        <?php echo translate('button_update_site'); ?>
                        <i class="primal-icon-upload"></i>
                    </button>

                    <a class="primal-save primal-save-sm primal-ajax-link" href="<?php echo $dir_cms; ?>index.php?page=<?php echo $page; ?>&action=clear_cache">
                        <?php echo translate('button_clear_cache'); ?>
                        <i class="primal-icon-trash"></i>
                    </a>
            </form>
        </div>

        <input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab">
        <div class="primal-quick-nav">
            <span class="primal-quick-btn"><?php echo $admin_user_name; ?><i class="primal-icon-user"></i></span>
            <label class="primal-quick-btn" for="prmial-admin-switch">
                <?php echo translate('button_close_settings'); ?>
                <i class="primal-icon-cog"></i>
            </label>
            <a class="primal-quick-btn primal-ajax-link" href="<?php echo $dir_cms; ?>index.php?page=<?php echo $page; ?>&action=logout">
                <?php echo translate('button_log_out'); ?>
                <i class="primal-icon-moon"></i>
            </a>
        </div>
    </div>

    <div id="primal-reaction"></div>
    <script src="<?php echo $dir_cms; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $dir_cms; ?>admin/assets/other/tinymce/langs/pl.js"></script>
    <script src="<?php echo $dir_cms; ?>admin/assets/js/script.js"></script>