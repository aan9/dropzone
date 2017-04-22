@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Products</div>

                <div class="panel-body">
                    <table class= "table">
                        <thead>

                            <tr>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Seller</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Condition</th>
                                <th>Category</th>
                                <th>Brand</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach($products as $product)

                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>{{ $product->user->name }}</td>
                                <td>RM {{ $product->product_price }}</td>
                                <td>{{ $product->area->area_name }}, {{ $product->area->state->state_name }}</td>
                                <td>{{ $product->condition }}</td>
                                <td>{{ $product->subcategory->subcategory_name }}</td>
                                <td>{{ $product->brand->brand_name }}</td>
                            </tr>

                            @endforeach
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
