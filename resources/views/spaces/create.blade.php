@extends('layout')

@section('title', __('actions.create') . ' ' . __('models.space'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.create') }} {{ __('models.space') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/settings/spaces" autocomplete="off">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>{{ __('fields.name') }}</label>
                        <input type="text" name="Name" />
                        @include('partials.validation_error', ['payload' => 'Name'])
                    </div>
                    <div class="input">
                        <label>Currency</label>
                        <searchable
                            name="Currency"
                            size="2"
                            :items='@json($currencies)'
                            initial="{{ old('Currency') }}"></searchable>
                        @include('partials.validation_error', ['payload' => 'Currency'])
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">@lang('actions.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
