<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamposLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parampos_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();

            $table->string('transaction_type')->index()->comment('Siparis_ID');

            $table->string('order_id', '60')->index()->comment('Siparis_ID');
            $table->string('transaction_id')->nullable()->index()->comment('Islem_ID');

            $table->string('card_number', '8')->nullable()->comment('KK_No ilk 4 hane ve son 2 hane');
            $table->integer('installment_number')->nullable()->comment('Taksit');
            $table->text('transaction_amount')->nullable()->comment('Islem_Tutar');
            $table->string('total_amount')->nullable()->comment('Toplam_Tutar');
            $table->string('secure_type')->nullable()->comment('Islem_Guvenlik_Tip');
            $table->text('reference_url')->nullable()->comment('Ref_URL');
            $table->string('ip_address', 50)->nullable()->comment('IPAdr');

            $table->boolean('md_status')->nullable();
            $table->string('md_status_code')->nullable()->comment('Sonuc');
            $table->string('md_status_text')->nullable()->comment('Sonuc_Str');

            $table->boolean('status')->nullable();
            $table->string('status_code')->nullable()->comment('Sonuc');
            $table->string('status_text')->nullable()->comment('Sonuc_Str || Sonuc_Ack');

            $table->string('pre_auth_id')->nullable()->comment('Islem_GUID - Ön provizyon işlemleri için');

            $table->string('invoice_id')->nullable()->comment('Dekont_ID');
            $table->string('bank_transaction_id')->nullable()->comment('Bank_Trans_ID');
            $table->json('bank_extra')->nullable()->comment('Bank_Extra');


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
        Schema::dropIfExists('parampos_logs');
    }
}
