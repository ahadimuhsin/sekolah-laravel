@extends('layouts.app')

@section('title')
    Permission
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Permission</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-key"></i> Permissions</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.permission.index') }}" method="get">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" placeholder="Cari berdasarkan nama permissions" class="form-control">
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
                                            Nama Permission
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $no => $permission)
                                    <tr>
                                        <th scoper="row" class="text-center">
                                            {{ ++$no + ($permissions->currentPage()-1) * $permissions->perPage() }}
                                        </th>
                                        <td>{{ $permission->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $permissions->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
