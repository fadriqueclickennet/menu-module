{!! Form::i18nInput('title', trans('menu::menu.form.title'), $errors, $lang) !!}

<div class="form-group link-type-depended link-internal">
    {!! Form::label("{$lang}[uri]", trans('menu::menu.form.uri')) !!}
    <div class='input-group{{ $errors->has("{$lang}[uri]") ? ' has-error' : '' }}'>
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">{{ $lang }}</span>
        </div>
        {!! Form::text("{$lang}[uri]", old("{$lang}[uri]"), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.uri')]) !!}
        {!! $errors->first("{$lang}[uri]", '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has("{$lang}[url]") ? ' has-error' : '' }} link-type-depended link-external">
    {!! Form::label("{$lang}[url]", trans('menu::menu.form.url')) !!}
    {!! Form::text("{$lang}[url]", old("{$lang}[url]"), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.url')]) !!}
    {!! $errors->first("{$lang}[url]", '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group{{ $errors->has("{$lang}[description]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[description]", trans('menu::menu.form.description')) !!}
    {!! Form::text("{$lang}[description]", old("{$lang}[description]"), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.description')]) !!}
    {!! $errors->first("{$lang}[description]", '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="checkbox">
    <label for="{{$lang}}[status]">
        <input id="{{$lang}}[status]"
                name="{{$lang}}[status]"
                type="checkbox"
                class="flat-blue"
                value="1" />
        {{ trans('menu::menu.form.status') }}
    </label>
</div>
