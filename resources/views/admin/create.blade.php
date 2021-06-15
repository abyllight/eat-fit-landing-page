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
        <a class="bg-green-500 rounded px-3 py-2 shadow text-white hover:bg-green-600" href="/admin">Назад</a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-1 bg-gray-300 rounded hover:bg-white">Выйти</button>
        </form>
    </div>

    <div class="container mx-auto px-3 flex justify-center items-center">
        <form class="w-full max-w-sm py-5" method="post" enctype="multipart/form-data">
            @csrf
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                        Название
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="title" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('title') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                           id="title" type="text" placeholder="Том Ям" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="composition">
                        Состав
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea name="composition" rows="8" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('composition') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                              id="composition" placeholder="Масло подсолнечное, бульон куриный, молоко кокосовое...">{{ old('composition') }}</textarea>
                    @error('composition')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="weight">
                        Вес
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="weight" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('weight') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                           id="weight" type="number" placeholder="800" value="{{ old('weight') }}">
                    @error('weight')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price">
                        Цена
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="price" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('price') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                           id="price" type="number" placeholder="3000" value="{{ old('price') }}">
                    @error('price')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="priceP">
                        Цена за порцию
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="priceP" class="bg-gray-200 appearance-none border-2 border-gray-200 @error('priceP') border-red-500 @enderror rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500"
                           id="priceP" type="number" placeholder="1100" value="{{ old('priceP') }}">
                    @error('priceP')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="front">
                        Фото перед
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="front" id="front" type="file" value="{{ old('front') }}">
                    @error('front')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="back">
                        Фото зад
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="back" id="back" type="file" value="{{ old('back') }}">
                    @error('back')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="bg-green-500 rounded px-3 py-2 shadow text-white hover:bg-green-600" type="submit">
                        Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
