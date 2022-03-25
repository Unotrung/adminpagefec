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
        Schema::create('bnpl_personals', function (Blueprint $table) {
            $table->id();
            $table->string(column:'name');
            $table->string(column:'sex');
            $table->date(column:'birthday');
            $table->string(column:'phone');
            $table->string(column:'citizenId');
            $table->date(column:'issueDate');
            $table->string(column:'city');
            $table->date(column:'district');
            $table->date(column:'ward');
            $table->date(column:'street');
            $table->string(column:'personal_title_ref');
            $table->string(column:'name_ref');
            $table->string(column:'phone_ref');
            $table->string(column:'user');
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
        Schema::dropIfExists('bnpl_personals');
    }
}
