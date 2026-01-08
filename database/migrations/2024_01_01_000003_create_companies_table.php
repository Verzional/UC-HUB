<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->string('industry')->default('Technology')->nullable();
            $table->string('location_headquarters')->default('Jakarta, Indonesia')->nullable();
            $table->text('description')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('companies'); }
};
