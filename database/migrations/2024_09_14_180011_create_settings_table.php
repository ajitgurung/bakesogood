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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_email')->nullable(); 
            $table->string('reservation_email')->nullable();
            $table->string('sales_email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('other_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile_whatsapp')->nullable();
            $table->string('fax')->nullable();
            $table->string('address')->nullable();
            $table->text('site_keyword')->nullable();
            $table->integer('advance_amount')->nullable();
            $table->text('google_map_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
