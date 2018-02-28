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
                    <div class="col-12 col-xl-3 child-middle">
                        <nav class="nav-top">
                            <ul>
                                <li><a href="/" class="active">strona główa</a></li>
                                <li><a href="/dokumentacja">dokumentacja</a></li>
                                <li><a href="/demo">demo</a></li>
                                <li><a href="https://github.com/deykun/primal-cms" target="_blank"><i class="icon-flow-branch"></i> github</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-xl-9 bg-green child-middle about-img">
                        <div class="text">
                            (block key='top')
                        </div>
                        <img src="/upload/elephant.png">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 bg-black child-middle">
                        <i class="icon-bg icon-code" aria-hidden="true"></i>
                    </div>
                    <div class="col-12 col-lg-6 bg-black child-middle">
                        <div class="text">
                            (block key='simplicity')
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 bg-green child-middle">
                        <i class="icon-bg icon-traffic-cone" aria-hidden="true"></i>
                        <div class="text">
                            (block key='todo')
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 bg-white child-middle">
                        <div class="text">
                            (block key='aboutauthor')
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
