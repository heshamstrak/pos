@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.roles')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.roles.index') }}"> @lang('site.roles')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>


                        <div class="form-group">
                            <h3>@lang('site.permissions')</h3>
                            <div class="form-group">

                                @php
                               $models = [

                                             'products',
                                             'stores',

                                            'categories',
                                           
                                           'clients',
                                            'suppliers',
                                             'orders',
                                             'orders_suppliers',
                                             'orders_return',
                                             'orders_suppliers_return',


                                           
                                            'roles',
                                           'users',
                                           // 'tags',
                                           // 'posts',
                                           
                                             
                            ];

                                    $maps = ['create', 'read', 'update', 'delete'];
                                    $mapss= ['read'];

                                @endphp

                                <ul class="nav ">
                                <table class="table table-hover table-bordered">

          
                                    @foreach ($models as $index=>$model)
                                    <tr>
                                    <td>
                                          <li class="form-group {{ $index == 0 ? 'active' : '' }}">@lang('site.' . $model)</li>
                                          </td>
                                          <td>

                                        <div class="form-group {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>


                                            @endforeach

                                            </div>
                                            </td>

                                    </tr>
                                   @endforeach
                                                  </table>
                 
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)


                                    @endforeach

                                </div><!-- end of tab content -->
                                
                            </div><!-- end of nav tabs -->
                            
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
