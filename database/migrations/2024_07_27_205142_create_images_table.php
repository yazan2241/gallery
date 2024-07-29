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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('image_gray')->nullable();
            $table->bigInteger('attribute_id')->unsigned()->index()->nullable();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images' , function(Blueprint $table){
            $table->dropForeignKey('images_attribute_id_foreign','images');
            $table->dropIndex('images_attribute_id_index', 'images');
        });
        Schema::dropIfExists('images');
    }
};
