@extends('layouts.admin')

@section('content')
    <h1>Lista dei Posts</h1>
    <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Crea</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Azione</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $curProject)
                <tr>
                    <th scope="row">{{ $curProject->id }}</th>
                    <td>{{ $curProject->title }}</td>
                    <td>{{ $curProject->slug }}</td>
                    <td> 
                        <a class='btn btn-info' href="{{ route('admin.projects.show',['project'=>$curProject->slug])}}">Dettagli</a> 
                        <a class='btn btn-info' href="{{ route('admin.projects.edit',['project'=>$curProject->slug])}}">modifica</a> 

                        <form action="{{route('admin.projects.destroy', ['project'=>$curProject->slug])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection