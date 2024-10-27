<div class="content-wrapper">
    <div class="main-content" style="padding-top: 20px;">
        <div class="container mt-5" style="padding-right: 50px;">
            <section class="section">
                <div class="section-header">
                    <h4>REPORT JOURNAL - EFFECTIVE</h4>
                </div>
                @if(session('pesan'))
                    <div class="alert alert-success">{{ session('pesan') }}</div>
                @endif
                <div class="table-responsive text-center">
                    <table class="table table-striped table-bordered custom-table" style="width: 100%; margin: 0 auto;">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Branch Number</th>
                                <th style="width: 25%;">Branch Name</th>
                                <th style="width: 20%;">Date Of Repor</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->no_branch }}</td>
                                    <td>{{ 'null' }}</td>
                                    <td>{{'null'}}</td>
                                    <td>
                                        <a href="{{ route('report-journal-eff.view', $loan->no_acc) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye" style="margin-right: 5px;"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Menambahkan row untuk pagination dan showing -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <div class="showing-entries">
                Showing
                {{$loans->firstItem()}}
                to
                {{$loans->lastItem()}}
                of
                {{$loans->total()}}
                entries
            </div>
        </div>
        <div class="col-md-6">
            <!-- Menambahkan pagination dengan d-flex justify-content-end untuk menekan ke kanan -->
            <div class="d-flex justify-content-end">
                {{ $loans->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    body {
        display: fixed;
        background-color: #f4f7fc;
        font-family: 'Arial', sans-serif;
    }
    .showing-entries {
        font-size: 12px; /* Ganti ukuran font sesuai keinginan, misalnya 12px, 14px, dll */
        margin-top: 20px;
    }
    .pagination {
        margin-top: 20px;
    }
    .pagination .page-item.active .page-link {
    background-color: #8bc3ff; /* Warna latar halaman aktif */
    border-color: #007bff; /* Warna border halaman aktif */
    color: white; /* Warna teks halaman aktif */
}
    .main-content {
        margin-left: 20px; /* Diperbarui untuk menghapus margin kiri */
        width: 100%; /* Diperbarui lebar */
        padding-top: fixed;
        padding-right: fixed;
    }
    .section-header h4 {
        font-size: 26px;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
    }
    .custom-table {
        width: 100%; /* Full width to use available space */
        margin: 20px auto;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 12px;
        font-size: 10px;
    }
    .custom-table th, .custom-table td {
        padding: 8px 12px;
        text-align: center;
        vertical-align: middle;
    }
    .custom-table thead {
        background-color: #4a90e2;
        color: #fff;
    }
    .custom-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .custom-table tbody tr:hover {
        background-color: #e1f5fe;
        transition: background-color 0.3s ease;
    }
    .custom-table th {
        text-transform: uppercase;
        font-weight: 500;
        font-size: 10px;
        white-space: nowrap;
    }
    .custom-table td a {
        text-decoration: none;
        color: #fff;
        font-size: 12px;
    }
    .custom-table td a.btn-info {
        background-color: #00bcd4;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .custom-table td a.btn-info i {
        margin-right: 5px;
        vertical-align: middle;
    }
    .custom-table td a.btn-info:hover {
        background-color: #0097a7;
        transform: scale(1.05);
    }
</style>

<!-- Font Awesome Link -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
