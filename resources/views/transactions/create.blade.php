@extends('layout')

@section('title', __('actions.create') . ' Transaction')

@section('body')
    <div class="wrapper mw-400 my-3">
        <h2 class="mb-3">{{ __('actions.create') }} Transaction for {{ session('space')->name }}</h2>
        <transaction-wizard :tags='@json($tags)' :spaces='@json($spaces)'></transaction-wizard>
    </div>
@endsection
