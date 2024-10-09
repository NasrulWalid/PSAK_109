<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Manajemen Pengguna</h3>
                        <a href="{{ route('admin.add.user') }}" class="btn btn-primary float-right">
                            <i class="fas fa-plus"></i> Tambah User
                        </a>
                    </div>
                    
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama PT</th>
                                    <th>Alamat PT</th>
                                    <th>Nomor WhatsApp</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Terakhir Diperbarui</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (auth()->check() && auth()->user()->role == 'admin')
                                    <!-- Menampilkan data admin yang sedang login hanya sekali -->
                                    <tr>
                                        <td>1</td>
                                        <td>{{ auth()->user()->name }}</td>
                                        <td>{{ auth()->user()->nama_pt ?? 'N/A' }}</td>
                                        <td>{{ auth()->user()->alamat_pt ?? 'N/A' }}</td>
                                        <td>{{ auth()->user()->nomor_wa }}</td>
                                        <td>{{ auth()->user()->email }}</td>
                                        <td>{{ ucfirst(auth()->user()->role) }}</td>
                                        <td>{{ auth()->user()->created_at->format('d M Y') }}</td>
                                        <td>{{ auth()->user()->updated_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.user', ['id' => auth()->user()->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.delete.user', ['id' => auth()->user()->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Menampilkan data user lain yang memiliki nama_pt sama dengan admin, kecuali admin yang login -->
                                    @foreach ($all_users->where('id', '!=', auth()->user()->id) as $index => $user)
                                        <tr>
                                            <td>{{ $index + 2 }}</td> <!-- Mulai dari 2 karena admin ditampilkan pertama -->
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->nama_pt ?? 'N/A' }}</td>
                                            <td>{{ $user->alamat_pt ?? 'N/A' }}</td>
                                            <td>{{ $user->nomor_wa }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucfirst($user->role) }}</td>
                                            <td>{{ $user->created_at->format('d M Y') }}</td>
                                            <td>{{ $user->updated_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit.user', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete.user', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($all_users->where('id', '!=', auth()->user()->id)->isEmpty())
                                        <tr>
                                            <td colspan="10" class="text-center">No User Found!</td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">Access Denied! Only Admin can view this page.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        
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
