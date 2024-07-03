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
        DB::connection()->setSchemaGrammar(new class extends PostgresGrammar
        {
            protected function typeText_array(Fluent $column)
            {
                return 'text[]';
            }
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->integer('prep_time'); //minutes
            $table->integer('cook_time'); //minutes
            $table->integer('servings');
            $table->integer('calories')->nullable();
            $table->integer('protein')->nullable(); //grams
            $table->addColumn('text_array', 'tags')->nullable(); //array
            $table->string('image')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->string('name');
            $table->integer('quantity');
            $table->string('unit');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unique(['recipe_id', 'name']);
            $table->timestamps();
        });

        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->integer('step_number');
            $table->text('description');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unique(['recipe_id', 'step_number']);
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
