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
        Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('favicon')->nullable();
                $table->string('logo')->nullable();
                $table->string('site_preview_image')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->text('address')->nullable();
                $table->text('short_description')->nullable();
                $table->string('site_link')->nullable();
                $table->string('facebook_link')->nullable();
                $table->string('twitter_link')->nullable();
                $table->string('linkedin_link')->nullable();
                $table->string('instagram_link')->nullable();
                $table->string('youtube_link')->nullable();
                $table->string('team_banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
