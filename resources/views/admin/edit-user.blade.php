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
                        
                        <form method="POST" action="{{ route('admin.update.user', ['id' => $user->id]) }}">
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
                            
                            <!-- Role -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Nama PT -->
                            <div class="form-group">
                                <label for="nama_pt">Nama PT</label>
                                <input type="text" name="nama_pt" class="form-control" value="{{ old('nama_pt', $user->nama_pt) }}" required>
                                @error('nama_pt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Alamat PT -->
                            <div class="form-group">
                                <label for="alamat_pt">Alamat PT</label>
                                <input type="text" name="alamat_pt" class="form-control" value="{{ old('alamat_pt', $user->alamat_pt) }}" required>
                                @error('alamat_pt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                                <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Masukkan Password Baru (Jika ingin mengubah)">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Konfirmasi Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" placeholder="Masukkan Ulang Password Baru (Jika ingin mengubah)">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
