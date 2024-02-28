@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
             <h2>
                Projects
            </h2>
             <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->slug }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.types.show', ['type' => $type->id]) }}" class="btn btn-sm btn-primary me-1"><i class="fa-solid fa-magnifying-glass"></i></a>

                                        {{-- <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a> --}}

                                        {{-- <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Vuoi eliminare questo record??')"><i class="fa-solid fa-trash"></i></button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection