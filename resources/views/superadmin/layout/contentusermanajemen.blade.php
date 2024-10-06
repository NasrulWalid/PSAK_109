<div class="container" style="margin-top: 7rem;"> <!-- Menambahkan inline style untuk margin yang lebih besar -->
    <div class="row justify-content-center"> <!-- Menambahkan row dan justify-content-center -->
        <div class="col-md-10 offset-md-1"> <!-- Menentukan lebar konten dan menggeser ke kanan -->
            <div class="card">
                <div class="card-header">
                    <a href="/add/user" class="btn btn-primary btn-md float-end">Tambah User</a>
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
                                        <td>{{ $item->pt->nama_pt ?? 'N/A' }}</td>
                                        <td>{{ $item->pt->alamat ?? 'N/A' }}</td>
                                        <td>{{ $item->nomor_wa }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td><a href="/edit/{{ $item->id }}" class="btn btn-primary btn-sm">Edit</a></td>
                                        <td><a href="/delete/{{ $item->id }}" class="btn btn-danger btn-sm">Delete</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11">No User Found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
