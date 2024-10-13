<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit User</h3>
                        <a href="{{ route('admin.usermanajemen') }}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    
                    <div class="card-body">
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        
                        <!-- Perbaikan pengiriman parameter user_id -->
                        <form method="POST" action="{{ route('admin.update.user', ['user_id' => $user->user_id]) }}">

                            @csrf
                            
                            <!-- Nama Lengkap -->
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Nomor WhatsApp -->
                            <div class="form-group">
                                <label for="nomor_wa">Nomor WhatsApp</label>
                                <input type="text" name="nomor_wa" class="form-control" value="{{ old('nomor_wa', $user->nomor_wa) }}" required>
                                @error('nomor_wa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Role (Disabled) -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" disabled>
                                    <option value="user" selected>User</option>
                                </select>
                                <input type="hidden" name="role" value="{{ $user->role }}">
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Nama PT (Disabled) -->
                            <div class="form-group">
                                <label for="nama_pt">Nama PT</label>
                                <input type="text" class="form-control" value="{{ $user->nama_pt }}" disabled>
                                <input type="hidden" name="nama_pt" value="{{ $user->nama_pt }}">
                                @error('nama_pt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Alamat PT (Disabled) -->
                            <div class="form-group">
                                <label for="alamat_pt">Alamat PT</label>
                                <input type="text" class="form-control" value="{{ $user->alamat_pt }}" disabled>
                                <input type="hidden" name="alamat_pt" value="{{ $user->alamat_pt }}">
                                @error('alamat_pt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Company Type (Disabled) -->
                            <div class="form-group">
                                <label for="company_type">Tipe Perusahaan</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->company_type }}" disabled>
                                <input type="hidden" name="company_type" value="{{ auth()->user()->company_type }}">
                                @error('company_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Konfirmasi Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
