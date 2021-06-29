@section('head')
    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
@endsection
@extends('layout.app')

@section('content')
    <section id="cart">
        <checkout></checkout>
    </section>
@endsection

