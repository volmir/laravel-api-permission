<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');            
            $table->timestamps();
        });
        
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('permission_id')->nullable(false);
            $table->foreign('permission_id')->references('id')->on('permissions');  
            $table->unique(['user_id', 'permission_id']);          
            $table->timestamps();
        });
        
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedBigInteger('permission_id')->nullable(false);
            $table->foreign('permission_id')->references('id')->on('permissions');  
            $table->unique(['role_id', 'permission_id']);          
            $table->timestamps();
        }); 
        
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->foreign('role_id')->references('id')->on('roles'); 
            $table->unique(['user_id', 'role_id']);           
            $table->timestamps();
        });         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['permission_id']);
        });
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('user_permissions', function (Blueprint $table) {
            $table->dropUnique(['user_id_permission_id']);
        });
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropUnique(['role_id_permission_id']);
        });        
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropUnique(['user_id_role_id']);
        });          

        Schema::dropIfExists('user_permissions');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');        
    }
};
