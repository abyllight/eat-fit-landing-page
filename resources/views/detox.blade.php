@extends('layout.app')

@section('content')
    <section id="detox">
        <detox></detox>
    </section>

    <!--  Section Cart  -->
    <section id="cart">
<!--        <basket></basket>-->
    </section>
@endsection

@section('js')
    new Vue({
    el: '#detox'
    });
@endsection
