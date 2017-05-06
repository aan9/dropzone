@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Product Detail</b></div>

                <div class="panel-body">            

                    {!! Form::open() !!}

                        <!-- product_name textfield -->

                      <div class="form-group {{ $errors->has('product_name') ? 'has-error' : false }}">  
                          <h2>{!! Form::text('product_name',$product->product_name,['class'=>'form-control']);  !!}</h2>
                          
                      </div>

                      <div class="form-group">

                        @if(!empty($product->product_image))
                          <img src="{{ asset('storage/uploads/'.$product->product_image) }}" class="img-responsive">
                        @endif

                      </div>

                      <div class="form-group {{ $errors->has('product_price') ? 'has-error' : false }}">  
                          {!! Form::label('product_price', 'Product Price') !!}

                          {!! Form::text('product_price',$product->product_price,['class'=>'form-control']);  !!}
                      </div>

                      <div class="form-group {{ $errors->has('product_description') ? 'has-error' : false }}">  
                          {!! Form::label('product_description', 'Product Description') !!}
                          {!! Form::textarea('product_description',$product->product_description,['class'=>'form-control']);  !!}
                      </div>

                      <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false }}">
                          {!! Form::label('category_name', 'Category') !!}   
                          
                          {!! Form::text('category_name',$product->subcategory->category->category_name,['class'=>'form-control']);  !!}
                      </div>

                      <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : false }}">
                          {!! Form::label('subcategory_name', 'SubCategory') !!}

                          {!! Form::text('subcategory_name',$product->subcategory->subcategory_name,['class'=>'form-control']);  !!}

                      </div>

                      <div class="form-group {{ $errors->has('state_id') ? 'has-error' : false }}">
                          {!! Form::label('state_id', 'State') !!}

                          {!! Form::text('state_name',$product->area->state->state_name,['class'=>'form-control']);  !!}

                      </div>

                      <div class="form-group {{ $errors->has('area_id') ? 'has-error' : false }}">
                          {!! Form::label('area_id', 'Area') !!}   
                          
                          {!! Form::text('area_name',$product->area->area_name,['class'=>'form-control']);  !!}

                      </div>

                      <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : false }}">
                          {!! Form::label('brand_name', 'Brand') !!}

                          {!! Form::text('brand_name',$product->brand->brand_name,['class'=>'form-control']);  !!}
                      </div>

                      <div class="form-group {{ $errors->has('condition') ? 'has-error' : false }}">
                          {!! Form::label('condition', 'Condition') !!}
                          
                          {!! Form::text('condition',$product->condition,['class'=>'form-control']);  !!}
                      </div>

                      <!-- product_description textarea -->
                      

                      <!-- product_price textfield -->
                      

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

