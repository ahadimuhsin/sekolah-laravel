@extends('layouts.app')

@section('title')
Tambah Video
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Tambah Video</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-bell"></i> Tambah Video</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.video.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan Judul Video">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="embed">Embed Youtube</label>
                            <input name="embed" id="embed"
                                class="form-control content @error('embed') is-invalid @enderror"
                                placeholder="Link Embed Youtube" value="{{ old('embed') }}">

                            @error('embed')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                        <button class="btn btn-warning mr-1 btn-reset" type="reset">
                            <i class="fa fa-redo"></i> Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

