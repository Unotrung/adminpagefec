<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBnplsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bnpls', function (Blueprint $table) {
            $table->id();
            $table->string(column:'ncustomer');
            $table->string(column:'phnumber');
            $table->string(column:'image');
            $table->text(column:'nidcustomer');
            $table->string(column:'nidimage');
            $table->text(column:'Gender');
            $table->string(column:'Pincode');
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
        Schema::dropIfExists('bnpls');
    }
}
