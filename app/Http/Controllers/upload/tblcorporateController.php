<?php

namespace App\Http\Controllers\upload;

use App\Models\Upload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class tblcorporateController extends Controller
{
    protected $homeModel;

    public function __construct(Upload $homeModel)
    {
        $this->homeModel = $homeModel;
    }

    public function index()
    {
        $data['title'] = 'Laravel 11 - PHPSpreadsheet';
        $data['tblcorporateloancabangdetail'] = $this->homeModel->fetchTblCorporateLoanCabangDetail();
        return view('upload.layouts.appcorporate', $data);
        dd($data);
    }

    public function validateData($data)
    {
        $requiredFields = [
            'idtrx', 'id_ktr_cabang', 'cif_bank', 'no_rekening', 'status',
            'nama_debitur', 'maksimal_kredit', 'tanggal_realisasi', 'suku_bunga',
            'jangka_waktu', 'tgl_jatuh_tempo', 'sifat_kredit', 'jenis_kredit',
            'jns_transaksi', 'tgl_transaksi', 'nilai_penarikan', 'nilai_pengembalian',
            'cbal', 'cutoff_date', 'kelonggaran_tarik', 'tgl_restruct',
            'tgl_restruct_review', 'ket_restruct', 'nominal_angsuran', 'status_psak'
        ];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }

    public function importExcel(Request $request)
{
    $file = $request->file('uploadFile');

    $fileMimes = [
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/csv'
    ];

    if ($file && in_array($file->getMimeType(), $fileMimes)) {
        $extension = $file->getClientOriginalExtension();
        $reader = $extension === 'csv' ? new Csv() : new Xlsx();
        $spreadsheet = $reader->load($file->getRealPath());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $arrayData = []; // Inisialisasi arrayData di awal
        $duplicateData = []; // Store duplicate data
        $invalidData = []; // Store invalid data

        // Loop mulai dari 1 untuk melewati header
        for ($i = 1; $i < count($sheetData); $i++) {
            $data = [
                'idtrx' => $sheetData[$i][0],
                'id_ktr_cabang' => $sheetData[$i][1],
                'cif_bank' => $sheetData[$i][2],
                'no_rekening' => $sheetData[$i][3],
                'status' => $sheetData[$i][4],
                'nama_debitur' => $sheetData[$i][5],
                'maksimal_kredit' => $sheetData[$i][6],
                'tanggal_realisasi' => $sheetData[$i][7],
                'suku_bunga' => $sheetData[$i][8],
                'jangka_waktu' => $sheetData[$i][9],
                'tgl_jatuh_tempo' => $sheetData[$i][10],
                'sifat_kredit' => $sheetData[$i][11],
                'jenis_kredit' => $sheetData[$i][12],
                'jns_transaksi' => $sheetData[$i][13],
                'tgl_transaksi' => $sheetData[$i][14],
                'nilai_penarikan' => $sheetData[$i][15],
                'nilai_pengembalian' => $sheetData[$i][16],
                'cbal' => $sheetData[$i][17],
                'cutoff_date' => $sheetData[$i][18],
                'kelonggaran_tarik' => $sheetData[$i][19],
                'tgl_restruct' => $sheetData[$i][20],
                'tgl_restruct_review' => $sheetData[$i][21],
                'ket_restruct' => $sheetData[$i][22],
                'nominal_angsuran' => $sheetData[$i][23],
                'status_psak' => $sheetData[$i][24]
            ];
            Log::info('Processing Row:', [$i, 'Data:' => $data]);

            // Validate data structure
            if (!$this->validateData($data)) {
                $invalidData[] = $data; // Simpan data yang tidak valid
                Log::info('Invalid Data:', [$data]);
                continue; // Lewati data yang tidak valid
            }

            // Check for duplicate data
            if ($this->homeModel->checkDuplicateTblCorporateLoanCabangDetail($data['idtrx'])) {
                $duplicateData[] = $data; // Simpan data duplikat
                Log::info('Duplicate Data Found:', [$data]);
                continue; // Lewati data duplikat
            }

            $arrayData[] = $data; // Tambahkan data yang valid dan tidak duplikat
        }

        // Debugging: Cek isi arrayData setelah loop
        Log::info('Array Data before insertion:', [$arrayData]);

        // Insert non-duplicate data
        if (!empty($arrayData)) {
            try {
                $inserted = $this->homeModel->insertTransactionBatch($arrayData);
                Log::info('Data inserted:', [$inserted]);
            } catch (\Exception $e) {
                Log::error('Insert failed:', ['error' => $e->getMessage()]);
                return redirect()->back()->with('error', 'Data Import Failed: ' . $e->getMessage());
            }
        }

        // Berikan umpan balik kepada pengguna
        if (!empty($duplicateData)) {
            return redirect()->back()->with('warning', 'Some data was not imported due to duplicates.');
        } elseif (!empty($invalidData)) {
            return redirect()->back()->with('warning', 'Some data were invalid and not imported.');
        } else {
            return redirect()->back()->with('success', 'Data Imported Successfully');
        }
    } else {
        return redirect()->back()->with('error', 'Import failed due to unsupported file type');
    }
}


    public function exportExcel()
    {
        $data = $this->homeModel->fetchTblCorporateLoanCabangDetail();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Excel header
        $headers = [
            'IDTRX', 'ID_KTR_CABANG', 'CIF_BANK', 'NO_REKENING', 'STATUS',
            'NAMA_DEBITUR', 'MAKSIMAL_KREDIT', 'TANGGAL_REALISASI', 'SUKU_BUNGA',
            'JANGKA_WAKTU', 'TGL_JATUH_TEMPO', 'SIFAT_KREDIT', 'JENIS_KREDIT',
            'JNS_TRANSAKSI', 'TGL_TRANSAKSI', 'NILAI_PENARIKAN', 'NILAI_PENGEMBALIAN',
            'CBAL', 'CUTOFF_DATE', 'KELONGGARAN_TARIK', 'TGL_RESTRUCT',
            'TGL_RESTRUCT_REVIEW', 'KET_RESTRUCT', 'NOMINAL_ANGSURAN', 'STATUS_PSAK'
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set Excel data
        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->fromArray(array_values((array)$row), null, 'A' . $rowNumber);
            $rowNumber++;
        }

        // Set response headers for Excel download
        $filename = 'Table-CorporateLoanCabangDetail-report.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        exit;
    }

    public function exportPdf()
    {
        $data = $this->homeModel->fetchTblCorporateLoanCabangDetail();

        // Start HTML content for PDF
        $html = '<h3>Table Corporate Loan Cabang Detail Report</h3>';
        $html .= '<table border="1" width="100%" style="border-collapse: collapse;">';
        $html .= '
            <thead>
                <tr>
                    <th>IDTRX</th>
                    <th>ID_KTR_CABANG</th>
                    <th>CIF_BANK</th>
                    <th>NO_REKENING</th>
                    <th>STATUS</th>
                    <th>NAMA_DEBITUR</th>
                    <th>MAKSIMAL_KREDIT</th>
                    <th>TANGGAL_REALISASI</th>
                    <th>SUKU_BUNGA</th>
                    <th>JANGKA_WAKTU</th>
                    <th>TGL_JATUH_TEMPO</th>
                    <th>SIFAT_KREDIT</th>
                    <th>JENIS_KREDIT</th>
                    <th>JNS_TRANSAKSI</th>
                    <th>TGL_TRANSAKSI</th>
                    <th>NILAI_PENARIKAN</th>
                    <th>NILAI_PENGEMBALIAN</th>
                    <th>CBAL</th>
                    <th>CUTOFF_DATE</th>
                    <th>KELONGGARAN_TARIK</th>
                    <th>TGL_RESTRUCT</th>
                    <th>TGL_RESTRUCT_REVIEW</th>
                    <th>KET_RESTRUCT</th>
                    <th>NOMINAL_ANGSURAN</th>
                    <th>STATUS_PSAK</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($data as $row) {
            $html .= '
                <tr>
                    <td>' . $row->IDTRX . '</td>
                    <td>' . $row->ID_KTR_CABANG . '</td>
                    <td>' . $row->CIF_BANK . '</td>
                    <td>' . $row->NO_REKENING . '</td>
                    <td>' . $row->STATUS . '</td>
                    <td>' . $row->NAMA_DEBITUR . '</td>
                    <td>' . $row->MAKSIMAL_KREDIT . '</td>
                    <td>' . $row->TANGGAL_REALISASI . '</td>
                    <td>' . $row->SUKU_BUNGA . '</td>
                    <td>' . $row->JANGKA_WAKTU . '</td>
                    <td>' . $row->TGL_JATUH_TEMPO . '</td>
                    <td>' . $row->SIFAT_KREDIT . '</td>
                    <td>' . $row->JENIS_KREDIT . '</td>
                    <td>' . $row->JNS_TRANSAKSI . '</td>
                    <td>' . $row->TGL_TRANSAKSI . '</td>
                    <td>' . $row->NILAI_PENARIKAN . '</td>
                    <td>' . $row->NILAI_PENGEMBALIAN . '</td>
                    <td>' . $row->CBAL . '</td>
                    <td>' . $row->CUTOFF_DATE . '</td>
                    <td>' . $row->KELONGGARAN_TARIK . '</td>
                    <td>' . $row->TGL_RESTRUCT . '</td>
                    <td>' . $row->TGL_RESTRUCT_REVIEW . '</td>
                    <td>' . $row->KET_RESTRUCT . '</td>
                    <td>' . $row->NOMINAL_ANGSURAN . '</td>
                    <td>' . $row->STATUS_PSAK . '</td>
                </tr>';
        }

        $html .= '</tbody></table>';

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream("Table-CorporateLoanCabangDetail-report.pdf", ["Attachment" => true]);
        exit;
    }

    public function executeStoredProcedure(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'no_acc' => 'required|string',
            'pilihan' => 'required|integer'
        ]);

        // Ambil input
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $no_acc = $request->no_acc;
        $pilihan = $request->pilihan;

        try {
            // Eksekusi stored procedure
            DB::statement('CALL public.ndcashflowcorporateloan(?, ?, ?, ?)', [$bulan, $tahun, $no_acc, $pilihan]);

            return redirect()->back()->with('success', 'Stored procedure executed successfully.');
        } catch (QueryException $e) {
            // Memeriksa apakah kesalahan berkaitan dengan no_acc tidak ditemukan
            if (strpos($e->getMessage(), 'no_acc') !== false) {
                return redirect()->back()->with('error', "Nomor rekening {$no_acc} tidak ditemukan untuk bulan dan tahun yang ditentukan.");
            }

            // Mengembalikan kesalahan lainnya
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengeksekusi prosedur: ' . $e->getMessage());
        }
    }
}
