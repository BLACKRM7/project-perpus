# Dokumentasi Sistem Authentication & Role Distinction

## Ringkasan Sistem
Sistem login dan register telah dibuat dengan dukungan role distinction antara Admin dan User.

## File-File yang Dibuat/Dimodifikasi

### 1. Auth Controller
**File:** `app/Http/Controllers/AuthController.php`
- `showLogin()` - Menampilkan halaman login
- `login()` - Proses login dengan validasi
- `showRegister()` - Menampilkan halaman register
- `register()` - Proses register user (default role: user)
- `logout()` - Proses logout

### 2. Middleware (Role Checking)
**File:** `app/Http/Middleware/CheckAdmin.php`
- Memastikan hanya admin yang dapat akses route admin

**File:** `app/Http/Middleware/CheckUser.php`
- Memastikan hanya user biasa yang dapat akses route user

### 3. Middleware Registration
**File:** `bootstrap/app.php`
```php
$middleware->alias([
    'admin' => \App\Http\Middleware\CheckAdmin::class,
    'user' => \App\Http\Middleware\CheckUser::class,
]);
```

### 4. Routes
**File:** `routes/web.php`
```
Guest Routes:
  - GET  /login          (showLogin)
  - POST /login          (login)
  - GET  /register       (showRegister)
  - POST /register       (register)

Protected Routes:
  - POST /logout         (logout) - requires auth
  - GET  /               (home) - auto-redirect sesuai role

Admin Routes (requires auth + admin middleware):
  - GET  /admin/dashboard/(index)
  - Resource /users

User Routes (requires auth + user middleware):
  - GET  /user/dashboard/(dashboard)
```

### 5. Blade Templates
- `resources/views/pages/auth/login.blade.php` - Halaman login
- `resources/views/pages/auth/register.blade.php` - Halaman register
- `resources/views/pages/admin/dashboard.blade.php` - Dashboard admin
- `resources/views/pages/user/dashboard.blade.php` - Dashboard user
- `resources/views/errors/unauthorized.blade.php` - Error 403

### 6. Database Seeder
**File:** `database/seeders/UserSeeder.php`
Membuat:
- Admin: admin@example.com / password
- User: user@example.com / password
- 5 user dummy tambahan

**Updated:** `database/seeders/DatabaseSeeder.php`

## Model User
**File:** `app/Models/User.php`
- Role enum: 'admin' atau 'user'
- Default role saat register: 'user'

## Cara Menggunakan

### 1. Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 2. Login
Akun Demo:
- **Admin:** admin@example.com / password
- **User:** user@example.com / password

### 3. Registrasi User Baru
- Kunjungi `/register`
- Isi form dengan data lengkap
- Akun baru akan langsung login dengan role 'user'

### 4. Admin vs User Access
**Admin:**
- Akses `/admin/dashboard`
- Dapat mengelola users
- Akses semua fitur admin

**User:**
- Akses `/user/dashboard`
- Tidak dapat akses route admin (403 Unauthorized)
- Terbatas pada fitur user

## Flow Login/Register

### Login Flow:
1. User mengakses `/login`
2. Input email & password
3. Validasi credentials
4. Jika sukses, check role:
   - Admin → redirect ke `/admin/dashboard`
   - User → redirect ke `/user/dashboard`
5. Session diperbaharui

### Register Flow:
1. User mengakses `/register`
2. Input nama, email, password
3. Validasi unique email & password confirmation
4. Create user baru dengan role 'user'
5. Auto login user
6. Redirect ke `/user/dashboard`

### Logout Flow:
1. User klik logout atau submit form logout
2. Session dihapus & token diregenerasi
3. Redirect ke home

## Keamanan

1. **CSRF Protection:** Semua form dilengkapi @csrf
2. **Password Hashing:** Password diencrypt menggunakan bcrypt
3. **Session Management:** Auto regenerate token setelah login/logout
4. **Middleware Protection:** Admin & User route terlindungi middleware
5. **Validation:** Input validation di semua form

## Customization

### Menambah Admin (Database)
```php
User::create([
    'name' => 'Admin Name',
    'email' => 'admin@domain.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);
```

### Mengubah Default Role
Edit `AuthController.php` line 110:
```php
'role' => 'user', // Ubah ke 'admin' jika perlu
```

### Menambah Middleware
Edit `bootstrap/app.php` untuk menambah middleware rule baru

## Error Handling
- Login/password salah → Back dengan message error
- Email sudah terdaftar → Back dengan validation error
- Password tidak match → Back dengan validation error
- Non-admin akses admin route → 403 Unauthorized
- Non-authenticated akses protected route → Redirect ke login

## Testing Checklist
- [x] Login dengan admin
- [x] Login dengan user
- [x] Register user baru
- [x] Logout
- [x] Admin akses admin dashboard
- [x] User akses user dashboard
- [x] User tidak bisa akses admin route
- [x] Non-authenticated redirect ke login
