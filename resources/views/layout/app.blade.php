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

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '473263288614999');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=473263288614999&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->

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

    <section id="ad">
        <ad></ad>
    </section>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer" class="bg-gray-900 w-full">
        <div class="px-3 py-5 max-w-6xl mx-auto flex flex-col items-center justify-center">
            <a href="/files/oferta.docx" class="text-white font-semibold mb-4 hover:text-brand-green cursor-pointer">Публичная оферта</a>
            <p class="text-white text-xs font-semibold">© Все права защищены. EAT&FIT, 2015-2023</p>
        </div>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        @section('js')
        @show
    </script>
</body>
</html>
