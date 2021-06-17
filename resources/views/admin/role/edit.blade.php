@extends('layouts.app')

@section('title')
Edit Role
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Edit Role</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Role</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.role.update', $role->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Nama Role</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan Nama Role">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="permission" class="font-weight-bold">Permissions: </label>
                            <br>
                            @foreach ($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="permissions[]"
                                id="check-{{ $permission->id }}"
                                class="form-check-input" value="{{ $permission->name }}"
                                @if($role->permissions->contains($permission)) checked @endif>
                                <label for="check-{{ $permission->id }}" class="form-check-label">
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Update
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
