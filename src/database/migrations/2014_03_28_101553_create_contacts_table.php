<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('locale')->nullable();
            $table->string('name')->nullable();
            $table->string('email');
            // $table->string('website')->nullable();
            // $table->string('company')->nullable();
            // $table->string('address')->nullable();
            // $table->string('postcode')->nullable();
            // $table->string('city')->nullable();
            // $table->string('country')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('mobile')->nullable();
            // $table->string('fax')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('contacts');
    }
}
