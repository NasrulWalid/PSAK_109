<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key 'id' dengan auto-increment
            $table->string('name'); // Nama pengguna
            $table->string('id_pt'); // Menambahkan kolom untuk foreign key
            $table->string('nomor_wa'); // Nomor WhatsApp
            $table->string('email')->unique(); // Email yang unik
            $table->string('role')->default('admin');// Tipe pengguna, default 'user'
            $table->timestamp('email_verified_at')->nullable(); // Timestamp untuk verifikasi email
            $table->string('password'); // Password
            $table->rememberToken(); // Token untuk mengingat pengguna
            $table->timestamps(); // Menambahkan created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('id_pt')->references('id_pt')->on('tbl_pt')->onDelete('cascade');
        });

        // Membuat tabel password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key untuk email
            $table->string('token'); // Token untuk reset password
            $table->timestamp('created_at')->nullable(); // Waktu saat token dibuat
        });

        // Membuat tabel sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key untuk session id
            $table->foreignId('user_id')->nullable()->index(); // Foreign key ke tabel users
            $table->string('ip_address', 45)->nullable(); // Alamat IP
            $table->text('user_agent')->nullable(); // User agent
            $table->longText('payload'); // Payload session
            $table->integer('last_activity')->index(); // Timestamp terakhir aktivitas

            // Menambahkan foreign key constraint untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus foreign key sebelum menghapus tabel
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Menghapus foreign key
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_pt']); // Menghapus foreign key
        });

        // Menghapus tabel
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
