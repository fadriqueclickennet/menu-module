{!! Form::normalInput('icon', trans('menu::menu-items.form.icon'), $errors) !!}
{!! Form::normalInput('class', trans('menu::menu-items.form.class'), $errors) !!}
<div class="form-group link-type-depended link-page">
    <label for="page">{{ trans('menu::menu-items.form.page') }}</label>
    <select class="form-control" name="page_id" id="page">
        <option value=""></option>
        @foreach ($pages as $page)
            <option value="{{ $page->id }}">{{ $page->title }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="parent_id">{{ trans('menu::menu-items.form.parent menu item') }}</label>
    <select class="form-control" name="parent_id" id="parent_id">
        <option value=""></option>
        @foreach ($menuSelect as $parentMenuItemId => $parentMenuItemName)
            <option value="{{ $parentMenuItemId }}">{{ $parentMenuItemName }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="target">{{ trans('menu::menu-items.form.target') }}</label>
    <select class="form-control" name="target" id="target">
        <option value="_self">{{ trans('menu::menu-items.form.same tab') }}</option>
        <option value="_blank">{{ trans('menu::menu-items.form.new tab') }}</option>
    </select>
</div>
