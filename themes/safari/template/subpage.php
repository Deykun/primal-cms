<!DOCTYPE html>
<html lang="pl">

<head>
    (subtemplate key='header')
</head>

<body>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 child-middle">
                        <nav class="nav-top">
                            <ul>
                                <li><a href="/">strona główa</a></li>
                                <li><a href="/dokumentacja" class="active">dokumentacja</a></li>
                                <li><a href="/demo">demo</a></li>
                                <li><a href="https://github.com/deykun/primal-cms" target="_blank"><i class="icon-flow-branch"></i> github</a></li>
                            </ul>
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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9 offset-lg-3 bg-white">
                        <div class="text">
                            (block key='content')
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
    <script src="(themecatalog)assets/js/script.js"></script>
</body>

</html>
