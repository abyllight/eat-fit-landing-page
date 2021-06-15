@extends('layout.app')

@section('content')
    <section id="detox">
        <detox></detox>
    </section>
@endsection

@section('js')
    new Vue({
    el: '#detox'
    });
@endsection
