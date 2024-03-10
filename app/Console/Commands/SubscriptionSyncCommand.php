<?php

namespace App\Console\Commands;

use App\Libraries\Zotlo\Profile;
use App\Libraries\Zotlo\Request\ProfileRequest;
use App\Models\Subscriptions;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionSyncCommand extends Command
{
    private $subscription;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Veritabanındaki abonelikler ile zotlo üzerindeki abonelikleri eşitler';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Subscriptions::with(['package'])->orderBy('created_at', 'DESC')->chunk(2000, function($subscriptions){
            foreach ($subscriptions as $subscription){
                try {
                    $profileRequest = new ProfileRequest();
                    $profileRequest->setSubscriberId($subscription->subscriberId);
                    $profileRequest->setPackageId($subscription->package->package);
                    $profile = new Profile($profileRequest);
                    $request = $profile->request();

                    if ($request->getStatusCode() == 200){
                        if ($subscription->status != $request->getProfile()->getStatus() || $subscription->realStatus != $request->getProfile()->getRealStatus()){
                            $subscription->status = $request->getProfile()->getStatus();
                            $subscription->realStatus = $request->getProfile()->getRealStatus();

                            if ($request->getProfile()->getCancellation()->getDate()){
                                $subscription->cancelDate = $request->getProfile()->getCancellation()->getDate();
                                $subscription->cancelCode = $request->getProfile()->getCancellation()->getCode();
                            }

                            $subscription->save();
                        }
                    }

                } catch (RequestException $exception) {
                    Log::error(json_encode([
                        'subscriptionId' => $subscription->id,
                        'message' => $exception->getMessage()
                    ]));
                }
            }
        });
    }
}
