<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('organization_id')->constrained()->onDelete('CASCADE');
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->dateTime('deactivated_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('leader_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
