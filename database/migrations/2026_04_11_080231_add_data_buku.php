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
        Schema::table('buku', function (Blueprint $table) {
                $table->insert([
                    [
                        'id_buku' => 1,
                        'judul' => 'The Great Gatsby',
                        'pengarang' => 'F. Scott Fitzgerald',
                        'penerbit' => 'Scribner',
                        'tahun_terbit' => 1925,
                        'stok' => 5,
                    ],
                    [
                        'id_buku' => 2,
                        'judul' => 'To Kill a Mockingbird',
                        'pengarang' => 'Harper Lee',
                        'penerbit' => 'J.B. Lippincott & Co.',
                        'tahun_terbit' => 1960,
                        'stok' => 3,
                    ],
                    [
                        'id_buku' => 3,
                        'judul' => '1984',
                        'pengarang' => 'George Orwell',
                        'penerbit' => 'Secker & Warburg',
                        'tahun_terbit' => 1949,
                        'stok' => 4,
                    ],
                ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            //
        });
    }
};
