<?php

namespace App\Handler;

use App\Enums\CountryEnum;
use App\Enums\CurrencyEnum;
use App\Enums\ErrorEnum;
use App\Enums\HookEnum;
use App\Enums\StatusEnum;
use App\Libraries\Zotlo\Response\Package;
use App\Libraries\Zotlo\Response\Payment;
use App\Libraries\Zotlo\Response\Profile;
use App\Models\Packages;
use App\Models\Subscriptions;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class WebhookHandler extends ProcessWebhookJob
{
    private $payload = null;
    private $parameters = null;

    private $subscription;

    public function handle(){
        $data = json_decode($this->webhookCall, true);
        $this->payload = $data['payload'] ?? null;
        $this->parameters = $this->payload['parameters'] ?? null;
        $this->queue = $this->payload['queue'] ?? null;
        if ($this->queue){
            if($this->queue['type'] == HookEnum::SUBSCRIBER_UPDATE->value){
                $profile = new Profile($this->parameters['profile'] ?? null);
                $package = new Package($this->parameters['package'] ?? null);
                $payment = new Payment($this->parameters['response'] ?? null);
                if ($this->queue['eventType'] == HookEnum::NEW_SUBSCRIBER->value){
                    DB::beginTransaction();
                    try {
                        $this->subscription = Subscriptions::addByProfileData($profile);
                        Packages::addByPackageData($this->subscription->id, $package);
                        Transactions::addByTransactionData($this->subscription->id, $payment);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                    }
                }else{
                    $profile = new Profile($this->parameters['profile'] ?? null);
                    DB::beginTransaction();
                    try {
                        $this->subscription = Subscriptions::updateByProfileData($profile);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        }
    }
}
