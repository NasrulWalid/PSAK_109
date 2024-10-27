<?php

namespace App\Http\Controllers\upload\simple_interest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UploadSimpleInterest; // Ensure this model is created
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class tblmasterController extends Controller
{
    protected $homeModel;

    public function __construct(UploadSimpleInterest $homeModel)
    {
        $this->homeModel = $homeModel;
    }

    public function index()
    {
        $data['title'] = 'Laravel - PHPSpreadsheet';
        $data['tblmaster'] = $this->homeModel->fetchTblmaster();

        return view('upload.simple_interest.layouts.appmaster', $data);
    }

    public function validateData($data)
    {
        // Kolom yang wajib diisi
        $required_fields = [
            'no_acc', 'no_branch', 'deb_name', 'status', 'ln_type',
            'org_date', 'term', 'mtr_date', 'org_bal', 'rate', 'cbal',
            'prebal', 'bilprn', 'pmtamt', 'lrebd', 'nrebd', 'ln_grp',
            'group', 'bilint', 'bisifa', 'birest', 'frel_dt', 'res_dt',
            'rest_dt', 'prov', 'trxcost', 'gol'
        ];

        // Memeriksa apakah kolom wajib diisi tidak kosong
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                return false; // Data tidak valid jika kolom wajib kosong
            }
        }
        return true; // Data valid
    }

    public function importExcel(Request $request)
{
    $request->validate([
        'uploadFile' => 'required|file|mimes:xlsx,csv',
    ]);

    $file = $request->file('uploadFile');
    $extension = $file->getClientOriginalExtension();

    if ($extension === 'csv') {
        $reader = new Csv();
    } else {
        $reader = new Xlsx();
    }

    $spreadsheet = $reader->load($file->getRealPath());
    $sheet_data = $spreadsheet->getActiveSheet()->toArray();
    $array_data = [];
    $duplicate_data = []; // Menyimpan data duplikat
    $invalid_data = []; // Menyimpan data tidak valid

    for ($i = 1; $i < count($sheet_data); $i++) {
        $data = [
            'no_acc'       => $sheet_data[$i][0],
            'no_branch'    => (int)$sheet_data[$i][1], // pastikan numeric
            'deb_name'     => $sheet_data[$i][2],
            'status'       => $sheet_data[$i][3],
            'ln_type'      => $sheet_data[$i][4],
            'org_date'     => (int)$sheet_data[$i][5], // pastikan numeric
            'org_date_dt'  => $sheet_data[$i][6],
            'term'         => (int)$sheet_data[$i][7], // pastikan numeric
            'mtr_date'     => (int)$sheet_data[$i][8], // pastikan numeric
            'mtr_date_dt'  => $sheet_data[$i][9],
            'org_bal'      => (float)$sheet_data[$i][10], // pastikan float
            'rate'         => (float)$sheet_data[$i][11], // pastikan float
            'cbal'         => (float)$sheet_data[$i][12], // pastikan float
            'prebal'       => (float)$sheet_data[$i][13], // pastikan float
            'bilprn'       => (float)$sheet_data[$i][14], // pastikan float
            'pmtamt'       => (float)$sheet_data[$i][15], // pastikan float
            'lrebd'        => (int)$sheet_data[$i][16], // pastikan numeric
            'lrebd_dt'     => $sheet_data[$i][17],
            'nrebd'        => (int)$sheet_data[$i][18], // pastikan numeric
            'nrebd_dt'     => $sheet_data[$i][19],
            'ln_grp'       => (int)$sheet_data[$i][20], // pastikan numeric
            'group'        => $sheet_data[$i][21],
            'bilint'       => (float)$sheet_data[$i][22], // pastikan float
            'bisifa'       => (int)$sheet_data[$i][23], // pastikan numeric
            'birest'       => $sheet_data[$i][24],
            'frel_dt'      => (int)$sheet_data[$i][25], // pastikan numeric
            'frel_dt_dt'   => $sheet_data[$i][26],
            'res_dt'       => (int)$sheet_data[$i][27], // pastikan numeric
            'res_dt_dt'    => $sheet_data[$i][28],
            'rest_dt'      => (int)$sheet_data[$i][29], // pastikan numeric
            'rest_dt_dt'   => $sheet_data[$i][30],
            'prov'         => (float)$sheet_data[$i][31], // pastikan float
            'trxcost'      => (float)$sheet_data[$i][32], // pastikan float
            'gol'          => (int)$sheet_data[$i][33] // pastikan integer
        ];

        // Validasi struktur data
        $is_valid = $this->validateData($data);

        if (!$is_valid) {
            $invalid_data[] = $data;
            continue; // Lewati data ini
        }

        // Cek apakah data sudah ada di database
        $existing_data = $this->homeModel->checkDuplicateTblmaster($data['no_acc']);
        if ($existing_data) {
            $duplicate_data[] = $data; // Simpan data duplikat
            continue; // Lewati data ini
        }

        $array_data[] = $data;
    }

    // Masukkan data yang tidak duplikat
    if (!empty($array_data)) {
        $this->homeModel->insertTransactionBatch($array_data);
    }

    // Tampilkan umpan balik
    if (!empty($duplicate_data)) {
        return redirect()->back()->with('warning', 'Some data was not imported due to duplicates.');
    } else {
        return redirect()->back()->with('success', 'Data Imported Successfully');
    }
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
