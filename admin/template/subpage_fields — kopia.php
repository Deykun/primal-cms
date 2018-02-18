<link href="assets/css/stylesheet.min.css" rel="stylesheet">
<!--
<div id="primal-cms">
    <buttton id="primal-trigger" class="primal-btn"><i class="icon-news"></i></buttton>
    <form action="index.php?page=<?php echo $page; ?>&action=page_update" method="post" class="primal-form content">
        <div class="admin-input">
            <input id="title" name="title" value="<?php echo $title; ?>" type="text" required>
            <label for="title">Tytuł strony</label>
        </div>
        <div class="admin-input">
            <input id="menu_name" name="menu_name" value="<?php echo $menu_name; ?>" type="text" required>
            <label for="menu_name">Nazwa w menu</label>
        </div>
        <div class="admin-input">
            <textarea id="metadescription" name="metadescription"><?php echo $metadescription; ?></textarea>
            <label for="metadescription">Opis meta</label>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="admin-input">
                    <input id="active" name="active" type="checkbox" <?php if ($active == 1) {echo 'checked'; } ?> >
                    <label for="active">Wyświetlaj</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="admin-input">
                    <input id="cache" name="cache" type="checkbox" <?php if ($cache == 1) {echo 'checked'; } ?> >
                    <label class="admin-input-label" for="cache">Pamięć podręczna</label>
                </div>
            </div>
        </div>
        <div class="admin-input">
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
        <button id="primal-save" class="primal-btn">Zapisz <i class="icon-publish"></i></button>
    </form>
</div>
-->

<input class="primal-tab-radio" id="tab-edit-page" type="radio" name="primaltab">
<div class="primal-tab" id="primal-cms-edit-page">
    <label class="primal-tab-label" for="tab-edit-page"><i class="icon-news"></i></label>
    <form action="index.php?page=<?php echo $page; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
        <h1>edytuj tę stronę <label class="primal-tab-close-label" for="tab-cms-close-all"><i class="icon-cross"></i></label></h1>
        <div class="admin-input">
            <input id="title" name="title" value="<?php echo $title; ?>" type="text" required>
            <label for="title">Tytuł strony</label>
        </div>
        <div class="admin-input">
            <input id="menu_name" name="menu_name" value="<?php echo $menu_name; ?>" type="text" required>
            <label for="menu_name">Nazwa w menu</label>
        </div>
        <div class="admin-input">
            <textarea id="metadescription" name="metadescription"><?php echo $metadescription; ?></textarea>
            <label for="metadescription">Opis meta</label>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="admin-input">
                    <input id="active" name="active" type="checkbox" <?php if ($active==1 ) {echo 'checked'; } ?> >
                    <label for="active">Wyświetlaj</label>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="admin-input">
                    <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                    <label class="admin-input-label" for="cache">Pamięć podręczna</label>
                </div>
            </div>
        </div>
        <div class="admin-input">
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
        <button id="primal-save" class="primal-btn">Zapisz <i class="icon-publish"></i></button>
    </form>
</div>

<input class="primal-tab-radio" id="tab-cms-settings" type="radio" name="primaltab">
<div class="primal-tab" id="primal-cms-edit-settings">
    <label class="primal-tab-label" for="tab-cms-settings"><i class="icon-cog"></i></label>
    <form action="index.php?page=<?php echo $page; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
        <h1>ustawienia portalu <label class="primal-tab-close-label" for="tab-cms-close-all"><i class="icon-cross"></i></label></h1>
        <p>W krótce ustawienia CMSa.</p>
    </form>
</div>

<input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab">

<div id="primal-reaction"></div>
