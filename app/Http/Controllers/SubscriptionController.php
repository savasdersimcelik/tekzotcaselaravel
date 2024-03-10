<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Libraries\Zotlo\Cancel;
use App\Libraries\Zotlo\Payment;
use App\Libraries\Zotlo\Request\CancelRequest;
use App\Libraries\Zotlo\Request\PaymentRequest;
use App\Models\Packages;
use App\Models\Subscriptions;
use App\Models\Transactions;
use App\Rules\ValidCardCvv;
use App\Rules\ValidCardDate;
use App\Rules\ValidCardNumber;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    private Payment $payment;
    private $subscription;

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cardOwner" => ['required'],
            "cardNo" => ['required', new ValidCardNumber()],
            'expireYear' => ['required', new ValidCardDate($request->post('expireYear'), $request->post('expireMonth'))],
            'expireMonth' => ['required', new ValidCardDate($request->post('expireYear'), $request->post('expireMonth'))],
            'cvv' => ['required', new ValidCardCvv($request->post('cardNo'))],
            "packageId" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Subscriptions::getUserActiveByPackageId($request->post('packageId'))) {
            return response()->json([
                'status' => false,
                'message' => 'Bu pakete daha önce kayıt olmuşsunuz'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->subscribe($request);
    }

    private function subscribe(Request $request)
    {
        try {
            $paymentRequest = new PaymentRequest();
            $paymentRequest->setCardNo($request->post('cardNo'));
            $paymentRequest->setCardOwner($request->post('cardOwner'));
            $paymentRequest->setExpireMonth($request->post('expireMonth'));
            $paymentRequest->setExpireYear($request->post('expireYear'));
            $paymentRequest->setCvv($request->post('cvv'));
            $paymentRequest->setPackageId($request->post('packageId'));
            $paymentRequest->setSubscriberId(Auth::id());
            $paymentRequest->setSubscriberEmail(Auth::user()->email);
            $paymentRequest->setSubscriberFirstname(Auth::user()->firstname);
            $paymentRequest->setSubscriberLastname(Auth::user()->lastname);
            $paymentRequest->setSubscriberPhoneNumber("+905555555555");
            $paymentRequest->setRedirectUrl("https://example.com");

            $this->payment = new Payment($paymentRequest);
            $this->payment->request();
            if ($this->payment->getStatusCode() == 200){
                if($this->payment->getPayment()->isSuccess() && $this->payment->getPayment()->getPaymentStatus() == StatusEnum::COMPLETE->value){
                    return $this->success();
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Abonelik başlatılamadı',
            ], Response::HTTP_BAD_REQUEST);

        } catch (RequestException $exception) {
            $body = json_decode($exception->getResponse()->getBody()->getContents());
            return response()->json([
                'message' => $body->meta->errorMessage
            ], $exception->getCode());
        }
    }

    public function status(Request $request)
    {
        $this->subscription = Subscriptions::getUserActiveById($request->get('subscriptionId'));
        if ($this->subscription) {
            return response()->json([
                'status' => true,
                'message' => 'Abonelik mevcut',
                'result' => $this->subscription
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => false,
            'message' => 'Abonelik bulunamadı',
        ], Response::HTTP_OK);
    }

    public function cancel(Request $request)
    {
        $this->subscription = Subscriptions::getUserActiveById($request->get('subscriptionId'));
        if ($this->subscription) {
            DB::beginTransaction();
            try {
                $cancelRequest = new CancelRequest();
                $cancelRequest->setSubscriberId(Auth::id());
                $cancelRequest->setPackageId($this->subscription->package->package);
                $cancelRequest->setReason('Kullanıcı isteği');
                $cancelRequest->setForce($request->post('forge', 0));

                $cancel = new Cancel($cancelRequest);
                $cancel->request();

                if ($cancel->getStatusCode() == 200){
                    $this->subscription->status = $cancel->getProfile()->getStatus();
                    $this->subscription->realStatus = $cancel->getProfile()->getRealStatus();
                    $this->subscription->cancelDate = $cancel->getProfile()->getCancellation()->getDate();
                    $this->subscription->cancelCode = $cancel->getProfile()->getCancellation()->getCode();
                    $this->subscription->save();

                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'message' => 'Abonelik iptal edildi',
                        'result' => Subscriptions::getUserById($request->get('subscriptionId'))
                    ], Response::HTTP_OK);
                }

                return response()->json([
                    'status' => false,
                    'message' => 'İşlem başarısız',
                ], Response::HTTP_BAD_REQUEST);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Aktif abonelik bulunamadı',
        ], Response::HTTP_OK);
    }


    /** Private Metotlar */

    private function success()
    {
        try {
            DB::transaction(function () {
                $this->subscription = Subscriptions::getUserBySubscriptionId($this->payment->getProfile()->getSubscriptionId());
                if ($this->subscription){
                    Subscriptions::updateByProfileData($this->payment->getProfile());
                }else{
                    $this->subscription = Subscriptions::addByProfileData($this->payment->getProfile());
                    Packages::addByPackageData($this->subscription->id, $this->payment->getPackage());
                }
                Transactions::addByTransactionData($this->subscription->id, $this->payment->getPayment());
            });
            return response()->json([
                'status' => true,
                'message' => 'Abonelik başlatıldı',
                'id' => $this->subscription->id
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
