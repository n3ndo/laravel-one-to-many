@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $project->title }}
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $project->content }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <img src="{{ asset('/storage/' . $project->cover_image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection