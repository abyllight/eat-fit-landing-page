<!doctype html>
<html lang=ru style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EAT&amp;FIT - Рационы здоровой жизни, диетическое питание с доставкой в Алмате и Астане. Здоровое питание в Алмате. Здоровое питание в Астане. ПП Астана. ПП Алматы"/>
    <meta property="og:title" content="EAT&amp;FIT- Сервис по организации здорового питания с доставкой на дом в Алмате и Астане. Диетическое питание. Здоровое питание - EAT&FIT - Рационы здоровой жизни, диетическое питание с доставкой в Алмате и Астане. Здоровое питание в Алмате. Здоровое питание в Астане. ПП Астана. ПП Алматы" />
    <meta property="og:description" content="EAT&amp;FIT - Рационы здоровой жизни, диетическое питание с доставкой в Алмате и Астане. Здоровое питание в Алмате. Здоровое питание в Астане. ПП Астана. ПП Алматы" />
    <meta property="og:url" content="https://eatandfit.kz/" />
    <meta property="og:site_name" content="EAT&amp;FIT- Сервис по организации здорового питания с доставкой на дом в Алмате и Астане. Диетическое питание. Здоровое питание. Здоровое питание в Алмате. Здоровое питание в Астане. ПП Астана. ПП Алматы" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EAT&amp;FIT- Сервис по организации здорового питания с доставкой на дом в Астане</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NC55Q45');</script>
    <!-- End Google Tag Manager -->

    <meta name="mailru-domain" content="XLb4KEEntsFqbfyd" />
    @section('head')
    @show
</head>

<body class="font-body flex flex-col min-h-screen">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NC55Q45"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <section id="navbar">
        <navbar></navbar>
    </section>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer" class="bg-gray-900 w-full">
        <div class="px-3 py-5 max-w-6xl mx-auto flex flex-col items-center justify-center">
            <a href="/files/oferta.docx" class="text-white font-semibold mb-4 hover:text-brand-green cursor-pointer">Публичная оферта</a>
            <p class="text-white text-xs font-semibold">© Все права защищены. EAT&FIT, 2015-2021</p>
        </div>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        @section('js')
        @show
    </script>
    <script>
        (function(w, d, s, h, id) {
            w.roistatProjectId = id; w.roistatHost = h;
            var p = d.location.protocol == "https:" ? "https://" : "http://";
            var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
            var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
        })(window, document, 'script', 'cloud.roistat.com', '30d2ed73195218197354a5214b1e2373');
    </script>

    <script type="text/javascript">
        (function(d, w, s) {
            var widgetHash = 'w0rqbbf9jrhblm0kays4', ctw = d.createElement(s); ctw.type = 'text/javascript'; ctw.async = true;
            ctw.src = '//widgets.binotel.com/calltracking/widgets/'+ widgetHash +'.js';
            var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(ctw, sn);
        })(document, window, 'script');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(56810422, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>

    <noscript><div><img src="https://mc.yandex.ru/watch/56810422" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</body>
</html>
