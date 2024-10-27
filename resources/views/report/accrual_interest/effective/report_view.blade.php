<div class="content-wrapper" style="font-size: 15px;">
    <div class="main-content" style="padding-top: 20px;">
        <div class="container mt-5">
            <section class="section">
                <div class="section-header">
                    <h1>Loan Details</h1>
                </div>
                <div class="mb-3">
                    <a href="{{ route('report-acc-si.exportPdf', $loan->no_acc) }}" class="btn btn-danger">Export to PDF</a>
                    <a href="{{ route('report-acc-si.exportExcel', $loan->no_acc) }}" class="btn btn-success">Export to Excel</a>
                </div>
<!-- Loan Details Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">Report Accrual Interest - Effective</h5>
    </div>
    <div class="card-body">
        <form>
    <div class="form-row">
        <div class="form-group col-md-6 row">
            <label class="col-sm-3 col-form-label">Account Number</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="{{ $loan->no_acc }}" readonly>
            </div>
        </div>
        <div class="form-group col-md-6 row">
            <label class="col-sm-4 col-form-label d-flex justify-content-end">Outstanding Amount</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ 'null' }}" readonly>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 row">
            <label class="col-sm-3 col-form-label">Debitor Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="{{ $loan->deb_name }}" readonly>
            </div>
        </div>
        <div class="form-group col-md-6 row">
            <label class="col-sm-4 col-form-label d-flex justify-content-end">EIR Convertion Calculated</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ $loan->eircalc_conv }}" readonly>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 row">
            <label class="col-sm-3 col-form-label">Original Amount</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="{{ number_format($loan->org_bal, 2) }}" readonly>
            </div>
        </div>
        <div class="form-group col-md-6 row">
            <label class="col-sm-4 col-form-label d-flex justify-content-end">Original Loan Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($loan->org_date)) }}" readonly>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 row">
            <label class="col-sm-3 col-form-label">Term</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="{{ $loan->TERM }}" readonly>
            </div>
        </div>
        <div class="form-group col-md-6 row">
            <label class="col-sm-4 col-form-label d-flex justify-content-end">Maturity Date</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($loan->mtr_date)) }}" readonly>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 row">
            <label class="col-sm-3 col-form-label">Interest Rate</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="{{ $loan->interest }}" readonly>
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
                                <th>Month</th>
                                <th>Transaction Date</th>
                                <th>Days Interest</th>
                                <th>Payment Amount</th>
                                <th>Withdrawal</th>
                                <th>Reimbursement</th>
                                <th>Accrued Interest</th>
                                <th>Interest Payment</th>
                                <th>Time Gap</th>
                                <th>Outstanding Amount</th>
                                <th>Cummulative Time Gap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->bulanke }}</td>
                                    <td>{{ date('d-m-Y', strtotime($report->tglangsuran)) }}</td>
                                    <td>{{ $report->bunga }}</td>
                                    <td>{{ number_format($report->pmtamt, 2) }}</td>
                                    <td>{{ number_format($report->pokok, 2) }}</td>
                                    <td>{{ number_format( 2) }}</td>
                                    <td>{{ number_format($report->balance, 2) }}</td>
                                    <td>{{ number_format($report->bungaeir, 2) }}</td>
                                    <td>{{ number_format($report->timegap, 2) }}</td>
                                    <td>{{ number_format($report->outsamtconv, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
</section>
