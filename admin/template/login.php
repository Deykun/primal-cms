<link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">
<div id="primal-admin-panel">
    <input class="primal-tab-radio" id="tab-login-form" type="checkbox" name="primaltab">
    <div class="primal-tab" id="primal-cms-login-form">
        <form id="primal-login-form" action="index.php?page=login&action=login" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-login-form"><?php echo $sitename; ?> <i class="primal-icon-users"></i></label>
            <div class="cms-input">
                <input id="user" name="user" type="text" required>
                <label for="user">Użytkownik</label>
            </div>
            <div class="cms-input">
                <input id="password" name="password" type="password" required>
                <label for="password">Hasło</label>
            </div>
            <button class="primal-save">Zaloguj się <i class="primal-icon-user"></i></button>
        </form>
    </div>
</div>
    <div id="primal-reaction"></div>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/langs/pl.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/js/script.js"></script>