
@extends('layouts.app')

@section('title')
Ubah Berita
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Ubah Berita</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Ubah Berita</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" id="image" class="form-control
                            @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Judul Berita</label>
                            <input type="text" name="title" id="name" value="{{ old('title', $post->title) }}"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Masukkan Judul Berita">

                            @error('title')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Kategori</label>
                            <select name="post_id"
                                class="form-control select-post @error('post_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    @if ($post->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>
                                        {{ $category->name }}
                                    </option>
                                    @else
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                    @endif

                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Isi Berita</label>
                            <textarea name="content" id="content" value="{{ old('content') }}"
                                class="form-control content @error('content') is-invalid @enderror"
                                placeholder="Isi Berita" rows="10">{!! old('content', $post->content) !!}</textarea>

                            @error('content')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select name="tags[]" class="form-control" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, $post->tags()->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tags')
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
