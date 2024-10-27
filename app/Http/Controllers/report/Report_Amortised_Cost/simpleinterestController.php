<?php

namespace App\Http\Controllers\report\Report_Amortised_Cost;

use App\Models\report_simpleinterest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class simpleinterestController extends Controller
{
    // Method untuk menampilkan semua data pinjaman korporat
    public function index()
    {
        $loans = report_simpleinterest::getCorporateLoans()->paginate(2);
        return view('report.amortised_cost.simple_interest.master', compact('loans'));
    }

    // Method untuk menampilkan detail pinjaman berdasarkan nomor akun
    public function view($no_acc)
    {
        $no_acc = trim($no_acc);
        $loan = report_simpleinterest::getLoanDetails($no_acc);
        $reports = report_simpleinterest::getReportsByNoAcc($no_acc);

        if (!$loan) {
            abort(404, 'Loan not found');
        }


        return view('report.amortised_cost.simple_interest.view', compact('loan', 'reports'));
    }

    public function exportExcel($no_acc)
    {
        // Ambil data loan dan reports
        $loan = report_simpleinterest::getLoanDetails(trim($no_acc));
        $reports = report_simpleinterest::getReportsByNoAcc(trim($no_acc));

        // Cek apakah data loan dan reports ada
        if (!$loan || $reports->isEmpty()) {
            return response()->json(['message' => 'No data found for the given account number.'], 404);
        }

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set informasi pinjaman
        // Set informasi pinjaman
        $sheet->setCellValue('A3', 'Account Account');
        $sheet->getStyle('A3')->getFont()->setBold(true); // Set bold untuk No. Account
        $sheet->setCellValue('B3', $loan->no_acc);
        $sheet->setCellValue('A4', 'Debitor Name');
        $sheet->getStyle('A4')->getFont()->setBold(true); // Set bold untuk Debtor Name
        $sheet->setCellValue('B4', $loan->deb_name);
        $sheet->setCellValue('A5', 'Original Amount');
        $sheet->getStyle('A5')->getFont()->setBold(true); // Set bold untuk Original Balance
        $sheet->setCellValue('B5', number_format($loan->org_bal, 2));
        $sheet->setCellValue('A6', 'Original Loan Date');
        $sheet->getStyle('A6')->getFont()->setBold(true); // Set bold untuk Original Date
        $sheet->setCellValue('B6', date('Y-m-d', strtotime($loan->org_date)));
        $sheet->setCellValue('A7', 'Term');
        $sheet->getStyle('A7')->getFont()->setBold(true); // Set bold untuk Term
        $sheet->setCellValue('B7', $loan->TERM);
        $sheet->setCellValue('A8', 'Maturity Loan Date');
        $sheet->getStyle('A8')->getFont()->setBold(true);
        $sheet->setCellValue('B8', date('Y-m-d', strtotime($loan->mtr_date))); // Set bold untuk Maturity Date
        $sheet->setCellValue('E3', 'Outstanding Interest');
        $sheet->getStyle('E3')->getFont()->setBold(true); // Set bol untuk Outstanding Interest
        $sheet->setCellValue('E4', 'Up Front Fee');
        $sheet->getStyle('E4')->getFont()->setBold(true); // Set bol untuk Up Front Fee
        $sheet->setCellValue('E5', 'Transaction Cost');
        $sheet->getStyle('E5')->getFont()->setBold(true); // Set bol untuk Transaction Cost
        $sheet->setCellValue('E6', 'Carrying Amount');
        $sheet->getStyle('E6')->getFont()->setBold(true); // Set bol untuk Carrying Amount
        $sheet->setCellValue('E7', 'EIR Exposure');
        $sheet->getStyle('E7')->getFont()->setBold(true); // Set bol untuk EIR Exposure
        $sheet->setCellValue('E8', 'EIR Calculated');
        $sheet->getStyle('E8')->getFont()->setBold(true); // Set bol untuk EIR Calculated



        // Set judul tabel laporan
        $sheet->setCellValue('A10', 'Accrual Interest Report - Report Details');
        $sheet->mergeCells('A10:J10'); // Menggabungkan sel untuk judul tabel
        $sheet->getStyle('A10')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A10')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A10')->getFill()->getStartColor()->setARGB('FF006600'); // Warna latar belakang
        $sheet->getStyle('A10')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        // Set judul kolom tabel
        $headers = ['Bulanke', 'Tgl Angsuran', 'Hari Bunga', 'PMT Amt', 'Penarikan', 'Pengembalian', 'Bunga', 'Balance', 'Time Gap', 'Outs Amt Conv'];
        $columnIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '12', $header);
            $sheet->getStyle($columnIndex . '12')->getFont()->setBold(true);
            $sheet->getStyle($columnIndex . '12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($columnIndex . '12')->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle($columnIndex . '12')->getFill()->getStartColor()->setARGB('FF4F81BD'); // Warna latar belakang header
            $sheet->getStyle($columnIndex . '12')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
            $columnIndex++;
        }

        // Mengisi data laporan ke dalam tabel
        $row = 13; // Mulai dari baris 13 untuk data laporan
        foreach ($reports as $report) {
            $sheet->setCellValue('A' . $row, $report->bulanke);
            $sheet->setCellValue('B' . $row, date('Y-m-d', strtotime($report->tglangsuran)));
            $sheet->setCellValue('C' . $row, $report->haribunga);
            $sheet->setCellValue('D' . $row, number_format($report->pmtamt, 2));
            $sheet->setCellValue('E' . $row, number_format($report->penarikan, 2));
            $sheet->setCellValue('F' . $row, number_format($report->pengembalian, 2));
            $sheet->setCellValue('G' . $row, number_format($report->bunga, 2));
            $sheet->setCellValue('H' . $row, number_format($report->balance, 2));
            $sheet->setCellValue('I' . $row, $report->timegap);
            $sheet->setCellValue('J' . $row, number_format($report->outsamtconv, 2));

            // Mengatur font menjadi bold untuk setiap baris data
            $sheet->getStyle('A' . $row . ':J' . $row)->getFont()->setBold(true);

            // Menambahkan warna latar belakang alternatif pada baris data
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->setFillType(Fill::FILL_SOLID);
                $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->getStartColor()->setARGB('FFEFEFEF'); // Warna latar belakang untuk baris genap
            }

            $row++;
        }

        // Mengatur border untuk tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ];

        // Set border untuk header tabel
        $sheet->getStyle('A12:J12')->applyFromArray($styleArray);

        // Set border untuk semua data laporan
        $sheet->getStyle('A13:J' . ($row - 1))->applyFromArray($styleArray);

        // Mengatur lebar kolom agar lebih rapi
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Siapkan nama file
        $filename = "accrual_interest_report_$no_acc.xlsx";

        // Buat writer dan simpan file Excel
        $writer = new Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), 'phpspreadsheet');
        $writer->save($temp_file);

        // Kembalikan response Excel
        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
    // Method untuk mengekspor data ke PDF
    public function exportPdf($no_acc)
{
    // Ambil data loan dan reports
    $loan = report_simpleinterest::getLoanDetails(trim($no_acc));
    $reports = report_simpleinterest::getReportsByNoAcc(trim($no_acc));

    // Cek apakah data loan dan reports ada
    if (!$loan || $reports->isEmpty()) {
        return response()->json(['message' => 'No data found for the given account number.'], 404);
    }

    // Buat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set informasi pinjaman
    $sheet->setCellValue('A3', 'Number Account');
    $sheet->getStyle('A3')->getFont()->setBold(true);
    $sheet->setCellValue('B3', $loan->no_acc);
    $sheet->setCellValue('A4', 'Debitor Name');
    $sheet->getStyle('A4')->getFont()->setBold(true);
    $sheet->setCellValue('B4', $loan->deb_name);
    $sheet->setCellValue('A5', 'Original Amount');
    $sheet->getStyle('A5')->getFont()->setBold(true);
    $sheet->setCellValue('B5', number_format($loan->org_bal, 2));
    $sheet->setCellValue('A6', 'Original Loan Date');
    $sheet->getStyle('A6')->getFont()->setBold(true);
    $sheet->setCellValue('B6', date('Y-m-d', strtotime($loan->org_date)));
    $sheet->setCellValue('A7', 'Term');
    $sheet->getStyle('A7')->getFont()->setBold(true);
    $sheet->setCellValue('B7', $loan->TERM);
    $sheet->setCellValue('A8', 'Maturity Loan Date');
    $sheet->getStyle('A8')->getFont()->setBold(true);
    $sheet->setCellValue('B8', date('Y-m-d', strtotime($loan->mtr_date)));
    $sheet->setCellValue('B8', 'Interest Rate');
    $sheet->getStyle('B8')->getFont()->setBold(true);
    $sheet->setCellValue('E3', 'Outstanding Interest');
    $sheet->getStyle('E3')->getFont()->setBold(true);
    $sheet->setCellValue('E4', 'Up Front Fee');
    $sheet->getStyle('E4')->getFont()->setBold(true);
    $sheet->setCellValue('E5', 'Transaction Cost');
    $sheet->getStyle('E5')->getFont()->setBold(true);
    $sheet->setCellValue('E6', 'Carrying Amount');
    $sheet->getStyle('E6')->getFont()->setBold(true);
    $sheet->setCellValue('E7', 'EIR Exposure');
    $sheet->getStyle('E7')->getFont()->setBold(true);
    $sheet->setCellValue('E8', 'EIR Calculated');
    $sheet->getStyle('E8')->getFont()->setBold(true);




    // Set judul tabel laporan
    $sheet->setCellValue('A10', 'Accrual Interest Report - Report Details');
    $sheet->mergeCells('A10:J10'); // Menggabungkan sel untuk judul tabel
    $sheet->getStyle('A10')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A10')->getFill()->setFillType(Fill::FILL_SOLID);
    $sheet->getStyle('A10')->getFill()->getStartColor()->setARGB('FF006600'); // Warna latar belakang
    $sheet->getStyle('A10')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

    // Set judul kolom tabel
    $headers = ['Bulanke', 'Tgl Angsuran', 'Hari Bunga', 'PMT Amt', 'Penarikan', 'Pengembalian', 'Bunga', 'Balance', 'Time Gap', 'Outs Amt Conv'];
    $columnIndex = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($columnIndex . '12', $header);
        $sheet->getStyle($columnIndex . '12')->getFont()->setBold(true);
        $sheet->getStyle($columnIndex . '12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($columnIndex . '12')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle($columnIndex . '12')->getFill()->getStartColor()->setARGB('FF4F81BD'); // Warna latar belakang header
        $sheet->getStyle($columnIndex . '12')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
        $columnIndex++;
    }

    // Mengisi data laporan ke dalam tabel
    $row = 13; // Mulai dari baris 13 untuk data laporan
    foreach ($reports as $report) {
        $sheet->setCellValue('A' . $row, $report->bulanke);
        $sheet->setCellValue('B' . $row, date('Y-m-d', strtotime($report->tglangsuran)));
        $sheet->setCellValue('C' . $row, $report->haribunga);
        $sheet->setCellValue('D' . $row, number_format($report->pmtamt, 2));
        $sheet->setCellValue('E' . $row, number_format($report->penarikan, 2));
        $sheet->setCellValue('F' . $row, number_format($report->pengembalian, 2));
        $sheet->setCellValue('G' . $row, number_format($report->bunga, 2));
        $sheet->setCellValue('H' . $row, number_format($report->balance, 2));
        $sheet->setCellValue('I' . $row, $report->timegap);
        $sheet->setCellValue('J' . $row, number_format($report->outsamtconv, 2));

        // Mengatur font menjadi bold untuk setiap baris data
        $sheet->getStyle('A' . $row . ':J' . $row)->getFont()->setBold(true);

        // Menambahkan warna latar belakang alternatif pada baris data
        if ($row % 2 == 0) {
            $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->getStartColor()->setARGB('FFEFEFEF'); // Warna latar belakang untuk baris genap
        }

        $row++;
    }

    // Mengatur border untuk tabel
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => Color::COLOR_BLACK],
            ],
        ],
    ];

    // Set border untuk header tabel
    $sheet->getStyle('A12:J12')->applyFromArray($styleArray);

    // Set border untuk semua data laporan
    $sheet->getStyle('A13:J' . ($row - 1))->applyFromArray($styleArray);

    // Mengatur lebar kolom agar lebih rapi
    foreach (range('A', 'J') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Siapkan nama file
    $filename = "accrual_interest_report_$no_acc.pdf";

    // Set pengaturan untuk PDF
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);

    // Siapkan direktori untuk menyimpan file sementara
    $temp_file = tempnam(sys_get_temp_dir(), 'phpspreadsheet_pdf');

    // Simpan file PDF
    $writer->save($temp_file);

    // Kembalikan response PDF
    return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
}
}
