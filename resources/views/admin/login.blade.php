<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EAT&amp;FIT- Сервис по организации здорового питания с  доставкой на дом в АстанДиетическое питание. Здоровое питание | EAT&amp;FIT - Рационы здоровой жизни, диетическпитание с доставкой в Астане</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
<div id="app">
<div class="bg-gray-100 w-full h-screen flex justify-center items-center">
    <form method="post" action="{{ route('login.post') }}" class="bg-white shadow-md rounded px-8 py-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Почта
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" type="text">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Пароль
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Войти
            </button>
        </div>
    </form>
</div>
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
