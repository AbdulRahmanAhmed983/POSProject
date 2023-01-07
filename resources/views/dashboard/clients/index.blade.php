
@extends('layouts.dashboard.app')

@section('content')
        
<div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
                <li class="active"> @lang('site.clients')</li>

            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients') <small style="font-size: larger; color:#3c8dbc;">{{ $clients->total() }}</small></h3>

                    <form action="{{ route('dashboard.clients.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('clients_create'))
                                    <a href="{{ route('dashboard.clients.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                {{-- @else
                                    <a href="{{route('dashboard.clients.add')}}" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a> --}}
                                    @endif
                                   
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.add_order')</th>
                                <th>@lang('site.action')</th>

                                {{-- @if (auth()->user()->hasPermission('clients_update','clients_delete'))

                                <th>@lang('site.action')</th>
                                @endif --}}
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    {{-- array_filter => بتعدي علي الاراي وتشيل اي حاجه بfalse or null
                                        implode('-',array_filter($client->phone)) --}}
                                    <td>{{ is_array($client->phone) ? implode('-',$client->phone) : $client->phone }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('orders_create'))
                                        <a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-warning btn-sm">@lang('site.add_order')</a>
                                            @else
                                            <a href="#" class="btn btn-warning btn-sm disabled">@lang('site.add_order')</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('clients_update'))
                                            <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('clients_delete'))
                                            <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{ $clients->appends(request()->query())->links() }}
                        
                    @else
                        
                        <h2>@lang('site.no_data_found')</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->
        </section><!-- end of content -->

        </div><!-- end of content wrapper -->

@endsection

