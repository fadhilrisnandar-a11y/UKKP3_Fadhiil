
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengaduan', 'judul')) {
                $table->string('judul')->nullable();
            }

            if (!Schema::hasColumn('pengaduan', 'isi')) {
                $table->text('isi')->nullable();
            }

            if (!Schema::hasColumn('pengaduan', 'tanggal_pengaduan')) {
                $table->date('tanggal_pengaduan')->nullable();
            }

            if (!Schema::hasColumn('pengaduan', 'status')) {
                $table->string('status')->default('menunggu');
            }

            if (!Schema::hasColumn('pengaduan', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $columns = [
                'judul',
                'isi',
                'tanggal_pengaduan',
                'status',
                'foto',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('pengaduan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
