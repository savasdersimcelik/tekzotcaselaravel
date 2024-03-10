<?php

namespace App\Enums;

enum HookEnum: string
{
    case SUBSCRIBER_UPDATE = 'SubscriberUpdate';
    case NEW_SUBSCRIBER = 'newSubscriber';
    case CANCEL = 'cancel';
    case REACTIVATE = 'reactivate';
    case RENEWAL = 'renewal';
    case REFUND = 'refund';
}
