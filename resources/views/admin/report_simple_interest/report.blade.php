<div class="main-content">
    <div class="container mt-5">
        <section class="section">
            <div class="section-header">
                <h1>Data Customer</h1>
            </div>
            @if(session('pesan'))
                <div class="alert alert-success">{{ session('pesan') }}</div>
            @endif
            <table class="table table-striped table-bordered">
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
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->no_acc }}</td>
                            <td>{{ $loan->deb_name }}</td>
                            <td>{{ number_format($loan->org_bal, 2) }}</td>
                            <td>{{ date('Y-m-d', strtotime($loan->org_date)) }}</td>
                            <td>{{ $loan->TERM }}</td>
                            <td>{{ date('Y-m-d', strtotime($loan->mtr_date)) }}</td>
                            <td>
                                <a href="{{ route('report.view', $loan->no_acc) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
