@extends('layouts.app2')
@section('content')

  <div class="container">
    
      <h1 class="">Lista de Produtos</h1>
    
    <table class="table table-bordered">
      <tr>
        <th>Produto</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Criado em</th>
      </tr>

    @foreach ($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->created_at }}</td>
      </tr>
    @endforeach
    </table>
    {{ $products }}
    {{-- <vue-pagination  :pagination="products"
                     @paginate="getProdutos()"
                     :offset="4">
    </vue-pagination> --}}
    </div>
@endsection