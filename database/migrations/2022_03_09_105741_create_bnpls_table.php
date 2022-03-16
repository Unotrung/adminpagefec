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
            $table->string(column:'nidcustomer');
            $table->string(column:'nidimage');
            $table->text(column:'Gender');
            $table->string(column:'Pincode');
            $table->date(column:'DOB');
            $table->date(column:'DON');
            $table->date(column:'DRegis');
            $table->string(column:'Address');
            $table->string(column:'Code');
            $table->string(column:'CodeName');
            $table->string(column:'DivisionType');
            $table->string(column:'District');
            $table->string(column:'TypeRelation');
            $table->string(column:'PhoneRelation');
            $table->string(column:'NameRelation');
            $table->string(column:'District');
            $table->string(column:'Contract');

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
