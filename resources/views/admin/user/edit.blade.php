@extends('layouts.app')

@section('title')
Ubah User
@endsection

@section('content')
<div class="main-content">
    <div class="section">
        <div class="section-header">
            <h1>Ubah User</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Ubah User</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan Nama User">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan Email">

                            @error('email')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password(<small style="color: red">Kosongkan Jika Tidak Ingin Ganti Password</small>)</label>
                            <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan Password">

                            @error('password')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group" style="display: none" id="konfirmasi_password">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Konfirmasi Password">
                        </div>

                        <div class="form-group">
                            <label for="role" class="font-weight-bold">Roles: </label>
                            <br>
                            @foreach ($roles as $role)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="role[]"
                                id="check-{{ $role->id }}"
                                class="form-check-input" value="{{ $role->name }}"
                                {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                <label for="check-{{ $role->id }}" class="form-check-label">
                                    {{ $role->name }}
                                </label>
                            </div>
                            @endforeach

                            @error('role')
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
<script>
    $(document).ready(function(){
        $("#password").keyup(function(){
            $("#konfirmasi_password").show();

            if($(this).val() == ""){
                $("#konfirmasi_password").hide();
            }
        });
    })
</script>
@endpush
