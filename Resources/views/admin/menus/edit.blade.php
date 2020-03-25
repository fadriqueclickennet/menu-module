@extends('layouts.master')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                {{ trans('menu::menu.titles.edit menu') }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.menu.menu.index') }}">{{ trans('menu::menu.breadcrumb.menu') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('menu::menu.breadcrumb.edit menu') }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@push('css-stack')
    <link href="{!! Module::asset('menu:css/nestable.css') !!}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
{!! Form::open(['route' => ['admin.menu.menu.update', $menu->id], 'method' => 'put']) !!}
<div class="container-fluid">
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline" style="overflow: hidden;">
            <div class="row justify-content-end card-header">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('dashboard.menuitem.create', [$menu->id]) }}" class="btn btn-primary ">
                        <i class="fas fa-plus mr-1"></i> {{ trans('menu::menu.button.create menu item') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                {!! $menuStructure !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ trans('core::core.title.translatable fields') }}</h3>
            </div>
            <div class="card-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php $i = 0; ?>
                        @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                            <?php $i++; ?>
                            <li class="nav-item">
                                <a class="nav-link {{ App::getLocale() == $locale ? 'active' : '' }}" href="#tab_{{ $i }}" data-toggle="tab">
                                    {{ trans('core::core.tab.'. strtolower($language['name'])) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                            <?php $i++; ?>
                            <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }} pt-3" id="tab_{{ $i }}">
                                @include('menu::admin.menus.partials.edit-trans-fields', ['lang' => $locale])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ trans('core::core.title.non translatable fields') }}</h3>
            </div>
            <div class="card-body">
                @include('menu::admin.menus.partials.edit-fields')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ trans('core::core.button.update') }}</button>
                <a class="btn btn-danger float-right" href="{{ route('admin.menu.menu.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
</div>
{!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('menu::menu.titles.create menu item') }}</dd>
        <dt><code>b</code></dt>
        <dd>{{ trans('menu::menu.navigation.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
<script>
$( document ).ready(function() {
    $(document).keypressAction({
        actions: [
            { key: 'c', route: "<?= route('dashboard.menuitem.create', [$menu->id]) ?>" },
            { key: 'b', route: "<?= route('admin.menu.menu.index') ?>" }
        ]
    });

    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $('input[type="checkbox"]').on('ifChecked', function(){
        $(this).parent().find('input[type=hidden]').remove();
    });

    $('input[type="checkbox"]').on('ifUnchecked', function(){
        var name = $(this).attr('name'),
            input = '<input type="hidden" name="' + name + '" value="0" />';
        $(this).parent().append(input);
    });

});
</script>
<script src="{!! Module::asset('menu:js/jquery.nestable.js') !!}"></script>
<script>
$( document ).ready(function() {
    $('.dd').nestable();
    $('.dd').on('change', function() {
        var data = $('.dd').nestable('serialize');
        $.ajax({
            type: 'POST',
            url: '{{ route('api.menuitem.update') }}',
            data: {'menu': JSON.stringify(data), '_token': '<?php echo csrf_token(); ?>'},
            dataType: 'json',
            success: function(data) {

            },
            error:function (xhr, ajaxOptions, thrownError){
            }
        });
    });
});
</script>
<script>
    $( document ).ready(function() {
        $('.jsDeleteMenuItem').on('click', function(e) {
            var self = $(this),
                menuItemId = self.data('item-id');
            $.ajax({
                type: 'POST',
                url: '{{ route('api.menuitem.delete') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    menuitem: menuItemId
                },
                success: function(data) {
                    if (! data.errors) {
                        var elem = self.closest('li');
                        elem.fadeOut()
                        setTimeout(function(){
                            elem.remove()
                        }, 300);
                    }
                }
            });
        });
    });
</script>
@endpush
