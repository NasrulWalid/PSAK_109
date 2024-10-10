<?php

namespace App\Http\Controllers\report\Report_Accrual_Interest;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class Reportcontroller extends Controller
{
    // Method untuk menampilkan semua data pinjaman korporat
    public function index()
    {
        $loans = Report::getCorporateLoans();
        return view('admin.report_simple_interest.master', compact('loans'));
    }

    // Method untuk menampilkan detail pinjaman berdasarkan nomor akun
    public function view($no_acc)
    {
        $loan = Report::getLoanDetails($no_acc);
        $reports = Report::getReportsByNoAcc($no_acc);

        if (!$loan) {
            abort(404, 'Loan not found');
        }

        return view('admin.report_simple_interest.view', compact('loan', 'reports'));
    }

    // Method untuk mengekspor data ke Excel
    public function exportExcel($no_acc)
    {
        $loan = Report::getLoanDetails($no_acc);
        $reports = Report::getReportsByNoAcc($no_acc);

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengisi data untuk Excel
        $sheet->setCellValue('A1', 'No. Account:');
        $sheet->setCellValue('B1', $loan->NO_ACC);
        $sheet->setCellValue('A2', 'Debtor Name:');
        $sheet->setCellValue('B2', $loan->DEB_NAME);
        $sheet->setCellValue('A3', 'Original Balance:');
        $sheet->setCellValue('B3', number_format($loan->ORG_BAL, 2));
        $sheet->setCellValue('A4', 'Original Date:');
        $sheet->setCellValue('B4', $loan->ORG_DATE);
        $sheet->setCellValue('A5', 'Term:');
        $sheet->setCellValue('B5', $loan->TERM);
        $sheet->setCellValue('A6', 'Maturity Date:');
        $sheet->setCellValue('B6', $loan->MTR_DATE);

        // Header report
        $sheet->setCellValue('A8', 'Month');
        $sheet->setCellValue('B8', 'Transaction Date');
        $sheet->setCellValue('C8', 'Days Interest');
        $sheet->setCellValue('D8', 'Payment Amount');
        $sheet->setCellValue('E8', 'Withdrawal');
        $sheet->setCellValue('F8', 'Reimbursement');
        $sheet->setCellValue('G8', 'Interest Recognition');
        $sheet->setCellValue('H8', 'Interest Payment');
        $sheet->setCellValue('I8', 'Amortised');
        $sheet->setCellValue('J8', 'Carrying Amount');
        $sheet->setCellValue('K8', 'Cumulative Amortized');
        $sheet->setCellValue('L8', 'Unamortized');

        $row = 9;
        foreach ($reports as $report) {
            $sheet->setCellValue('A' . $row, $report->month);
            $sheet->setCellValue('B' . $row, $report->transaction_date);
            $sheet->setCellValue('C' . $row, $report->days_interest);
            $sheet->setCellValue('D' . $row, $report->payment_amount);
            $sheet->setCellValue('E' . $row, $report->withdrawal);
            $sheet->setCellValue('F' . $row, $report->reimbursement);
            $sheet->setCellValue('G' . $row, $report->interest_recognition);
            $sheet->setCellValue('H' . $row, $report->interest_payment);
            $sheet->setCellValue('I' . $row, $report->amortised);
            $sheet->setCellValue('J' . $row, $report->carrying_amount);
            $sheet->setCellValue('K' . $row, $report->cumulative_amortized);
            $sheet->setCellValue('L' . $row, $report->unamortized);
            $row++;
        }

        // Menyiapkan download Excel
        $filename = "report_$no_acc.xlsx";
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    // Method untuk mengekspor data ke PDF
    public function exportPdf($no_acc)
    {
        $loan = Report::getLoanDetails($no_acc);
        $reports = Report::getReportsByNoAcc($no_acc);

        $html = view('report.pdf_template', compact('loan', 'reports'))->render();

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream("report_$no_acc.pdf", ["Attachment" => 1]);
    }
}
