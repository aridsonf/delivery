@extends('template.template')

@section('content')

@include('template.header')

<main>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a class="btn btn-primary btn-lg" role="button" data-bs-toggle="button" href="{{url("/crud_products")}}">
            Produtos
        </a>
        <a class="btn btn-primary btn-lg" role="button" data-bs-toggle="button" href="{{url("/crud_products")}}">
            Produtos
        </a>
    </div>
</main>
    
@endsection