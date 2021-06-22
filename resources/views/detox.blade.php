@extends('layout.app')

@section('content')
    <section id="detox">
        <detox></detox>
    </section>

    <!--  Section Cart  -->
    <section id="cart">
        <cart></cart>
    </section>
@endsection

@section('js')
    new Vue({
    el: '#detox'
    });
@endsection
