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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('poster_id')->unsigned();
            $table->text('image');
            $table->string('title');
            $table->bigInteger('category_id')->unsigned();
            $table->string('location');
            $table->float('price');
            $table->text('description');
            $table->boolean('is_on_whatsapp')->default(false);
            $table->boolean('is_on_telegram')->default(false);
            $table->boolean('is_on_imo')->default(false);
            $table->boolean('is_on_viber')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_fake')->default(false);
            $table->boolean('ad_type')->default(1);
            $table->integer('total_likes')->default(0);
            $table->integer('total_views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
