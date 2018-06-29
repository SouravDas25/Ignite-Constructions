@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
        <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            {{ __('voyager::generic.edit') }}
        </a>
        @endcan
        @can('delete', $dataTypeContent)
            <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
            </a>
        @endcan

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

  

    <div class="container pt-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-5">
                <h3 class="pl-3"><b>{{$dataTypeContent->name}}</b></h3>
                <div class="pl-3">
                    <span class="badge badge-pill pink">Default</span>
                    <span class="badge badge-pill light-blue">Primary</span>
                    <span class="badge badge-pill indigo">Success</span>
                    <span class="badge badge-pill purple">Info</span>
                    <span class="badge badge-pill orange">Warning</span>
                    <span class="badge badge-pill green">Danger</span>
                    <span class="badge badge-pill pink">Default</span>
                    <span class="badge badge-pill light-blue">Primary</span>
                    <span class="badge badge-pill indigo">Success</span>
                    <span class="badge badge-pill purple">Info</span>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-sm-12 col-md-6 col-lg-6" style="background-color:white; border-radius:5px;">
                <h5 class="pl-3 pt-3">Email : {{ $dataTypeContent->email }}</h5>
                <h5 class="pl-3 pt-2 pb-2">Contact No : {{ $dataTypeContent->contact_no }}</h5>
            </div>
        </div>
    </div>

    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Cost</th>
                                        <th>Date</th>
                                        <th>Purchase Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($purchase)>0)
                                        @foreach($purchase as $data1)
                                            <tr>
                                                <td>{{ $data1->quantity }}</td>
                                                <td>{{ $data1->quantity }}</td>
                                                <td>{{ $data1->cost }}</td>
                                                <td>{{ $data1->date }}</td>
                                                <td>{{ $data1->purchase_due }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
    <script>
        $(document).ready(function () {
            $('.side-body').multilingual();
        });
    </script>
    <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });

    </script>
@stop
