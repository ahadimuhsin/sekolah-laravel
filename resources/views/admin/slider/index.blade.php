@extends('layouts.app')

@section('title')
Slider
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Slider</h1>
            </div>

            <div class="section-body">
                @can('sliders.create')
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-laptop"></i> Upload Slider
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
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
                            <i class="fas fa-laptop"></i> Slider
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 6%" class="text-center">No</th>
                                        <th>Foto</th>
                                        <th class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sliders as $no => $slider)
                                    <tr>
                                        <th scoper="row" class="text-center">
                                            {{ ++$no + ($sliders->currentPage()-1) * $sliders->perPage() }}
                                        </th>
                                        <td>
                                            <img src="{{ $slider->foto }}" alt="Foto" style="width: 150px" >
                                        </td>
                                        <td class="text-center">
                                            @can('sliders.delete')
                                            <button class="btn btn-sm btn-danger" onclick="Delete(this.id)"
                                            id="{{ $slider->id }}">
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
                                {{$sliders->links("vendor.pagination.bootstrap-4")}}
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
                    url: "{{ url('admin/slider') }}/" +id,
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
                            .then(function(){
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
