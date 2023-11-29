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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->text('address');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropUnique(['contact']);

            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('contact');
            $table->dropColumn('address');
    });
}
};
