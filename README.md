# Jastipin

Jastipin adalah aplikasi web jastip sederhana menggunakan PHP Native, MongoDB, Composer, dan pola MVC. Proyek ini cocok sebagai fondasi tugas akhir karena struktur kodenya dipisah menjadi controller, model, middleware, core, routes, dan views.

## Struktur Folder

```txt
app/
├── Controllers/
│   ├── AuthController.php
│   ├── BuyerController.php
│   ├── OfferController.php
│   ├── ProviderController.php
│   └── OrderController.php
├── Middleware/
│   ├── AuthMiddleware.php
│   └── RoleMiddleware.php
├── Models/
│   ├── User.php
│   ├── Offer.php
│   └── Order.php
└── Core/
    ├── Database.php
    ├── Router.php
    └── Controller.php
config/
└── config.php
public/
├── index.php
└── .htaccess
routes/
└── web.php
views/
├── auth/
├── buyer/
│   ├── offers/
│   │   └── index.php
│   └── orders/
│       └── create.php
├── provider/
│   └── offers/
│       ├── index.php
│       └── create.php
├── orders/
└── layouts/
```

## Instalasi

Pastikan ekstensi MongoDB untuk PHP sudah aktif di XAMPP. Setelah itu jalankan:

```bash
composer install
```

Salin konfigurasi environment:

```bash
copy .env.example .env
```

Jalankan dari folder project:

```bash
composer run serve
```

Lalu buka:

```txt
http://localhost:8000
```

Untuk XAMPP Apache, arahkan browser ke:

```txt
http://localhost/jastip/public
```

## Konfigurasi MongoDB

Database yang digunakan:

```txt
jastip
```

Collection:

```txt
users
offers
orders
```

Contoh `.env`:

```env
APP_NAME=Jastipin
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/jastip/public

SESSION_NAME=JASTIPIN_SESSION

MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=jastip
```

Index dibuat otomatis dari model:

```php
users: email unique
offers: provider_id, status, deadline, category
orders: offer_id, buyer_id, provider_id, category, kategori, status
```

## Route

```txt
GET    /register
POST   /register
GET    /login
POST   /login
GET    /logout

GET    /buyer/dashboard
GET    /buyer/offers
GET    /buyer/orders/create
POST   /buyer/orders/store
GET    /buyer/orders/history

GET    /provider/dashboard
GET    /provider/offers
GET    /provider/offers/create
POST   /provider/offers/store
GET    /provider/orders/history
POST   /provider/orders/accept
POST   /provider/orders/complete

GET    /orders
GET    /orders/summary/avg-service-fee
```

## Contoh Data

File seed JSON tersedia di:

```txt
database/seed/users.json
database/seed/offers.json
database/seed/orders.json
```

Masukkan data seed ke MongoDB:

```bash
php database/seed/seed.php
```

Jika ada dokumen `orders` lama yang field-nya belum sesuai struktur aplikasi, jalankan:

```bash
php database/seed/fix_orders_schema.php
```

Register buyer:

```txt
name: Budi Buyer
email: buyer@example.com
password: password123
role: buyer
phone: 08123456789
address: Jakarta
```

Register provider:

```txt
name: Sari Provider
email: provider@example.com
password: password123
role: provider
phone: 08987654321
address: Bandung
```

Login:

```txt
email: buyer@example.com
password: password123
```

Create order:

```txt
Buyer buka /buyer/offers
Klik Titip Barang pada salah satu offer aktif
URL menjadi /buyer/orders/create?offer_id={id}
provider_id otomatis berasal dari offer
```

Status pesanan baru otomatis `pending`. Provider melihat pending order miliknya di dashboard, lalu klik `ACC` untuk mengubah status menjadi `diproses`, dan `Selesaikan` untuk status `selesai`.

## Relasi MongoDB

Relasi terbaik untuk aplikasi ini adalah menyimpan referensi ObjectId, bukan embed order di dalam offer:

```txt
offers._id  -> orders.offer_id
users._id   -> offers.provider_id
users._id   -> orders.provider_id
users._id   -> orders.buyer_id
```

Satu offer bisa punya banyak order:

```js
db.orders.find({ offer_id: ObjectId("665d20000000000000000003") })
```

Offer aktif yang tampil ke buyer hanya yang `status = active` dan `deadline` belum lewat:

```js
db.offers.find({
  status: "active",
  deadline: { $gte: new Date(new Date().toISOString().slice(0, 10)) }
})
```

## Alur Kerja

Authentication:
User register disimpan ke collection `users`. Password di-hash dengan `password_hash`. Login mencari user berdasarkan email, lalu mencocokkan password dengan `password_verify`. Jika valid, data user tanpa password disimpan ke `$_SESSION['user']`.

Role buyer:
Route buyer dilindungi `AuthMiddleware` dan `RoleMiddleware('buyer')`. Buyer melihat daftar Open Jastip aktif dari collection `offers`, lalu membuat order dari `offer_id`. Buyer tidak memilih provider manual.

Role provider:
Route provider dilindungi `AuthMiddleware` dan `RoleMiddleware('provider')`. Provider membuat Open Jastip ke collection `offers`, melihat pending order berdasarkan `provider_id`, lalu melakukan ACC dan selesai.

Aggregation dashboard provider:
`Order::providerSummary()` memakai pipeline `$match` untuk `provider_id` dan `status = selesai`, lalu `$group` dengan `$sum` untuk total pendapatan dan jumlah pesanan selesai.

Filter kategori:
Endpoint `/orders?category=makanan` menerima kategori `makanan`, `fotokopi`, `perlengkapan`, atau `lainnya`, lalu query MongoDB membaca field baru `category` dan alias lama `kategori`.

Rekap rata-rata harga jasa:
Endpoint `/orders/summary/avg-service-fee` memakai aggregation `$match` untuk status `selesai`, lalu `$group` dengan `$avg` pada `service_fee` dan fallback alias lama `harga_jasa`.
