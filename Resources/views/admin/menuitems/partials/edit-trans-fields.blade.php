{!! Form::i18nInput('title', trans('menu::menu.form.title'), $errors, $lang, $menuItem) !!}


<div class="form-group link-type-depended link-internal">
    {!! Form::label("{$lang}[uri]", trans('menu::menu.form.uri')) !!}
    <div class='input-group{{ $errors->has("{$lang}[uri]") ? ' has-error' : '' }}'>
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">{{ $lang }}</span>
        </div>
        <?php $old = $menuItem->hasTranslation($lang) ? $menuItem->translate($lang)->uri : '' ?>
        {!! Form::text("{$lang}[uri]", old("{$lang}[uri]", $old), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.uri')]) !!}
        {!! $errors->first("{$lang}[uri]", '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has("{$lang}[url]") ? ' has-error' : '' }} link-type-depended link-external">
    {!! Form::label("{$lang}[url]", trans('menu::menu.form.url')) !!}
    <?php $old = $menuItem->hasTranslation($lang) ? $menuItem->translate($lang)->url : '' ?>
    {!! Form::text("{$lang}[url]", old("{$lang}[url]", $old), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.url')]) !!}
    {!! $errors->first("{$lang}[url]", '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group{{ $errors->has("{$lang}[description]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[description]", trans('menu::menu.form.description')) !!}
    <?php $old = $menuItem->hasTranslation($lang) ? $menuItem->translate($lang)->description : '' ?>
    {!! Form::text("{$lang}[description]", old("{$lang}[description]", $old), ['class' => 'form-control', 'placeholder' => trans('menu::menu.form.description')]) !!}
    {!! $errors->first("{$lang}[description]", '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="checkbox">
    <?php $old = $menuItem->hasTranslation($lang) ? $menuItem->translate($lang)->status : false ?>
    <label for="{{$lang}}[status]">
        <input id="{{$lang}}[status]"
                name="{{$lang}}[status]"
                type="checkbox"
                class="flat-blue"
                {{ (bool) $old ? 'checked' : '' }}
                value="1" />
        {{ trans('menu::menu.form.status') }}
    </label>
</div>
