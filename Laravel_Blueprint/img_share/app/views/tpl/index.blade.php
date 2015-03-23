@extends('frontend_master')

@section('content')
  {{ Form::open(array('url' => '/', 'files' => true)) }}
  {{ Form::text('title', 'Placeholder je ovo') }}
  {{ Form::file('image') }}
  {{ Form::submit('Save!', array('name'=>'send')) }}
  {{ Form::close() }}
@stop
