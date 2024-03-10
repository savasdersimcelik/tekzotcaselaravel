
## API Kullanımı

#### Giriş Yap

```http
  POST /api/login
```
Kullanıcı giriş yapabileceği API geriye JWT Token döner ve diğer tüm işlerde bu JWT token'un HEADER'da gönderilmesi gerekmektedir.

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `email`   |   `string` | **Gerekli**. Eposta adresiniz. |
| `password` |  `string` |   **Gerekli**. Şifreniz. |


#### Çıkış Yap

```http
  GET /api/logout
```

Sistemden çıkış işlemini 

#### Token Yenileme

```http
  GET /api/refresh/token
```
JWT Token yenilemek için kullanılacak API, HEADER'da JWT Token gönderilmesi zorunludur

#### Paketleri Getir

```http
  GET /api/package/list
```
Geriye kullanılabilecek paket listesini dönder. HEADER'da JWT token gönderilmesi zorunludur.

#### Kayıtlı Kartları Getir

```http
  GET /api/card/list
```
Geriye kullanılabilecek sistemde kayıtlı kredi kartlarını dönderir. HEADER'da JWT token gönderilmesi zorunludur.

#### Abonelik Başlatır

```http
  POST /api/subscriber/create
```
Belirlenen bir pakete abone olabilmek için abonelik işlemi başlatır.

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `cardNo`   |   `string` | **Gerekli**. Kredi kartı numarası |
| `cardOwner`   |   `string` | **Gerekli**. Kredi kartı sahibi adısoyadı |
| `expireMonth`   |   `string` | **Gerekli**. Kredi kartı son kullanım ayı |
| `expireYear`   |   `string` | **Gerekli**. Kredi kartı son kullanım yılı |
| `cvv`   |   `string` | **Gerekli**. Kredi kartı cvv kodu |
| `packageId`   |   `string` | **Gerekli**. Satın alınmak istenilen paket ID değeri |

#### Abonelik Durumu Sorgulama

```http
  GET /api/subscriber/status
```
subscriptionId ( Abonelik ID ) olarak gönderilen aboneliğin durumunu sorgular

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `subscriptionId`   |   `string` | **Gerekli**. Abonelik bilgisi |

#### Abonelik İptal Etme

```http
  POST /api/subscriber/status
```
subscriptionId ( Abonelik ID ) olarak gönderilen aboneliğin durumunu iptal eder

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `subscriptionId`   |   `string` | **Gerekli**. Abonelik bilgisi |

#### WEBHOOK Adresi
```http
  POST webhook-client-url
```
Webhook için kullanılacak URL

## Bilgisayarınızda Çalıştırın

Projeyi klonlayın

```bash
  git clone https://link-to-project
```

Proje dizinine gidin

```bash
  cd tekzotcaselaravel
```

Gerekli paketleri yükleyin

```bash
  composer install
```

Önbellekleri Alın

```bash
    php artisan config:cache
    php artisan route:cache
```

Sunucuyu çalıştırın

```bash
  php artisan serve
```

Servici çalıştırın

```bash
  php artisan schedule:work
```
  
