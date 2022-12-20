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
        Schema::create('become_partners', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('partnership_type')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('no_of_vehicles')->nullable();
            $table->string('nin')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('cac_number')->nullable();
            $table->string('agreement')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('become_partners');
    }
};
