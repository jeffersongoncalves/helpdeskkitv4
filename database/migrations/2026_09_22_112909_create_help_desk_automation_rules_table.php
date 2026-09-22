<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\HelpDesk\Database\HelpDeskMigration;

return new class extends HelpDeskMigration
{
    public function up(): void
    {
        Schema::create('help_desk_automation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('department_id')->nullable()->constrained('help_desk_departments')->nullOnDelete();
            $table->json('conditions');
            $table->json('actions');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('last_run_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('help_desk_automation_rules');
    }
};
