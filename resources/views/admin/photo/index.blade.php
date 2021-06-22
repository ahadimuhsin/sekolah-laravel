@extends('layouts.app')

@section('title')
Photo
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Photo</h1>
            </div>

            <div class="section-body">
                @can('photos.create')
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-image"></i> Upload Foto
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.photo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

                                @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Caption</label>
                                <input type="text" name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror">

                                @error('caption')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mr-1 btn-submit" type="submit">
                                <i class="fa fa-paper-plane"></i> Upload
                            </button>
                            <button class="btn btn-warning mr-1 btn-reset" type="reset">
                                <i class="fa fa-redo"></i> Reset
                            </button>
                        </form>
                    </div>
                </div>
                @endcan

                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-image"></i> Foto
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 6%" class="text-center">No</th>
                                        <th>Foto</th>
                                        <th>Caption</th>
                                        <th class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($photos as $no => $photo)
                                    <tr>
                                        <th scoper="row" class="text-center">
                                            {{ ++$no + ($photos->currentPage()-1) * $photos->perPage() }}
                                        </th>
                                        <td>
                                            <img src="{{ $photo->foto }}" alt="Foto" style="width: 150px" >
                                        </td>
                                        <td>{{ $photo->caption }}</td>
                                        <td class="text-center">
                                            @can('photos.delete')
                                            <button class="btn btn-sm btn-danger" onclick="Delete(this.id)"
                                            id="{{ $photo->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                {{$photos->links("vendor.pagination.bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('custom-script')
<script>
    //ajax delete
    function Delete(id)
    {
        var id = id;
        var token = $("meta[name='csrf-token']").attr('content');
        console.log(id);

        swal({
            title: "Yakin mau hapus ini?",
            text: "Hapus Data",
            icon: "warning",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: "{{ url('admin/photo') }}/" +id,
                    data: {
                        "id" : id,
                        "_token": token
                    },
                    type: "DELETE",
                    success: function(response){
                        if(response.status == "success"){
                            swal({
                                title: "Sukses",
                                text: "Data Berhasil Dihapus",
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false
                            }).then(function(){
                                location.reload();
                            });
                        }
                        else{
                            swal({
                                title: "Gagal",
                                text: "Data Gagal Dihapus",
                                icon: 'error',
                                timer: 3000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false
                            })
                            // .then(function(){
                            //     location.reload();
                            // });
                        }
                    }
                })
            }
            else{
                return true;
            }
        })
    }
</script>
@endpush
