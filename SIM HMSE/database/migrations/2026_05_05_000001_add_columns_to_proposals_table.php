<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Core fields
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('title')->nullable()->after('user_id');
            $table->string('proker')->nullable()->after('title');
            $table->string('divisi')->nullable()->after('proker');
            $table->string('status')->default('draft')->after('divisi'); // draft, pending, reviewing, approved, rejected
            $table->string('ketua_panitia')->nullable()->after('status');
            $table->string('sekretaris')->nullable()->after('ketua_panitia');

            // Proposal body fields
            $table->text('background')->nullable()->after('sekretaris');
            $table->text('objective')->nullable()->after('background');
            $table->text('tema_kegiatan')->nullable()->after('objective');
            $table->text('jenis_kegiatan')->nullable()->after('tema_kegiatan');
            $table->text('manfaat_kegiatan')->nullable()->after('jenis_kegiatan');
            $table->text('bentuk_kegiatan')->nullable()->after('manfaat_kegiatan');
            $table->text('sasaran_peserta')->nullable()->after('bentuk_kegiatan');

            // Schedule
            $table->string('tanggal_pelaksanaan')->nullable()->after('sasaran_peserta');
            $table->string('waktu_pelaksanaan')->nullable()->after('tanggal_pelaksanaan');
            $table->string('tempat_pelaksanaan')->nullable()->after('waktu_pelaksanaan');
            $table->string('timeline')->nullable()->after('tempat_pelaksanaan');

            // Budget & risk
            $table->decimal('budget', 15, 2)->nullable()->after('timeline');
            $table->string('risk_level')->default('low')->after('budget'); // low, high
            $table->text('risk_description')->nullable()->after('risk_level');

            // Closing
            $table->text('penutup')->nullable()->after('risk_description');
            $table->string('file_path')->nullable()->after('penutup');
            $table->text('rejection_reason')->nullable()->after('file_path');
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'user_id', 'title', 'proker', 'divisi', 'status', 'ketua_panitia', 'sekretaris',
                'background', 'objective', 'tema_kegiatan', 'jenis_kegiatan', 'manfaat_kegiatan',
                'bentuk_kegiatan', 'sasaran_peserta', 'tanggal_pelaksanaan', 'waktu_pelaksanaan',
                'tempat_pelaksanaan', 'timeline', 'budget', 'risk_level', 'risk_description',
                'penutup', 'file_path', 'rejection_reason', 'deleted_at',
            ]);
        });
    }
};
