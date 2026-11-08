<?php

// database/migrations/2026_11_07_174210_create_leave_manager_core_tables.php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_versions', function (Blueprint $table) {
            $table->id();
            $table->string('platform', 20)->unique()->comment('android or ios');
            $table->string('latest_version', 20);
            $table->string('min_required_version', 20);
            $table->boolean('maintenance_mode')->default(false);
            $table->text('release_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('remote_id')->unique()->comment('Unique device identifier');
            $table->text('fcm_token')->nullable();
            $table->string('os_type', 20)->index();
            $table->string('app_version', 20)->nullable();
            $table->timestamp('last_active_at')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->unsignedInteger('days_count')->default(1);
            $table->timestamps();
        });

        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('type', 30)->index();
            $table->string('status', 30)->default('pending')->index();
            $table->timestamp('scheduled_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_notifications');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('app_versions');
    }
};
