<link href="<?php echo $dir_cms; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">
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
<script src="<?php echo $dir_cms; ?>admin/assets/js/script.js"></script>