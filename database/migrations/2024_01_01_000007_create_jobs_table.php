<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('title');
            $table->string('location');
            $table->string('type');
            $table->string('salary_range');
            $table->text('description');

            // JSON Columns
            $table->json('category_ids')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('benefits')->nullable();

            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('jobs'); }
};
