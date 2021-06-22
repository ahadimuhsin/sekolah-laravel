@extends('layouts.app')

@section('title')
Tambah Event
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Tambah Event</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-bell"></i> Tambah Event</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.event.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Nama Event</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan Nama event">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Lokasi</label>
                                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                                    class="form-control @error('location') is-invalid @enderror"
                                    placeholder="Lokasi">

                                    @error('location')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Tanggal</label>
                                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                                    class="form-control @error('date') is-invalid @enderror"
                                    placeholder="Tanggal">

                                    @error('date')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Isi Agenda</label>
                            <textarea name="content" id="content"
                                class="form-control content @error('content') is-invalid @enderror"
                                placeholder="Isi Berita" rows="10">{{ old('content') }}</textarea>

                            @error('content')
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

@push('custom-script')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            selector: "#content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak ",
                "searchreplace wordcount visualblocks visualchars code fullscreen ",
                "insertdatetime media nonbreaking save table contextmenu directionality ",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: `insertfile undo redo | styleselect | bold italic |
            alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |
            link image media `,
            relative_urls: false,
        };
        tinymce.init(editor_config);
    //      tinymce.init({
    //     selector: '#mytextarea'
    //   });

    </script>
@endpush
