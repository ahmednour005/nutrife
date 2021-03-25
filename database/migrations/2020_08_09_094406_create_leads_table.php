<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Address');
            $table->string('Phone');
            $table->string('Date')->nullable();
            $table->string('Lead_Category')->nullable();
            $table->string('Status')->nullable();
            $table->string('Traceability')->nullable();
            $table->string('Number_Of_Packages')->nullable();
            $table->string('Total_Price')->nullable();
            $table->string('Shipping')->nullable();
            $table->string('Employee_Name')->nullable();
            $table->string('Height')->nullable();
            $table->string('Weight')->nullable();
            $table->string('Age')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
