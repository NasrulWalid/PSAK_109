<?php

namespace App\Http\Controllers\upload\effective;

use App\Http\Controllers\Controller;
use App\Models\UploadEffective;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class TblmasterController extends Controller
{
    protected $uploadEffective;

    public function __construct(UploadEffective $uploadEffective)
    {
        $this->uploadEffective = $uploadEffective;
    }

    public function index(Request $request)
{
    $id_pt = Auth::user()->id_pt; // Dapatkan id_pt dari pengguna yang login
    // Ambil jumlah item per halaman dari query string, default 10
    $perPage = $request->input('per_page', 5);

     // Ambil data dengan pagination dan filter berdasarkan id_pt
     $tblmaster = $this->uploadEffective
     ->where('id_pt', $id_pt)
     ->paginate($perPage);

    return view('upload.effective.layouts.appmaster', [
        'title' => 'Laravel - PHPSpreadsheet',
        'tblmaster' => $tblmaster // Pastikan ini adalah objek paginator
    ]);
}

    protected function validateData($row)
    {
        return !empty($row['no_acc']) &&
               !empty($row['no_branch']) &&
               !empty($row['deb_name']) &&
               !empty($row['status']) &&
               !empty($row['ln_type']);
    }

    protected function formatData($row)
{
    try {
        // Hapus spasi dari nilai numerik dan ganti koma dengan titik
        $cleanRow = array_map(function($value) {
            if (is_string($value)) {
                return trim(str_replace([',', ' '], ['', ''], $value));
            }
            return $value;
        }, $row);

        return [
            'no_acc' => (float)$cleanRow[1], // Sesuaikan index karena kolom pertama null
            'no_branch' => (float)$cleanRow[2],
            'deb_name' => (string)$cleanRow[3],
            'status' => (string)$cleanRow[4],
            'ln_type' => (string)$cleanRow[5],
            'org_date' => (float)$cleanRow[6],
            'org_date_dt' => !empty($cleanRow[7]) ? date('Y-m-d H:i:s', strtotime($cleanRow[7])) : null,
            'term' => (float)$cleanRow[8],
            'mtr_date' => (float)$cleanRow[9],
            'mtr_date_dt' => !empty($cleanRow[10]) ? date('Y-m-d H:i:s', strtotime($cleanRow[10])) : null,
            'org_bal' => (float)$cleanRow[11],
            'rate' => (float)$cleanRow[12],
            'cbal' => (float)$cleanRow[13],
            'prebal' => (float)$cleanRow[14],
            'bilprn' => (float)$cleanRow[15],
            'pmtamt' => (float)$cleanRow[16],
            'lrebd' => (float)$cleanRow[17],
            'lrebd_dt' => !empty($cleanRow[18]) ? date('Y-m-d H:i:s', strtotime($cleanRow[18])) : null,
            'nrebd' => (float)$cleanRow[19],
            'nrebd_dt' => !empty($cleanRow[20]) ? date('Y-m-d H:i:s', strtotime($cleanRow[20])) : null,
            'ln_grp' => (float)$cleanRow[21],
            'GROUP' => (string)$cleanRow[22],
            'bilint' => (float)$cleanRow[23],
            'bisifa' => (float)$cleanRow[24],
            'birest' => (string)$cleanRow[25],
            'freldt' => (float)$cleanRow[26],
            'freldt_dt' => !empty($cleanRow[27]) && $cleanRow[27] != '1900-01-01' ? date('Y-m-d H:i:s', strtotime($cleanRow[27])) : null,
            'resdt' => (float)$cleanRow[28],
            'resdt_dt' => !empty($cleanRow[29]) && $cleanRow[29] != '1900-01-01' ? date('Y-m-d H:i:s', strtotime($cleanRow[29])) : null,
            'restdt' => (float)$cleanRow[30],
            'restdt_dt' => !empty($cleanRow[31]) && $cleanRow[31] != '1900-01-01' ? date('Y-m-d H:i:s', strtotime($cleanRow[31])) : null,
            'prov' => (float)$cleanRow[32],
            'trxcost' => (float)$cleanRow[33],
            'gol' => (int)$cleanRow[34]
        ];
    } catch (\Exception $e) {
        Log::error('Data formatting error: ' . $e->getMessage());
        Log::error('Row data: ' . json_encode($row));
        return null;
    }
}


public function importExcel(Request $request)
{
    try {
        $request->validate([
            'uploadFile' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('uploadFile');
        $reader = $file->getClientOriginalExtension() === 'csv' ? new Csv() : new Xlsx();

        $spreadsheet = $reader->load($file->getRealPath());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        Log::info('Total rows read: ' . count($rows));

        $validData = [];
        $duplicates = [];
        $invalidData = [];
        $existingRecords = [];

        // Skip header row
        array_shift($rows);

        foreach ($rows as $row) {
            Log::info('Processing row: ', $row);
            $formattedData = $this->formatData($row);
            Log::info('Formatted data: ', $formattedData ? $formattedData : ['null']);

            if (!$formattedData || !$this->validateData($formattedData)) {
                $invalidData[] = $row;
                Log::warning('Invalid data found');
                continue;
            }

            // Check for existing records with the same no_acc, org_date, and mtr_date
            if ($this->uploadEffective->where('no_acc', $formattedData['no_acc'])
                ->where('org_date', $formattedData['org_date'])
                ->where('mtr_date', $formattedData['mtr_date'])
                ->exists()) {
                $existingRecords[] = $formattedData;
                continue;
            }

            if ($this->uploadEffective->isDuplicate($formattedData['no_acc'])) {
                $duplicates[] = $formattedData;
                Log::warning('Duplicate data found');
                continue;
            }

            $validData[] = $formattedData;
        }

        Log::info('Valid data count: ' . count($validData));

        if (!empty($validData)) {
            Log::info('Attempting to insert data');
            $this->uploadEffective->insertBatch($validData);
        }

        // Generate messages
        $importResult = $this->generateImportMessage(
            count($validData),
            count($duplicates),
            count($invalidData),
            count($existingRecords)
        );

        if ($importResult['success']) {
            return redirect()->back()->with('status', $importResult['message']);
        } else {
            return redirect()->back()->with('error', $importResult['message']);
        }

    } catch (\Exception $e) {
        Log::error('Import error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
    }
}

protected function generateImportMessage($valid, $duplicates, $invalid, $existing)
{
    $messages = [];
    $hasSuccess = $valid > 0; // Menandai apakah ada catatan yang berhasil diimpor

    if ($valid > 0) {
        $messages[] = "$valid catatan berhasil diimpor";
    }
    if ($duplicates > 0) {
        $messages[] = "$duplicates catatan duplikat ";
    }
    if ($invalid > 0) {
        $messages[] = "$invalid catatan tidak valid ";
    }
    if ($existing > 0) {
        $messages[] = "$existing catatan sudah ada ";
    }

    // Kembalikan array dengan pesan dan status sukses
    return [
        'success' => $hasSuccess,
        'message' => empty($messages) ? 'Tidak ada catatan yang diimpor' : implode(', ', $messages),
    ];
}


public function executeStoredProcedure(Request $request)
{
    $request->validate([
        'bulan' => 'required|integer',
        'tahun' => 'required|integer',
        'no_acc' => 'required|string'
    ]);

    // Ambil input
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $no_acc = $request->no_acc;

    try {
        // Eksekusi fungsi dengan SELECT
        $result = DB::select('SELECT public.ndcalculateeffectivetrigger(?, ?, ?)', [$bulan, $tahun, $no_acc]);
        Log::info('Fungsi berhasil dieksekusi', ['bulan' => $bulan, 'tahun' => $tahun, 'no_acc' => $no_acc]);

        return redirect()->back()->with('status', 'Fungsi berhasil dieksekusi untuk Nomor Akun: ' . $no_acc);
    } catch (QueryException $e) {
        Log::error('Kesalahan saat mengeksekusi fungsi', ['error' => $e->getMessage()]);
        // Memeriksa apakah kesalahan berkaitan dengan no_acc tidak ditemukan
        if (strpos($e->getMessage(), 'no_acc') !== false) {
            return redirect()->back()->with('error', "Nomor rekening {$no_acc} tidak ditemukan untuk bulan {$bulan} dan tahun {$tahun}.");
        }

        // Mengembalikan kesalahan lainnya
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengeksekusi fungsi: ' . $e->getMessage());
    }
}
}
