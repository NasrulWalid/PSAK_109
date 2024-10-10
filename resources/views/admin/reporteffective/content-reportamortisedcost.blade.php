<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Accrual Interest</title>
    <!-- CSS untuk Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Tambahkan margin untuk menggeser konten ke kanan */
        .content-wrapper {
            margin-left: 300px; /* Sesuaikan dengan lebar sidebar */
            margin-top: 100px; /* Tambahan margin top agar lebih jauh dari atas */
        }
    </style>
</head>
<body>
    <div class="container content-wrapper">
        <h2>Report Amortised Cost</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Account</th>
                        <th>Debtor Name</th>
                        <th>Original Balance</th>
                        <th>Original Date</th>
                        <th>Term</th>
                        <th>Maturity Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>900012100002</td>
                        <td>Test-Contoh - BPAK</td>
                        <td>2,023.00</td>
                        <td>2024-09-11</td>
                        <td>999</td>
                        <td>2024-09-11</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                    <tr>
                        <td>900012100003</td>
                        <td>Test-Contoh 2 - BPBK</td>
                        <td>5,500.00</td>
                        <td>2024-01-15</td>
                        <td>1200</td>
                        <td>2025-01-15</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script untuk Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
