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
        <p class="text-white mr-3">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
        <div class="flex items-center">
            <a
                href="{{route('pwd')}}"
                class="px-3 py-1 bg-gray-300 rounded hover:bg-white mr-4">
                Сменить пароль
            </a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-3 py-1 bg-gray-300 rounded hover:bg-white">Выйти</button>
            </form>
        </div>

    </div>

    <div class="container mx-auto px-3">
        @if(session()->has('message'))
            <div>
                <p class="text-lg text-green-500 font-semibold mb-5">{{ session('message') }}</p>
            </div>
        @endif
        <form method="post" action="{{ route('fetch') }}">
            @csrf
            <button
                type="submit"
                class="bg-green-500 rounded px-3 py-2 shadow text-white hover:bg-green-600">
                Получить данные с АМО
            </button>
        </form>
        <div class="mt-10">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2"><p class="text-gray-600">#</p></th>
                        <th class="px-4 py-2"><p class="text-gray-600">Имя</p></th>
                        <th class="px-4 py-2"><p class="text-gray-600">Название блюда</p></th>
                        <th class="px-4 py-2"><p class="text-gray-600">Кол-во</p></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border px-4 py-2"><p class="font-bold text-gray-800">{{ $item->name }}</p></td>
                            <td class="border px-4 py-2">{{ $item->product->title }}</td>
                            <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
