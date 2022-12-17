
@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add_order')</h1>

            <ol class="breadcrumb">
                {{-- <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li> --}}
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.add_order')</li>
            </ol>
        </section>

        <section class="content">

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders')
                                </h3>
                            </div><!-- end of box header -->   
                            <div class="box-body">
                                <form method="POST" action="{{route('dashboard.clients.orders.index',$client->id)}}">
                                    @csrf
                                    {{ method_field('post') }}
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('site.product')</th>
                                                <th>@lang('site.quantity')</th>
                                                <th>@lang('site.sale_price')</th>
                                              </tr>
                                        </thead>
                                        <tbody class="order-list">
                                            
                                        </tbody>
                                    </table>
                                    <h4>@lang('site.total') : 
                                    <span class="total-price">0.00</span>
                                    </h4>
                                    <button class="btn btn-primary btn-block disabled" id="add-order-form-btn">@lang('site.add_order')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')
                                    <small>{{ $orders->total() }}</small>
                                </h3>
                            </div><!-- end of box header -->   

                            <div class="box-body">

                                    @foreach ($categories as $category)
                                        <div class="panel-group">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse"class="btn" style="width: fit-content" href="#{{str_replace(' ','-',$category->name)}}">{{$category->name}}</a>
                                                </h4>
                                                 </div>
                                           
                                            <div id="{{str_replace(' ','-',$category->name)}}" class="panel-collapse collapse">
                                                
                                                <div class="panel-body">
                                                    
                                                    @if ($category->products->count() > 0)
                                                        <table class="table table-hover">
                                                                <tr>
                                                                    <th>@lang('site.name')</th>
                                                                    <th>@lang('site.stock')</th>
                                                                    <th>@lang('site.price')</th>
                                                                    <th>@lang('site.add')</th>
                                                                </tr>
                                                                @foreach ($category->products as $product)
                                                                    <tr>
                                                                        <td>{{$product->name}}</td>
                                                                        <td>{{$product->stock}}</td>
                                                                        <td>{{$product->sale_price}}</td>
                                                                        <td><button href="" 
                                                                            id="product-{{$product->id}}"
                                                                            data-name="{{$product->name}}"
                                                                            data-id="{{$product->id}}"
                                                                            data-price="{{$product->sale_price}}"
                                                                            class="btn btn-success btn-sm add-product-btn">
                                                                                <i class="fa fa-plus"></i> 
                                                                           </button></td>
                                                                    </tr>
                                                                @endforeach
                                                        </table>
                                                        @else
                                                        <h5>@lang('site.no_records')</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            </div>
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        </div>
                                    @endforeach














                                {{ $orders->links() }}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    {{-- @endif --}}


                </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
    