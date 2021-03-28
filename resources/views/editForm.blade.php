@extends('layouts.app')

@section('content')
    @foreach($despesa as $obj)
        <edit-form-component :despesa="{{$obj}}"/>
    @endforeach
@endsection