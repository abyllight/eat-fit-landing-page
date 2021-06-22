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
    <div class="w-full bg-gray-900 px-5 py-3 fixed-top flex items-center justify-between mb-5">
        <a class="bg-green-500 rounded px-3 py-2 shadow text-white hover:bg-green-600" href="/admin/products">Назад</a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-1 bg-gray-300 rounded hover:bg-white">Выйти</button>
        </form>
    </div>

    <div class="container mx-auto px-3 flex justify-center">
        @if(session()->has('message'))
            <div>
                <p class="text-lg text-green-500 font-semibold mb-5">{{ session('message') }}</p>
            </div>
        @endif
        <form class="w-full max-w-sm pb-5" method="post" action="{{ route('pwd.update') }}">
            @csrf
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                        Пароль
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="pwd" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('pwd') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                           id="pwd" type="password" required>
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="bg-green-500 rounded px-3 py-2 shadow text-white hover:bg-green-600" type="submit">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
