@extends('layouts.app')

@section('title')
Ubah Video
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Ubah Video</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-bell"></i> Ubah Video</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.video.update', $video->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}"
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
                                placeholder="Link Embed Youtube" value="{{ old('embed', $video->embed) }}">

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
