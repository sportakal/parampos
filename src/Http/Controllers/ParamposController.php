<?php

namespace Simpliers\Parampos\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Simpliers\Parampos\Requests\CompleteSecurePayment\CompleteSecurePaymentModel;
use Simpliers\Parampos\Requests\MPaymentModel\NonSecureMPayment;
use Simpliers\Parampos\Requests\PreAuth\CancelPreAuthPayment;
use Simpliers\Parampos\Requests\PreAuth\ClosePreAuthPayment;
use Simpliers\Parampos\Requests\PreAuth\SecurePreAuthPayment;
use Simpliers\Parampos\Responses\CallbackSecureResponse;
use Simpliers\Parampos\Responses\NonSecureResponse;
use Simpliers\Parampos\Responses\SecureResponse;

class ParamposController extends Controller
{
    public function secureCallback(Request $request)
    {
        $result = new CallbackSecureResponse($request->toArray());
        echo $pre_auth_id = $result->getPreAuthTransactionGUID();
        echo '<br>';

        if ($result->getMdStatus()) {
            $com = new CompleteSecurePaymentModel($result);
            if ($com->getCompleteStatus()) {
                dd($com->getCompleteMessage());
            }
        }

        dd($result);
    }

    public function nonSecureTest()
    {
        $model = new NonSecureMPayment();
        $model->setCardHolder('okesmez');
        $model->setCardNumber('4022774022774026');
        $model->setCardExpiryMonth('12');
        $model->setCardExpiryYear('2026');
        $model->setCardCvc('000');
        $model->setCardOwnerPhone('');
        $model->setInstallmentNumber('1');
        $model->setFailureUrl(route('parampos.secureCallback'));
        $model->setSuccessUrl(route('parampos.secureCallback'));
        $model->setIpAddress('188.12.34.132');
        $model->setOrderId(strtotime('now'));
        $model->setOrderDesciption('lorem');
        $model->setRefUrl('');
        $model->setTransactionAmount('25,78');
        $model->setTotalAmount('25,78');
        $model->setTransactionId(strtotime('now'));
        $model->setData1('Bu data 1');
        $model->setData2('Bu data 2');
        $model->tryPayment();

        $result = new NonSecureResponse($model);
        return $result->getResultText();
    }

    public function secureTest()
    {
        $model = new SecurePreAuthPayment();
        $model->setCardHolder('okesmez');
        $model->setCardNumber('4022774022774026');
        $model->setCardExpiryMonth('12');
        $model->setCardExpiryYear('2026');
        $model->setCardCvc('000');
        $model->setCardOwnerPhone('');
        $model->setInstallmentNumber('1');
        $model->setFailureUrl(route('parampos.secureCallback'));
        $model->setSuccessUrl(route('parampos.secureCallback'));
        $model->setIpAddress('188.12.34.132');
        $model->setOrderId(strtotime('now'));
        $model->setOrderDesciption('lorem');
        $model->setRefUrl('');
        $model->setTransactionAmount('25,78');
        $model->setTotalAmount('25,78');
        $model->setTransactionId(strtotime('now'));
        $model->setData1('Bu data 1');
        $model->setData2('Bu data 2');
        $model->tryPayment();

        $result = new SecureResponse($model);
        if ($result->getStatus()) {
            return $result->getThreeDContent();
        }

        return $result->getResultText();
    }

    public function closePreAuth()
    {
        $pre_auth_id = "5d142f07-321c-46ce-a2a9-616bd41844ad";
        $pre_auth_amount = "15";
        $order_id = "";
        $close_pre_auth = new ClosePreAuthPayment();
        $close_pre_auth->setPreAuthId($pre_auth_id);
        $close_pre_auth->setPreAuthAmount($pre_auth_amount);
        $close_pre_auth->setOrderId($order_id);
        $close_pre_auth->tryPayment();

        $result = new NonSecureResponse($close_pre_auth);
        $result->getResultText();
    }

    public function cancelPreAuth()
    {
        $pre_auth_id = "5d142f07-321c-46ce-a2a9-616bd41844ad";
        $pre_auth_amount = "15";
        $order_id = "";
        $close_pre_auth = new CancelPreAuthPayment();
        $close_pre_auth->setPreAuthId($pre_auth_id);
        $close_pre_auth->setOrderId($order_id);
        $close_pre_auth->tryPayment();

        $result = new NonSecureResponse($close_pre_auth);
        $result->getResultText();
    }
}