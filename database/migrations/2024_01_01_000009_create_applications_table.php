<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            $table->string('status', 50)->default('In Review');
            $table->dateTime('applied_date');
            
            $table->string('cv_file_name');
            $table->string('portfolio_file_name')->nullable();
            $table->string('cover_letter_file_name')->nullable();
            
            $table->json('timeline')->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('applications'); }
};
