<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report_simpleinterest extends Model
{
    // Mengganti tabel utama menjadi tblOBALCorporateLoan
    protected $table = 'public.tblobalcorporateloan';

    // Jika primary key bukan 'id', spesifikkan di sini
    protected $primaryKey = 'id';

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;

    // Kolom yang bisa diakses
    protected $fillable = [
        'no_acc', 'deb_name', 'org_bal', 'org_date', 'ln_type', 'mtr_date'
    ];

    // Method untuk mendapatkan semua pinjaman korporat
    public static function getCorporateLoans()
    {
        return self::select('no_acc','no_branch', 'deb_name', 'org_bal', 'org_date','interest','eircalc_conv','eircalc_cost','eircalc','eircalc_fee','eirex', 'ln_type', 'mtr_date');
    }

    // Method untuk mendapatkan detail pinjaman berdasarkan nomor akun
    public static function getLoanDetails($no_acc)
    {
        return self::where('no_acc', $no_acc)->first();
    }

    // Method untuk mendapatkan laporan berdasarkan nomor akun
    // Mengubah dari tabel 'report' ke tabel 'tblCFOBALCorporateLoan'
    public static function getReportsByNoAcc($no_acc)
    {
        return DB::table('public.tblcfobalcorporateloan')
            ->where('no_acc', $no_acc)
            ->get();
    }
}
