<div class="container" style="margin-top: 7rem;"> <!-- Menambahkan inline style untuk margin yang lebih besar -->
    <div class="row justify-content-center"> <!-- Menambahkan row dan justify-content-center -->
        <div class="col-md-10 offset-md-1"> <!-- Menentukan lebar konten dan menggeser ke kanan -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Tombol Tambah User -->
                    <a href="{{ route('superadmin.add.user') }}" class="btn btn-primary btn-md float-end">
                        <i class="fas fa-plus"></i> Tambah User <!-- Menambahkan ikon plus -->
                    </a>
                </div>

                @if (Session::has('success'))
                    <span class="alert alert-success p-1">{{ Session::get('success') }}</span>
                @endif
                @if (Session::has('fail'))
                    <span class="alert alert-danger p-1">{{ Session::get('fail') }}</span>
                @endif

                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered">
                        <thead class="p-1">
                            <tr>
                                <th>S/N</th>
                                <th>Nama Lengkap</th>
                                <th>Nama PT</th>
                                <th>Alamat PT</th>
                                <th>Nomor Whatsapp</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Company Type</th> <!-- Menambahkan kolom Company Type -->
                                <th>Registrations Date</th>
                                <th>Last Updated</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($all_users) > 0)
                                @foreach ($all_users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->nama_pt ?? 'N/A' }}</td>
                                        <td>{{ $item->alamat_pt ?? 'N/A' }}</td>
                                        <td>{{ $item->nomor_wa }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->company_type ?? 'N/A' }}</td> <!-- Menampilkan Company Type -->
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('superadmin.edit.user', ['id' => $item->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Edit <!-- Menambahkan ikon pensil -->
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('superadmin.delete.user', ['id' => $item->id]) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete <!-- Menambahkan ikon sampah -->
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12">No User Found!</td> <!-- Update colspan untuk menyesuaikan kolom tambahan -->
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
