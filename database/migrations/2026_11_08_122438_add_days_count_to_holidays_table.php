<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('holidays', function (Blueprint $table) {
            // إضافة حقل عدد الأيام بقيمة افتراضية 1
            $table->integer('days_count')->default(1)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->dropColumn('days_count');
        });
    }
};
