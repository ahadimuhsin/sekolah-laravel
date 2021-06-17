@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-users"></i> Users</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.user.index') }}" method="get">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    @can('users.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.user.create') }}"
                                        class="btn btn-primary"
                                        style="padding-top: 10px">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </a>
                                    </div>
                                    @endcan
                                    <input type="text" name="keyword" placeholder="Cari berdasarkan nama role">
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
                                        <th scope="col" style="width: 15%">
                                            Nama User
                                        </th>
                                        <th>Role</th>
                                        <th style="width: 15%" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $no => $user)
                                    <tr>
                                        <th scoper="row" class="text-center">
                                            {{ ++$no + ($users->currentPage()-1) * $users->perPage() }}
                                        </th>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $role)
                                                    <label class="badge badge-success text-center">
                                                        {{ $role }}
                                                    </label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @can('users.edit')
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @endcan

                                            @can('users.delete')
                                            <button class="btn btn-sm btn-danger" onclick="Delete(this.id)"
                                            id="{{ $user->id }}">
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
                            <div class="text-center">
                                {{ $users->links("vendor.pagination.bootstrap-4") }}
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
                    url: "{{ url('admin/user') }}/" +id,
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
