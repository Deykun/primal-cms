<!DOCTYPE html>(strip)
<html lang="pl">

<head>
    (subtemplate name='header')
</head>

<body>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 child-middle">
                        <nav class="nav-top">
                            (subtemplate name='menu' menu='top')
                        </nav>
                    </div>
                    <div class="col-12 col-lg-9 bg-black child-middle">
                        <div class="text">
                            (block key='top')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        (siteblock key='footer')
    </footer>
    <div id="cookieInfo" style="display: none;">
        (siteblock key='cookieInfo')
        <button id="eat-cookie">(siteblock key='cookieOK')</button>
    </div>
    <script src="(dir_theme)assets/js/script.js"></script>
</body>

</html>(/strip)