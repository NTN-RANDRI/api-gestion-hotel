<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->dateTime('date_arrivee')->nullable();
            $table->dateTime('date_depart')->nullable();
            $table->dateTime('annuler')->nullable();
            $table->dateTime('date_reservation')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('nombre_personnes')->unsigned();
            $table->integer('montant_total')->unsigned();
            $table->enum('type', ['sur_place', 'par_telephone', 'en_ligne']);
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
