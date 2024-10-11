<div class="main-content" style="margin-left: 250px; padding-top: 20px;">
    <div class="container mt-5">
        <section class="section">
            <div class="section-header">
                <h1>Loan Details</h1>
            </div>
            <div class="mb-3">
                <a href="{{ route('report.exportPdf', $loan->no_acc) }}" class="btn btn-danger">Export to PDF</a>
                <a href="{{ route('report.exportExcel', $loan->no_acc) }}" class="btn btn-success">Export to Excel</a>
            </div>

            <!-- Loan Details Form -->
            <form>
                <div class="form-group">
                    <label>No. Account</label>
                    <input type="text" class="form-control" value="{{ $loan->no_acc }}" readonly>
                </div>
                <div class="form-group">
                    <label>Debtor Name</label>
                    <input type="text" class="form-control" value="{{ $loan->deb_name }}" readonly>
                </div>
                <div class="form-group">
                    <label>Original Balance</label>
                    <input type="text" class="form-control" value="{{ number_format($loan->org_bal, 2) }}" readonly>
                </div>
                <div class="form-group">
                    <label>Original Date</label>
                    <input type="text" class="form-control" value="{{ date('Y-m-d', strtotime($loan->org_date)) }}" readonly>
                </div>
                <div class="form-group">
                    <label>Term</label>
                    <input type="text" class="form-control" value="{{ $loan->TERM }}" readonly>
                </div>
                <div class="form-group">
                    <label>Maturity Date</label>
                    <input type="text" class="form-control" value="{{ date('Y-m-d', strtotime($loan->mtr_date)) }}" readonly>
                </div>
            </form>

            <!-- Report Table -->
            <h2>Report Details</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Transaction Date</th>
                        <th>Days Interest</th>
                        <th>Payment Amount</th>
                        <th>Withdrawal</th>
                        <th>Reimbursement</th>
                        <th>Interest Recognition</th>
                        <th>Interest Payment</th>
                        <th>Amortised</th>
                        <th>Carrying Amount</th>
                        <th>Cumulative Amortized</th>
                        <th>Unamortized</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->month }}</td>
                            <td>{{ date('Y-m-d H:i:s', strtotime($report->tglangsuran)) }}</td>
                            <td>{{ $report->days_interest }}</td>
                            <td>{{ number_format($report->payment_amount, 2) }}</td>
                            <td>{{ number_format($report->withdrawal, 2) }}</td>
                            <td>{{ number_format($report->reimbursement, 2) }}</td>
                            <td>{{ number_format($report->interest_recognition, 2) }}</td>
                            <td>{{ number_format($report->interest_payment, 2) }}</td>
                            <td>{{ number_format($report->amortised, 2) }}</td>
                            <td>{{ number_format($report->carrying_amount, 2) }}</td>
                            <td>{{ number_format($report->cumulative_amortized, 2) }}</td>
                            <td>{{ number_format($report->unamortized, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- Custom CSS to handle the sidebar and padding -->
<style>
    body {
        display: flex;
    }
    .sidebar {
        width: 250px; /* Set sidebar width */
        position: fixed;
        height: 100%;
    }
    .main-content {
        margin-left: 250px; /* Matches the sidebar width */
        width: calc(100% - 250px); /* Adjust width according to sidebar */
        padding-top: 20px; /* Adds spacing at the top */
    }
</style>
