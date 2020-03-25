@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                {{ trans('menu::menu.titles.menu') }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('menu::menu.breadcrumb.menu') }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="btn-group " style="margin: 0 15px 15px 0;">
                <a href="{{ route('admin.menu.menu.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> {{ trans('menu::menu.button.create menu') }}
                </a>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <!-- /.box-header -->
            <div class="card-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('menu::menu.table.name') }}</th>
                            <th>{{ trans('menu::menu.table.title') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @isset($menus)
                        @foreach ($menus as $menu)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.menu.menu.edit', [$menu->id]) }}">
                                        {{ $menu->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.menu.menu.edit', [$menu->id]) }}">
                                        {{ $menu->title }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.menu.menu.edit', [$menu->id]) }}"
                                           class="btn btn-default"><i
                                                    class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#confirmation-{{ $menu->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ trans('menu::menu.table.name') }}</th>
                            <th>{{ trans('menu::menu.table.title') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>
            <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    </div>
</div>
</div>
@isset($menus)
    @foreach ($menus as $menu)
    <!-- Modal -->
    <div class="modal fade modal-danger" id="confirmation-{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('core::core.modal.title') }}</h4>
                </div>
                <div class="modal-body">
                    {{ trans('core::core.modal.confirmation-message') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-flat" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                    {!! Form::open(['route' => ['admin.menu.menu.destroy', $menu->id], 'method' => 'delete', 'class' => 'pull-left']) !!}
                        <button type="submit" class="btn btn-outline btn-flat"><i class="fas fa-trash-alt"></i> {{ trans('core::core.button.delete') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endisset
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('menu::menu.titles.create menu') }}</dd>
    </dl>
@stop

@push('js-stack')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'c', route: "<?= route('admin.menu.menu.create') ?>" }
            ]
        });
    });
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[ 0, "asc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
    });
</script>
@endpush
