<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Form Edit User</title>
</head>
<body>

    <div class="container mt-5 p-4 border rounded shadow">
        <h2 class="mb-4 text-center">Form Edit User</h2>
        <form method="POST" action="{{ route('superadmin.EditUser', $user->id) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row">
                <!-- Nama Lengkap -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="name" :value="'Nama Lengkap'" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" placeholder="Masukkan Nama Lengkap Anda"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <!-- Tipe Perusahaan -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="company_type" :value="'Tipe Perusahaan'" />
                    <select id="company_type" class="form-control" name="company_type" required>
                        <option value="">Pilih Tipe Perusahaan</option>
                        <option value="Bank" {{ $user->company_type == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="Perusahaan Pembiayaan" {{ $user->company_type == 'Perusahaan Pembiayaan' ? 'selected' : '' }}>Perusahaan Pembiayaan</option>
                        <option value="Perusahaan Asuransi" {{ $user->company_type == 'Perusahaan Asuransi' ? 'selected' : '' }}>Perusahaan Asuransi</option>
                        <!-- Tambahkan pilihan lain jika diperlukan -->
                    </select>
                    <x-input-error :messages="$errors->get('company_type')" class="mt-2" />
                </div>
                
                <!-- Alamat PT -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="alamat_pt" :value="'Alamat PT'" />
                    <x-text-input id="alamat_pt" class="form-control" type="text" name="alamat_pt" :value="$user->alamat_pt" required autofocus autocomplete="alamat_pt" placeholder="Masukkan Alamat PT Anda" />
                    <x-input-error :messages="$errors->get('alamat_pt')" class="mt-2" />
                </div>

                <!-- Nomor WhatsApp -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="nomor_wa" :value="'Nomor WhatsApp'" />
                    <x-text-input id="nomor_wa" class="form-control" type="text" name="nomor_wa" :value="$user->nomor_wa" required autofocus autocomplete="nomor_wa" placeholder="Masukkan Nomor WhatsApp Anda" />
                    <x-input-error :messages="$errors->get('nomor_wa')" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="$user->email" required autocomplete="email" placeholder="Masukkan Alamat Email Anda" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="role" :value="'Role'" />
                    <select id="role" class="form-control" name="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <!-- Password -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="password" :value="'Password (Biarkan kosong jika tidak ingin mengubah)'" />
                    <x-text-input id="password" class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Masukkan Password Baru (Jika ingin mengubah)" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="col-md-6 mb-3">
                    <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />
                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Masukkan Ulang Password Baru (Jika ingin mengubah)"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>