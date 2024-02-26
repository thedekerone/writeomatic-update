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
        Schema::create('mixpost_post_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('mixpost_posts')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('mixpost_accounts')->onDelete('cascade');
            $table->string('provider_post_id')->nullable();
            $table->json('errors')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mixpost_post_accounts');
    }
};
