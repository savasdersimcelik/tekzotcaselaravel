<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case CANCELED = 'canceled';
    case PASSIVE = 'passive';
    case COMPLETE = 'COMPLETE';
    case SUCCESS = 'success';
    case TRIAL = 'trial';
    case TRIAL_TO_PAID = 'trial_to_paid';
    case RENEWAL = 'renewal';
    case REACTIVE = 'reactive';
    case CONSUMABLE = 'consumable';
    case START_PAID = 'start_paid';
    case SET_QUANTITY = 'set_quantity';
    case NEW_SUBSCRIBER = 'newSubscriber';
    case CANCEL = 'cancel';
    case ACTIVE_TO_GRACE = 'activeToGrace';
    case GRACE_TO_ACTIVE = 'graceToActive';
    case PACKAGE_UPGRADE = 'packageUpgrade';
    case PACKAGE_DOWNGRADE = 'packageDowngrade';
    case REFUND = 'refund';
    case GRACE_TO_PASSIVE = 'graceToPassive';
}
