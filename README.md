# [NAMA PROYEK API]

> API berbasis Laravel untuk manajemen entitas (merek, kategori, alat, sparepart, cabang, operator, teknisi, user) lengkap dengan autentikasi menggunakan Laravel Sanctum.

## Ringkasan

Repository ini berisi source code API yang dibangun dengan Laravel 12 (PHP >= 8.2) dengan autentikasi token via Sanctum. Proyek mencakup modular controller, validasi, seeding contoh data, dan konfigurasi testing menggunakan SQLite in-memory.

## Fitur Utama

- **Autentikasi**: Login, Logout, Register (customer) menggunakan Sanctum.
- **Manajemen Profil**: Lihat dan update profil user (ganti password dengan verifikasi password lama).
- **Manajemen Master Data**: CRUD untuk Merek, Kategori, Alat, Sparepart, Cabang, Operator, Teknisi.
- **Manajemen User (Admin)**: Buat, listing, update, hapus user terhubung ke Operator/Teknisi.
- **Laporan**: Endpoint rekap pemasukan, pengeluaran, selisih.
- **Request Sparepart**: Alur approval/reject request sparepart dari operator.
- **Dashboard**: Ringkasan service untuk admin.

## Teknologi yang Digunakan

- PHP ^8.2
- Laravel ^12.0
- Laravel Sanctum ^4.2
- PHPUnit ^11 (testing)
- Laravel Pint (code style)
- Composer, Artisan CLI

## Struktur Folder Penting (Ringkas)

```
app/
  Http/Controllers/        # Controller API
config/
database/
  migrations/              # Migrasi database
  seeders/                 # Seeder sample data
routes/
  api.php                  # Definisi endpoint API
  web.php
phpunit.xml                # Konfigurasi test (SQLite in-memory)
composer.json              # Dependensi & scripts
```

## Instalasi & Setup

1) Clone repository

```bash
git clone <URL_REPO>
cd <nama-folder-repo>
```

2) Install dependency PHP

```bash
composer install
```

3) Siapkan environment

```bash
cp .env.example .env
php artisan key:generate
```

4) Konfigurasi database di `.env`

Contoh MySQL:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elservice
DB_USERNAME=root
DB_PASSWORD=secret
```

5) Migrasi & seeding

```bash
php artisan migrate --force
php artisan db:seed
```

Opsional SQLite lokal:

```bash
touch database/database.sqlite
# ubah .env -> DB_CONNECTION=sqlite dan DB_DATABASE=/absolute/path/database/database.sqlite
php artisan migrate --force
php artisan db:seed
```

## Menjalankan Server

```bash
php artisan serve
```

Server default: http://127.0.0.1:8000

## Dokumentasi Endpoint

Semua endpoint berada di prefix `/api`. Autentikasi menggunakan header `Authorization: Bearer <token>` untuk endpoint yang membutuhkan.

### Auth

| Method | Path | Auth | Deskripsi |
|-------|------|------|-----------|
| POST | /api/login | - | Login dan mendapatkan token |
| POST | /api/register | - | Registrasi customer |
| GET | /api/logout | Bearer | Logout (revoke current token) |

Contoh Request Login:

```http
POST /api/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "secret123"
}
```

Contoh Response Login (200):

```json
{
  "message": "Login sukses",
  "token": "<sanctum_token>",
  "user": { "id": 1, "email": "user@example.com", "username": "john" },
  "role": "admin",
  "detail": { }
}
```

### Profil

| Method | Path | Auth | Deskripsi |
|-------|------|------|-----------|
| GET | /api/profile | Bearer | Mendapatkan profil user saat ini |
| PATCH | /api/profile | Bearer | Update profil (username/email/password) |

Contoh Request Update Password:

```http
PATCH /api/profile
Authorization: Bearer <token>
Content-Type: application/json

