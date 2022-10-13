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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('due_date');
            $table->text('description');
            $table->foreignId('priority_id');
            $table->foreignId('state_id');
            //$table->enum('priority', ['low', 'medium', 'high']);
            //$table->enum('state', ['reported', 'assigned', 'in_progress', 'testable', 'done']);
            $table->foreignId('assigned_to')->nullable();
            $table->foreignId('created_by');
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
        Schema::dropIfExists('tasks');
    }
};
