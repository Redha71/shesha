<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('subcategory_id');
            $table->string('childsubcategory_name_en');
            $table->string('childsubcategory_name_ar')->nullable();
            $table->string('childsubcategory_slug_en');
            $table->string('childsubcategory_slug_ar')->nullable();
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
        Schema::dropIfExists('child_sub_categories');
    }
}
