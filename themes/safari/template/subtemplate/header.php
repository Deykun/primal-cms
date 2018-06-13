<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if ($template == 'home'): ?>
    <title>(title)</title>
<?php else: ?>
    <title>(title) - (sitename)</title>
<?php endif ?>
<meta name="description" content="(metadescription)">
<meta property="og:title" content="(title) - (sitename)">
<meta property="og:description" content="(metadescription)">

<?php if ($seoindex): ?>
    <meta name="robots" content="index,follow" />
<?php else: ?>
    <meta name="robots" content="noindex,nofollow" />
<?php endif ?> 

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,800&amp;subset=latin-ext" rel="stylesheet">
<link href="(themecatalog)assets/css/stylesheet.min.css" rel="stylesheet">

(/strip)
<script>
    // Do not minify this!
</script>
(strip)