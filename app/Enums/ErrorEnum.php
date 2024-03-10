<?php

namespace App\Enums;

enum ErrorEnum: string
{
    case CP00001 = 'Kullanıcının hesabında otomatik yenileme yapılamadığı için abonelik iptal edilmiştir.';
    case CU00001 = 'Kullanıcı hesabını kendi isteği ile iptal etmiştir.';
    case CU00002 = 'İade işleminden sonra sistem tarafından otomatik iptal edilmiştir.';
}
