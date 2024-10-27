<div class="content-wrapper" style="font-size: 15px;">
    <div class="main-content" style="padding-top: 20px;">
        <div class="container mt-5">
            <section class="section">
                <div class="section-header">
                    <h1>Loan Details</h1>
                </div>
                <div class="mb-3">
                    <a href="{{ route('report-acc-eff.exportPdf', $loan->no_acc) }}" class="btn btn-danger">Export to PDF</a>
                    <a href="{{ route('report-acc-eff.exportExcel', $loan->no_acc) }}" class="btn btn-success">Export to Excel</a>
                </div>

                <!-- Loan Details Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Journal - Effective</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Branch Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{ $loan->no_branch }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Branch Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{ 'null' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 row">
                                    <label class="col-sm-3 col-form-label">Date Of Report</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{ 'null' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Report Table -->
                <h2>Report Details</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Branch Number</th>
                                <th>GL Account</th>
                                <th>Description of Transaction</th>
                                <th>Valuta</th>
                                <th>Post</th>
                                <th>Amount</th>
                                <th>Posting Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reports->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak ditemukan atau belum di-generate</td>
                                </tr>
                            @else
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->bulanke ?? 'Data tidak ditemukan' }}</td>
                                        <td>{{ isset($report->tglangsuran) ? date('Y-m-d H:i:s', strtotime($report->tglangsuran)) : 'Belum di-generate' }}</td>
                                        <td>{{ $report->days_interest ?? 0, 2 }}</td> <!-- Placeholder untuk Days Interest -->
                                        <td>{{ number_format($report->pmtamt ?? 0, 2) }}</td>
                                        <td>{{ number_format($report->withdrawal ?? 0, 2) }}</td> <!-- Placeholder untuk Withdrawal -->
                                        <td>{{ number_format($report->reimbursement ?? 0, 2) }}</td> <!-- Placeholder untuk Reimbursement -->
                                        <td>{{ number_format($report->bunga ?? 0, 2) }}</td>
                                        <td>{{ number_format($report->balance ?? 0, 2) }}</td>
                                        <td>{{ number_format($report->timegap ?? 0, 2) }}</td>
                                        <td>{{ number_format($report->outsamtconv ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
</section>
