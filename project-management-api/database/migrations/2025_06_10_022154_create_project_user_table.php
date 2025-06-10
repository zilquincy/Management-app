<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys untuk pivot table
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            
            // Role user dalam project ini (manager, member, viewer)
            $table->enum('role', ['manager', 'member', 'viewer'])->default('member');
            
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Pastikan kombinasi project_id + user_id unik
            $table->unique(['project_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_user');
    }
};