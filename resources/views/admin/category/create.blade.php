@extends('layouts.app')

@section('title')
Tambah Kategori
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Tambah Kategori</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Tambah Kategori</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan Nama Kategori">

                            @error('name')
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
