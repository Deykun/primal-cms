<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if ($page_template == 'home'): ?>
    <title>((page_title))</title>
<?php else: ?>
    <title>((page_title)) - ((site_name))</title>
<?php endif ?>
<meta name="description" content="((page_meta_description))">
<meta property="og:title" content="((page_title)) - ((site_name))">
<meta property="og:description" content="(page_meta_description)">

<?php if ($page_seo_index): ?>
    <meta name="robots" content="index,follow" />
<?php else: ?>
    <meta name="robots" content="noindex,nofollow" />
<?php endif ?> 

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet">
<link href="((dir_theme))assets/css/stylesheet.min.css" rel="stylesheet">

(/strip)
<script>
    // Do not minify this!
</script>
(strip)