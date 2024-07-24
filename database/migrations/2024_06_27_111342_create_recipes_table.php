<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Fluent;

return new class extends Migration
{

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->index();
            $table->text('description');
            $table->decimal('prep_time'); //minutes
            $table->decimal('cook_time'); //minutes
            $table->integer('servings');
            $table->decimal('calories')->nullable();
            $table->decimal('protein')->nullable(); //grams
            $table->decimal('carbs')->nullable(); //grams
            $table->string('image')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->index(['created_at']);
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->string('name');
            $table->decimal('quantity');
            $table->string('unit');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unique(['recipe_id', 'name']);
            $table->index(['recipe_id', 'name']);
            $table->timestamps();
        });

        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->integer('step_number');
            $table->text('description');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unique(['recipe_id', 'step_number']);
            $table->index(['recipe_id', 'description']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['recipe_id']);
        });
        Schema::table('instructions', function (Blueprint $table) {
            $table->dropForeign(['recipe_id']);
        });
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('instructions');
        Schema::dropIfExists('recipes');
    }
};
