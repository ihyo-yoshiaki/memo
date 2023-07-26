<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formats', function (Blueprint $table) {
		$table->id();
		$table->foreignId('theme_id')->constrained()->onDelete('cascade');
		$table->foreignId('item_id')->constrained()->onDelete('cascade');
		$table->string('name', 50);
		$table->unsignedInteger('order');
		$table->timestamps();
		$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formats');
    }
};
