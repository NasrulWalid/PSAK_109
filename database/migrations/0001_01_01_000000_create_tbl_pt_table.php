<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pt', function (Blueprint $table) {
            $table->string('id_pt')->primary(); // Primary key 'id_pt' sebagai string
            $table->string('nama_pt')->unique(); // Nama PT sebagai string dan harus unik
            $table->string('alamat'); // Alamat sebagai string

            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pt'); // Menghapus tabel
    }
}
