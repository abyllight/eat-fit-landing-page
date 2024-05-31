@extends('layout.app')

@section('content')
    <section id="quiz">
        <quiz></quiz>
    </section>

    <section id="cart">
    </section>
@endsection

@section('js')
    new Vue({
    el: '#quiz'
    });
@endsection
