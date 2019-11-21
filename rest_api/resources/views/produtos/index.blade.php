@extends('layouts.app2')
@section('content')
  <div class="container">
    <table class="table table-bordered">
      <tr>
        <th>Produto</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Criado em</th>
      </tr>
      <tr v-for="product in products.data">
        <td>@{{ products.name }}</td>
        <td>@{{ products.description }}</td>
        <td>@{{ products.price }}</td>
        <td>@{{ products.created_at }}</td>
      </tr>
    </table>
    <vue-pagination  :pagination="products"
                     @paginate="getProdutos()"
                     :offset="4">
    </vue-pagination>
    </div>
@endsection