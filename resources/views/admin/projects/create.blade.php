@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Aggiungi Un Progetto</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('admin.projects.store')}}" method="POST" class="form-control my-4" enctype="multipart/form-data">
                    @csrf

                    <label for="cover_image">Aggiungi un immagine</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control" required @error('cover_image') is-invalid @enderror>

                @error('cover_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="title" class="form-control" required
                    placeholder="Inserisci il titolo" value="{{ old('title') }}">

                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                    <label for="type_id" class="control-label">Seleziona Categoria</label>
                    <select name="type_id" id="type_id" class="form-select mb-2">
                        <option value="">Seleziona una categoria</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach

                <label for="content">Descrizione</label>
                <textarea name="content" id="content" cols="100" rows="10" class="form-control" placeholder="Inserisci la descrizione del progetto"></textarea>

                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-sm btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>
    </div>

@endsection