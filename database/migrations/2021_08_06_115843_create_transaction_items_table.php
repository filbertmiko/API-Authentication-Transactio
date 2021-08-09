<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid',36)->unsigned();
            $table->unsignedBigInteger('transaction_id');
            $table->string('title',64);
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
            $table->timestamp('deteled_at')->nullable();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign('transaction_items_transaction_id_foreign');
            $table->dropColumn('transaction_id');
        });

        Schema::dropIfExists('transaction_items');
    }
}
