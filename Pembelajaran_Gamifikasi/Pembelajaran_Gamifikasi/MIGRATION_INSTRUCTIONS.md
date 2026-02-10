# INSTRUKSI MIGRASI DATABASE

## Langkah-langkah Setup Database:

### 1. Backup Database (PENTING!)
```bash
# Backup database Anda terlebih dahulu
```

### 2. Reset Database
```bash
php artisan migrate:fresh
```

### 3. Jalankan Seeder
```bash
php artisan db:seed --class=DifficultySeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=BadgeSeeder
```

### 4. Atau Reset + Seed Sekaligus
```bash
php artisan migrate:fresh --seed
```

## Struktur Database Baru:

### Tabel Baru:
- `difficulties` - Tingkat kesulitan (Dasar, Pemula, Menengah, Mahir)
- `categories` - Kategori pembelajaran (Front End, Back End, UI/UX, Android)
- `category_levels` - Tingkatan dalam setiap kategori
- `user_progress` - Progress belajar user

### Tabel yang Diupdate:
- `materials` - Ditambah: category_id, level_id
- `quizzes` - Ditambah: level_id, update foreign key category_id

### Tabel Lama (Tidak Digunakan):
- `quiz_categories` - Diganti dengan `categories`

## Catatan:
- Sistem EXP dan LEVEL user tetap dipertahankan
- Data quiz dan material lama perlu di-input ulang dengan kategori dan level baru
- Progress user akan otomatis dibuat saat pertama kali akses kategori
