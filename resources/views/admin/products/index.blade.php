@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Search</div>
                <div class="panel-body">
                    <form action="{{ route('admin.products.index') }}" method="GET">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_state', 'State') !!}   
                                    {!! Form::select('search_state', $states, Request::get('search_state'), ['placeholder' => 'Select State','class'=>'form-control','id'=>'state_id']); !!}
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_category', 'Category') !!}   
                                    {!! Form::select('search_category', $categories, Request::get('search_category'), ['placeholder' => 'Select Category','class'=>'form-control','id'=>'category_id']); !!}
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_brand', 'Brand') !!}   
                                    {!! Form::select('search_brand', $brands, Request::get('search_brand'), ['placeholder' => 'Select Brand','class'=>'form-control']); !!}
                                </div>

                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('search_anything', 'By Product Name/Desc') !!}   
                                    {!! Form::text('search_anything',Request::get('search_anything'), ['class' => 'form-control']); !!}
                                </div>

                            </div>

                            <div class="col-md-1">
                                <div class="form-group" style="padding-top:33%">
                                    <button type="submit" class="btn btn-primary ">Search</button>
                                </div>
                            </div>

                        </div>

                        <!-- row utk search by area and subcategory -->
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_area', 'Area') !!}   
                                    {!! Form::select('search_area', [], null, ['placeholder' => 'Select Area','class'=>'form-control','id'=>'area_id']); !!}
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('search_subcategory', 'SubCategory') !!}   
                                    {!! Form::select('search_subcategory', [], null, ['placeholder' => 'Select SubCategory','class'=>'form-control','id'=>'subcategory_id']); !!}
                                </div>

                            </div>

                        </div>

                    </form>

                </div>


            </div>



            <div class="panel panel-primary">
                <div class="panel-heading"><b>Manage Products</b></div>

                <div class="panel-body">

                    <a href="{{ route('admin.products.create') }}" class="btn btn-warning">Create Product</a>
                    <p></p>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>

                            <tr>
                                <th style="width:150px;">Ibu Jari Avatar</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Seller</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Condition</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach($products as $product)

                            <tr>
                                <td>
                                    @if(!empty($product->product_image))

                                        <img src="{{ asset('storage/uploads/'.$product->product_image) }}" class="img-thumbnail" style="width:150px; height:130px;">

                                    @else

                                        <img src="{{ asset('storage/uploads/avatar.png') }}" class="img-thumbnail">

                                    @endif
                                    
                                </td>

                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>{{ $product->user->name }}</td>
                                <td>RM {{ $product->product_price }}</td>
                                <td>{{ $product->area->area_name }}, {{ $product->area->state->state_name }}</td>
                                <td>{{ $product->condition }}</td>
                                <td>{{ $product->subcategory->subcategory_name }}</td>
                                <td>{{ $product->brand->brand_name }}</td>

                                <td>

                                    <form method="POST" action="{{ route('admin.products.destroy',$product->id) }}">

                                        <input type="hidden" name="_method" value="DELETE">

                                        {{ csrf_field() }}

                                        <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-info btn-mini">Edit</a>

                                        <button type="button" class="btn btn-danger delete">Delete</button>

                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>    
                    </table>

                    {{ $products->appends(Request::except('page'))->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">

$( document ).ready(function() {

    //bila pengguna select state, pggl ajax function getarea by state

    $( "#state_id" ).change(function() {

        var state_id = $(this).val();
        getStateAreas(state_id);
        
    });

    //bila pengguna click pada pagination, reload balik areas based on selected_state

    var selected_state_id = '{{ Request::get('search_state') }}';

    console.log(selected_state_id);

    if (selected_state_id.length>0) {
    
        getStateAreas(selected_state_id);

    }

    function getStateAreas(state_id) {

        console.log(state_id);

        //define route utk hantar id state ke controller, grab data area

        var ajax_url = '/admin/products/areas/' + state_id;

        //dapatkan area dtata dari controller menggunakan ajax

        $.get( ajax_url, function( data ) {

            //dah dapat data, kosongkan dulu dropdown area dan tmbh select area
                
            console.log(data);

            $('#area_id').empty().append('<option value="">Select Area</option');

            //loop data utk hasilkan senarai option baru bagi dropdown

            $.each(data, function(area_id,area_name){
                
                $('#area_id').append('<option value='+area_id+'>'+area_name+'</option');

            });

            var selected_area_id = '{{ Request::get('search_area') }}';

            if (selected_area_id.length>0) {
            
                $('#area_id').val(selected_area_id); 
            
            }

        });
        
    }


    $( "#category_id" ).change(function() {

        var category_id = $(this).val();
        getCategorySubcategories(category_id);
        
    });


    var selected_category_id = '{{ Request::get('search_category') }}';

    console.log(selected_category_id);

    if (selected_category_id.length>0) {

        getCategorySubcategories(selected_category_id);

    }


    function getCategorySubcategories(category_id){

        console.log(category_id);

        //hantar id state ke controller, grab data area
        var ajax_url = '/admin/products/subcategories/' + category_id;

        $.get( ajax_url, function( data ) {

            console.log(data);

            $('#subcategory_id').empty().append('<option value="">Select SubCategory</option');

            $.each(data, function(subcategory_id,subcategory_name){
                
                $('#subcategory_id').append('<option value='+subcategory_id+'>'+subcategory_name+'</option');
                
            });

            var selected_subcategory_id = '{{ Request::get('search_subcategory') }}';

            if (selected_subcategory_id.length>0) {

                $('#subcategory_id').val(selected_subcategory_id); 

            }

        });

    }

    //bila pengguna klik butang delete
    $('.delete').click(function() {

        //panggil sweetalert confirm
        //dapatkan form yg terdekat dengan butang delete yg kita tekan
        var closest_form = $(this).closest('form');

        swal({

          title: "Are you sure?",
          text: "You will not be able to recover this lovely cutie pie!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false

        },

        function(){

          //bila tekan ok, submit form yg terdekat
          closest_form.submit();

        });
    });

});

</script>

@endsection
