<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            
            // Profil Basic
            $table->string('phone_number')->nullable();
            $table->foreignId('major_id')->nullable()->constrained('majors')->nullOnDelete();
            
            $table->integer('batch')->nullable();
            $table->integer('semester')->default(1);
            $table->date('date_of_birth')->nullable();
            $table->string('photo_url')->nullable();
            
            // Profil Karir
            $table->string('gpa', 10)->nullable();
            $table->string('interest')->nullable();
            $table->text('wishlist')->nullable();
            
            // Dokumen
            $table->string('saved_cv_name')->nullable();
            $table->string('saved_portfolio_name')->nullable();
            
            // Settings
            $table->boolean('notify_job_alerts')->default(true);
            $table->boolean('notify_app_status')->default(true);
            $table->boolean('notify_news')->default(false);
            $table->boolean('is_visible_to_recruiters')->default(true);
            
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('users'); }
};
