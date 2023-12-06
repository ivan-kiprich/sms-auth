<!DOCTYPE html>
<html lang="uk">

<head>
    <title>Вхід</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <!-- <style>body{opacity: 0;}</style> -->
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- <meta name="robots" content="noindex, nofollow"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="wrapper">

    @yield("content")

    </main>
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__body">
                <div class="footer__wrap">
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{asset("js/app.js")}}"></script>
</body>

</html>
