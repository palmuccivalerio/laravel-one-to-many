@extends('layouts.admin')

@section('content')

    <h1>{{$project->title}}</h1>
    <p>{{$project->content}}</p>
    <p>Slug: {{$project->slug}}</p>


@endsection