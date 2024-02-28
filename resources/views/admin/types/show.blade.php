@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 bg-light shadow rounded pt-2 px-2">
                    <h2>{{ $type->name }}</h2>
                </div>
                @forelse( $type->projects as $project)
                    <p>{{ $project->title }}</p>
                @empty
                    <p>nessun progetto</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection