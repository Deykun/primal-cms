<?php $sitename="primal"; $title="Formatowanie"; $metadescription=""; $active=1; $cache=0; $menu_name="Formatowanie"; $url="lorem"; $cmscatalog="/"; $themecatalog="/themes/safari/"; $template="subpage"; $siteblocks='{"footer":"<p>primal - <strong>2018<\/strong><br><\/p>","cookieInfo":"<p>Używamy plików <strong>cookies<\/strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies<\/strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.<\/p>","cookieOK":"Akcepuję"}'; $siteblock=json_decode( $siteblocks , true ); $blocks='{"top":"<h1 class=\"section-title\" style=\"text-align: right;\">Formatowanie<\/h1>\n<p style=\"text-align: right;\">Przykład formatowania tekstu w motywie <strong>Safari<\/strong>.<\/p>","content":"<h1>Nagłówek 1<\/h1>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h2>Nagłówek 2<\/h2>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h3>Nagłówek 3<\/h3>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h4>Nagłówek 4<\/h4>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h5>Nagłówek 5<\/h5>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h6>Nagłówek 6<\/h6>\n<p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<p><strong>Sullae consulatum&#63;<\/strong> Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.<\/p>\n<h3>Lista numerowana<\/h3>\n<ol>\n<li>Cupit enim dícere nihil posse ad beatam vitam deesse sapienti.<\/li>\n<li>At ille non pertimuit saneque fidenter: Istis quidem ipsis verbis, inquit;<\/li>\n<li>Fortitudinis quaedam praecepta sunt ac paene leges, quae effeminari virum vetant in dolore.<\/li>\n<\/ol>\n<p> <\/p>\n<h3>Lista punktowana<\/h3>\n<ul>\n<li>Se dicere inter honestum et turpe nimium quantum, nescio quid inmensum, inter ceteras res nihil omnino interesse.<\/li>\n<li>Hanc quoque iucunditatem, si vis, transfer in animum;<\/li>\n<li>Nosti, credo, illud: Nemo pius est, qui pietatem-;<\/li>\n<li>Quae in controversiam veniunt, de iis, si placet, disseramus.<\/li>\n<\/ul>\n<pre>Ex quo intellegitur, quoniam se ipsi omnes natura diligant, tam insipientem quam sapientem sumpturum, quae secundum naturam sint, reiecturumque contraria. Sed quid sentiat, non videtis. <\/pre>"}'; $block=json_decode( $blocks , true ); $admin=true; $availableTemplatesArray='{"404":"404","home":"home","subpage":"subpage"}'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ?><!DOCTYPE html> <html lang="pl"> <head> <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"> <?php if ($template == 'home'): ?> <title>Formatowanie</title> <?php else: ?> <title>Formatowanie - primal</title> <?php endif ?> <meta name="description" content=""> <meta property="og:title" content="Formatowanie - primal"> <meta property="og:description" content=""> <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet"> <link href="/themes/safari/assets/css/stylesheet.min.css" rel="stylesheet"> </head> <body> <main> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-3 child-middle"> <nav class="nav-top"> <ul> <li><a href="/">strona główa</a></li> <li><a href="/dokumentacja" class="active">dokumentacja</a></li> <li><a href="/demo">demo</a></li> <li><a href="https://github.com/deykun/primal-cms" target="_blank"><i class="icon-flow-branch"></i> github</a></li> </ul> </nav> </div> <div class="col-12 col-lg-9 bg-black child-middle"> <div class="text"> <div id="cms-field-top" class="wysiwyg regular" data-block-key="top" data-block-update="false"><h1 class="section-title" style="text-align: right;">Formatowanie</h1> <p style="text-align: right;">Przykład formatowania tekstu w motywie <strong>Safari</strong>.</p></div> </div> </div> </div> </div> </section> <section> <div class="container"> <div class="row"> <div class="col-12 col-lg-9 offset-lg-3 bg-white"> <div class="text"> <div id="cms-field-content" class="wysiwyg regular" data-block-key="content" data-block-update="false"><h1>Nagłówek 1</h1> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h2>Nagłówek 2</h2> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h3>Nagłówek 3</h3> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h4>Nagłówek 4</h4> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h5>Nagłówek 5</h5> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h6>Nagłówek 6</h6> <p>Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <p><strong>Sullae consulatum&#63;</strong> Traditur, inquit, ab Epicuro ratio neglegendi doloris. Sed mehercule pergrata mihi oratio tua.</p> <h3>Lista numerowana</h3> <ol> <li>Cupit enim dícere nihil posse ad beatam vitam deesse sapienti.</li> <li>At ille non pertimuit saneque fidenter: Istis quidem ipsis verbis, inquit;</li> <li>Fortitudinis quaedam praecepta sunt ac paene leges, quae effeminari virum vetant in dolore.</li> </ol> <p> </p> <h3>Lista punktowana</h3> <ul> <li>Se dicere inter honestum et turpe nimium quantum, nescio quid inmensum, inter ceteras res nihil omnino interesse.</li> <li>Hanc quoque iucunditatem, si vis, transfer in animum;</li> <li>Nosti, credo, illud: Nemo pius est, qui pietatem-;</li> <li>Quae in controversiam veniunt, de iis, si placet, disseramus.</li> </ul> <pre>Ex quo intellegitur, quoniam se ipsi omnes natura diligant, tam insipientem quam sapientem sumpturum, quae secundum naturam sint, reiecturumque contraria. Sed quid sentiat, non videtis. </pre></div> </div> </div> </div> </div> </section> </main> <footer> <div id="cms-field-footer" class="wysiwyg regular" data-siteblock-key="footer" data-block-update="false"><p>primal - <strong>2018</strong><br></p></div> </footer> <div id="cookieInfo" style="display: none;"> <div id="cms-field-cookieInfo" class="wysiwyg regular" data-siteblock-key="cookieInfo" data-block-update="false"><p>Używamy plików <strong>cookies</strong>, by ułatwić Ci korzystanie z tej strony. Jeśli nie chcesz, by pliki <strong>cookies</strong> były zapisywane na Twoim dysku zmień ustawienia swojej przeglądarki.</p></div> <button id="eat-cookie"><div id="cms-field-cookieOK" class="wysiwyg regular" data-siteblock-key="cookieOK" data-block-update="false">Akcepuję</div></button> </div> <script src="/themes/safari/assets/js/script.js"></script> <link href="<?php echo $cmscatalog; ?>admin/assets/css/stylesheet.min.css" rel="stylesheet">

    <input class="primal-tab-radio" id="tab-edit-page" type="checkbox" name="primaltab">
    <div class="primal-tab" id="primal-cms-edit-page">
        <form id="primal-edit-page-form" action="index.php?page=<?php echo $page; ?>&action=page_update" method="post" class="primal-tab-content primal-form">
            <label class="primal-tab-label primal-yellow" for="tab-edit-page">edytuj tę stronę <i class="primal-icon-browser"></i></label>

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
                <span class="checkbox primal-icon-eye"></span>
                <label for="active">Wyświetlaj</label>
            </div>
            <div class="cms-input chbox">
                <input id="cache" name="cache" type="checkbox" <?php if ($cache==1 ) {echo 'checked'; } ?> >
                <span class="checkbox primal-icon-clock"></span>
                <label class="admin-input-label" for="cache">Pamięć podręczna</label>
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
            <div class="primal-hidden-fields">
                
            </div>
            <button class="primal-save">Zapisz <i class="primal-icon-upload"></i></button>
            <div class="cms-copyrights">
                Primal CMS - <a class="primal-link" href="<?php echo $cmscatalog; ?>index.php?page=<?php echo $page; ?>&action=logout">wyloguj</a>
            </div>
        </form>
    </div>
    
    <input class="primal-tab-radio" id="tab-cms-close-all" type="radio" name="primaltab" checked>
    <div id="primal-reaction"></div>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/other/tinymce/langs/pl.js"></script>
    <script src="<?php echo $cmscatalog; ?>admin/assets/js/script.js"></script></body> </html> 