{
  "old_password": "secret123",
  "new_password": "newSecret123",
  "confirm_password": "newSecret123"
}
```

Contoh Response (200):

```json
{
  "message": "Profile updated successfully",
  "user": { }
}
```

### Admin Only

Grup ini membutuhkan middleware `auth:sanctum` dan `role:admin`.

- Resource CRUD: `merek`, `kategori`, `alat`, `sparepart`, `cabang`, `operator`, `teknisi`
- Manajemen User: `/api/users`
- Laporan: `/api/laporan/*`
- Request Sparepart Admin: `/api/sparepart/request/*`
- Dashboard: `/api/admin/dashboard/service-summary`

Contoh utama:

| Method | Path |
|-------|------|
| GET | /api/merek |
| POST | /api/merek |
| GET | /api/merek/{id} |
| PATCH | /api/merek/{id} |
| DELETE | /api/merek/{id} |

| Method | Path | Deskripsi |
|-------|------|-----------|
| POST | /api/users | Buat user dari operator/teknisi |
| GET | /api/users | List user (filter `?role=operator|teknisi|admin|customer`) |
| PATCH | /api/users/{user} | Update sebagian field user |
| DELETE | /api/users/{user} | Hapus user beserta unlink relasi |

| Method | Path | Deskripsi |
|-------|------|-----------|
| GET | /api/laporan/pemasukan | Total pemasukan |
| GET | /api/laporan/pengeluaran | Total pengeluaran |
| GET | /api/laporan/selisih | Selisih pemasukan vs pengeluaran |

| Method | Path | Deskripsi |
|-------|------|-----------|
| GET | /api/sparepart/request/admin/{id_admin} | Daftar request sparepart dari operator |
| PATCH | /api/sparepart/request/{id_request}/approve | Approve request |
| PATCH | /api/sparepart/request/{id_request}/reject | Reject request |

| Method | Path | Deskripsi |
|-------|------|-----------|
| GET | /api/admin/dashboard/service-summary | Ringkasan service admin |

## Testing

Konfigurasi `phpunit.xml` menggunakan SQLite in-memory.

Jalankan test:

```bash
php artisan test
# atau
composer test
```

## Deploy (Opsional)

- Siapkan `.env` produksi (APP_ENV=production, APP_DEBUG=false).
- Jalankan migrasi dan seeder sesuai kebutuhan: `php artisan migrate --force`.
- Cache konfigurasi & routes: `php artisan config:cache && php artisan route:cache`.
- Pastikan permission folder: `storage/` dan `bootstrap/cache` writable oleh user web server.
- Buat symlink storage: `php artisan storage:link`.
- Gunakan proses manager (Supervisor / systemd) untuk queue jika diperlukan.

## Catatan Tambahan

- Permission: pastikan `storage/` dan `bootstrap/cache` dapat ditulis (775/recursive atau sesuai policy server).
- Symlink: `php artisan storage:link` untuk akses file publik.
- Rate limiting & CORS: atur pada `app/Http/Kernel.php` atau `config/cors.php` sesuai kebutuhan klien.
- Token: semua endpoint privat gunakan header `Authorization: Bearer <token>`.

## Clean Code & Standar Proyek

- Pisahkan validasi ke Form Request (mis. `UpdateProfileRequest`, `StoreUserRequest`).
- Gunakan Resource/DTO untuk response konsisten (hindari return model mentah).
- Centralized error handling via Exception Handler & custom exceptions (422/401/403/404).
- Service Layer untuk business logic kompleks (AuthService, UserService, RequestSparepartService).
- Beri nama yang konsisten (snake_case DB, camelCase JSON, bahasa Inggris di kode jika memungkinkan).
- Terapkan Laravel Pint: `./vendor/bin/pint`.
- Static analysis (opsional): Larastan.
- Logging & audit pada operasi kritikal.
- Tambahkan dokumentasi OpenAPI/Swagger (opsional) untuk API contract.

---

Ganti judul di atas menjadi nama proyek Anda: `[NAMA PROYEK API]`.
