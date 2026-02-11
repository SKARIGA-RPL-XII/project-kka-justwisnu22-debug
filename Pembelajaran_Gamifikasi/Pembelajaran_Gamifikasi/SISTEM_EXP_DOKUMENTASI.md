# Sistem EXP dan Unlock Tingkatan - Dokumentasi

## ✅ Fitur yang Telah Diimplementasikan

### 1. Sistem EXP dari Membaca Materi

#### Database
- **Tabel baru**: `user_material_progress`
  - `id`: Primary key
  - `user_id`: Foreign key ke users
  - `material_id`: Foreign key ke materials
  - `exp_claimed_at`: Timestamp kapan EXP diklaim (nullable)
  - Unique constraint pada `user_id` dan `material_id` untuk mencegah duplikasi

- **Kolom baru pada tabel `materials`**:
  - `exp_reward`: Integer, default 0

#### Admin Side
- Form create/edit materi sekarang memiliki field "EXP Reward"
- Validasi: exp_reward harus integer dan minimal 0

#### User Side
- Tombol "Sudah Membaca Materi & Dapatkan X EXP" muncul setelah konten materi
- Tombol berubah menjadi disabled "✓ EXP Sudah Diklaim" setelah diklaim
- EXP hanya bisa diklaim 1 kali per user per materi
- Menggunakan SweetAlert untuk notifikasi sukses/gagal

#### Security
- Unique constraint di database mencegah duplikasi
- Validasi di controller untuk cek apakah sudah pernah claim
- CSRF protection
- Authentication required

---

### 2. Sistem Unlock Tingkatan

#### Logic
- User hanya bisa lanjut ke tingkatan berikutnya jika **lulus quiz** (score >= 75%)
- Claim EXP dari membaca materi **TIDAK** membuka tingkatan selanjutnya
- Status tingkatan disimpan di tabel `user_progress`:
  - `ongoing`: Sedang dikerjakan
  - `completed`: Sudah lulus quiz
  - `locked`: Belum bisa diakses

#### Flow
1. User membaca materi → bisa claim EXP (opsional)
2. User mengerjakan quiz → jika lulus (≥75%):
   - Tingkatan saat ini di-mark sebagai `completed`
   - Tingkatan berikutnya di-unlock (status `ongoing`)
   - User mendapat EXP dari quiz

---

### 3. Sistem Quiz dengan Highest Score Only

#### Retake Quiz
- Jika user sudah pernah mengerjakan quiz, muncul popup SweetAlert:
  - Menampilkan nilai sebelumnya
  - Pilihan: "Ya, Kerjakan Ulang" atau "Tidak, Kembali"
  - Informasi: "Hanya nilai tertinggi yang akan disimpan"

#### Logic Highest Score
```php
if (!$previousResult) {
    // First attempt - simpan hasil
    $shouldUpdate = true;
    $earnedExp = $isPassed ? $quiz->exp_reward : 0;
} else {
    // Retake - hanya update jika score lebih tinggi
    if ($scorePercentage > $previousResult->score) {
        $shouldUpdate = true;
        $earnedExp = $newExp - $oldExp; // Selisih EXP
    } else {
        $shouldUpdate = false; // Tidak update database
    }
}
```

#### Hasil Quiz
- **Nilai Baru Lebih Tinggi**: Update database, tambah EXP selisih
- **Nilai Sama/Lebih Rendah**: Tidak update, tampilkan pesan "Nilai Tidak Berubah"
- **Sudah Lulus & Retake Turun**: Status tetap lulus, nilai tertinggi tetap tersimpan

---

### 4. Sistem Routing Quiz Sesuai Kategori & Tingkatan

#### Database Relation
```php
// Quiz Model
public function category() {
    return $this->belongsTo(Category::class);
}

public function level() {
    return $this->belongsTo(CategoryLevel::class, 'level_id');
}
```

#### Query Quiz
```php
$quiz = Quiz::where('category_id', $categoryId)
            ->where('level_id', $levelId)
            ->firstOrFail();
```

