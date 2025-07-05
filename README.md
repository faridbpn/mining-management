# Aplikasi Pemesanan Kendaraan Perusahaan Tambang

Aplikasi web untuk monitoring dan manajemen pemesanan kendaraan perusahaan tambang nikel dengan sistem approval berjenjang.

## Fitur Utama

- **Role-based Access Control**: Admin dan Approver dengan hak akses berbeda
- **Pemesanan Kendaraan**: Admin dapat input pemesanan, pilih driver, dan tentukan approver
- **Approval Multi-Level**: Minimal 2 level approval (Level 1 & Level 2)
- **Dashboard Monitoring**: Grafik pemakaian kendaraan dan statistik
- **Laporan Periodik**: Export laporan ke Excel dengan filter
- **Log Aktivitas**: Mencatat semua aksi penting dalam sistem
- **UI/UX Responsive**: Tampilan modern dan mudah digunakan

## Teknologi

- **Framework**: Laravel 11.x
- **Database**: MySQL 8.0
- **PHP Version**: 8.2+
- **Frontend**: Bootstrap 5, Chart.js
- **Server**: Apache/Nginx

## Akun Login Dummy

### Admin (Petugas Pool)
- **Email**: admin@tambang.com
- **Password**: admin123
- **Fitur**: Input pemesanan, kelola kendaraan/driver, laporan, log aktivitas

### Approver Level 1
- **Email**: approver1@tambang.com
- **Password**: approver123
- **Fitur**: Approval pemesanan level 1, riwayat persetujuan

### Approver Level 2
- **Email**: approver2@tambang.com
- **Password**: approver123
- **Fitur**: Approval pemesanan level 2, riwayat persetujuan

### Pegawai
- **Email**: pegawai1@tambang.com
- **Password**: pegawai123
- **Fitur**: Melihat pemesanan sendiri

## Instalasi

1. **Clone Repository**
```bash
git clone <repository-url>
cd aplikasi-tambang
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_tambang
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan Migration & Seeder**
```bash
php artisan migrate
php artisan db:seed
```

6. **Serve Application**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Struktur Database

### Tabel Utama
- **users**: Data pengguna dengan role (admin, approver, employee)
- **locations**: Lokasi (kantor pusat, cabang, 6 tambang)
- **vehicles**: Data kendaraan (milik/sewa, angkutan orang/barang)
- **drivers**: Data driver per lokasi
- **bookings**: Pemesanan kendaraan
- **approvals**: Approval multi-level
- **activity_logs**: Log aktivitas sistem

### Relasi
- User → Booking (1:N)
- Vehicle → Booking (1:N)
- Driver → Booking (1:N)
- Location → Vehicle (1:N)
- Location → Driver (1:N)
- Booking → Approval (1:N)
- User → Approval (1:N) [sebagai approver]

## Panduan Penggunaan

### Admin (Petugas Pool)

1. **Login** dengan akun admin
2. **Dashboard**: Lihat statistik kendaraan dan pemesanan hari ini
3. **Kelola Pemesanan**:
   - Klik "Tambah Pemesanan"
   - Isi form: pegawai, kendaraan, driver, tujuan, waktu
   - Sistem otomatis buat approval level 1 & 2
4. **Kelola Kendaraan**: Tambah/edit data kendaraan
5. **Kelola Driver**: Tambah/edit data driver
6. **Laporan**: Filter dan export laporan periodik
7. **Log Aktivitas**: Monitor semua aksi dalam sistem

### Approver

1. **Login** dengan akun approver
2. **Dashboard**: Lihat jumlah permintaan yang perlu disetujui
3. **Daftar Persetujuan**: Lihat pemesanan yang menunggu approval
4. **Detail Persetujuan**: Lihat info lengkap dan klik Setujui/Tolak
5. **Riwayat Persetujuan**: Lihat semua yang pernah disetujui/ditolak

### Alur Approval

1. Admin input pemesanan → Status: Pending
2. Approver Level 1 setujui → Diteruskan ke Level 2
3. Approver Level 2 setujui → Status: Approved
4. Jika salah satu tolak → Status: Rejected

## Physical Data Model (PDM)

```
users (id, name, email, password, role, created_at, updated_at)
├── bookings (id, user_id, vehicle_id, driver_id, location_id, purpose, destination, start_time, end_time, fuel_used, distance, status, created_at, updated_at)
│   └── approvals (id, booking_id, approver_id, level, status, note, created_at, updated_at)
├── vehicles (id, name, type, ownership, plate_number, location_id, fuel_capacity, service_interval_km, created_at, updated_at)
├── drivers (id, name, phone, location_id, created_at, updated_at)
└── locations (id, name, type, created_at, updated_at)

activity_logs (id, user_id, action, description, loggable_id, loggable_type, created_at, updated_at)
```

## Activity Diagram

```
[Start] → [Admin Login] → [Input Pemesanan] → [Pilih Driver & Approver]
    ↓
[Status: Pending] → [Approver Level 1 Review] → [Setujui/Tolak]
    ↓
[If Setujui] → [Approver Level 2 Review] → [Setujui/Tolak]
    ↓
[If Setujui] → [Status: Approved] → [Kendaraan Siap Digunakan]
    ↓
[If Tolak] → [Status: Rejected] → [End]

[Log Aktivitas] → [Record setiap aksi] → [Dashboard Monitoring]
```

## Keamanan

- **Authentication**: Login dengan email dan password
- **Authorization**: Role-based access control
- **CSRF Protection**: Laravel built-in CSRF protection
- **Input Validation**: Validasi semua input user
- **SQL Injection Protection**: Eloquent ORM protection

## Maintenance

- **Backup Database**: Regular backup MySQL
- **Log Monitoring**: Monitor activity_logs table
- **Performance**: Optimize queries dengan eager loading
- **Security Updates**: Update Laravel dan dependencies

## Support

Untuk bantuan teknis atau pertanyaan, silakan hubungi tim IT perusahaan.
