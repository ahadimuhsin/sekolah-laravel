@extends('layouts.app')

@section('title')
Video
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Video</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-video"></i> Video</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.video.index') }}" method="get">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    @can('videos.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.video.create') }}"
                                        class="btn btn-primary"
                                        style="padding-top: 10px">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </a>
                                    </div>
                                    @endcan
                                    <input type="text" name="keyword" placeholder="Cari berdasarkan nama video" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center; width: 6%">
                                        No
                                        </th>
                                        <th scope="col">
                                            Judul
                                        </th>
                                        <th scope="col">
                                            Video
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($videos as $no => $video)
                                    <tr>
                                        <th scoper="row" class="text-center">
                                            {{ ++$no + ($videos->currentPage()-1) * $videos->perPage() }}
                                        </th>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->embed }}</td>
                                        <td class="text-center">
                                            @can('videos.edit')
                                            <a href="{{ route('admin.video.edit', $video->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @endcan

                                            @can('videos.delete')
                                            <button class="btn btn-sm btn-danger" onclick="Delete(this.id)"
                                            id="{{ $video->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $videos->links("vendor.pagination.bootstrap-4") }}
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
                    url: "{{ url('admin/video') }}/" +id,
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
                            }).then(function(){
                                location.reload();
                            });
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