#### Admin Side
- Dropdown tingkatan di CRUD Quiz dan Materi menggunakan AJAX
- Hanya menampilkan tingkatan yang sesuai dengan kategori yang dipilih
- Endpoint: `/admin/categories/{categoryId}/levels`

---

### 5. Alur Final Sistem EXP

#### Sumber EXP
1. **Membaca Materi**: Claim 1x saja, tidak unlock tingkatan
2. **Quiz**: Berdasarkan nilai tertinggi, unlock tingkatan jika lulus

#### Contoh Flow
```
User masuk Level 1
├─ Baca materi → Claim 50 EXP ✓
├─ Kerjakan quiz → Nilai 80% → Lulus ✓
│  ├─ Dapat 100 EXP dari quiz
│  ├─ Level 1 completed
│  └─ Level 2 unlocked
│
User masuk Level 2
├─ Baca materi → Claim 75 EXP ✓
├─ Kerjakan quiz → Nilai 60% → Tidak Lulus ✗
│  └─ Tidak dapat EXP, Level 2 masih ongoing
├─ Retake quiz → Nilai 85% → Lulus ✓
│  ├─ Dapat 150 EXP dari quiz (nilai tertinggi)
│  ├─ Level 2 completed
│  └─ Level 3 unlocked
│
User retake Level 2 quiz
├─ Nilai 70% → Lebih rendah dari 85%
└─ Tidak update database, nilai tertinggi tetap 85%
```

---

## 🔒 Security Features

1. **Unique Constraint**: Mencegah duplikasi claim EXP materi
2. **CSRF Protection**: Semua POST request dilindungi CSRF token
3. **Authentication**: Semua endpoint memerlukan login
4. **Validation**: Input divalidasi di controller
5. **Database Transaction**: Operasi EXP dan unlock menggunakan transaction (via ExpService)

---

## 📁 File yang Dimodifikasi/Dibuat

### Migration
- `2026_02_11_171417_add_exp_reward_to_materials_table.php`
- `2026_02_11_171508_create_user_material_progress_table.php`

### Model
- `UserMaterialProgress.php` (baru)
- `Material.php` (update fillable)

### Controller
- `AdminController.php` (update validation)
- `MaterialController.php` (tambah method claimExp)
- `UserQuizController.php` (update logic highest score)

### View
- `admin/materials/create.blade.php` (tambah field exp_reward)
- `admin/materials/edit.blade.php` (tambah field exp_reward)
- `materials/show.blade.php` (tambah tombol claim EXP)
- `quiz/show.blade.php` (tambah popup retake)

### Routes
- `web.php` (tambah route materials.claimExp)

---

## 🎯 Testing Checklist

- [ ] Admin bisa menambah materi dengan EXP reward
- [ ] User bisa claim EXP dari materi (1x saja)
- [ ] User tidak bisa claim EXP materi 2x
- [ ] Quiz menampilkan popup retake jika sudah pernah dikerjakan
- [ ] Nilai quiz hanya update jika lebih tinggi
- [ ] EXP quiz dihitung dari nilai tertinggi
- [ ] Lulus quiz membuka tingkatan berikutnya
- [ ] Claim EXP materi tidak membuka tingkatan
- [ ] Dropdown tingkatan di admin sesuai kategori
- [ ] Quiz yang tampil sesuai kategori dan tingkatan

---

## 📝 Catatan Penting

1. **EXP Materi vs Quiz**:
   - EXP Materi: Bonus untuk membaca, tidak wajib, tidak unlock
   - EXP Quiz: Wajib untuk unlock, berdasarkan nilai tertinggi

2. **Retake Quiz**:
   - Tidak ada batasan jumlah retake
   - Hanya nilai tertinggi yang tersimpan
   - Jika sudah lulus, status tetap lulus meskipun retake nilainya turun

3. **Unlock Tingkatan**:
   - Hanya bisa unlock dengan lulus quiz (≥75%)
   - Tingkatan dibuka secara berurutan (tidak bisa skip)

4. **Security**:
   - Semua endpoint dilindungi authentication
   - Unique constraint mencegah spam claim EXP
   - CSRF protection pada semua form
