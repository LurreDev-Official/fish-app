Berikut adalah **rancangan aplikasi Pengelolaan Kolam Ikan** yang komprehensif dan siap dijadikan referensi sistem informasi budidaya ikan — mulai dari kebutuhan fungsional, diagram data, struktur database, alur proses, sampai fitur laporan keuntungan.

---

## **1. Tujuan Aplikasi**

Aplikasi ini dirancang untuk membantu **peternak/pengelola kolam ikan** dalam:

* Mencatat data kolam, pakan, pembelian pakan, penggunaan pakan.
* Mengelola stok pakan di kolam.
* Melacak produksi ikan, penjualan dan pendapatan.
* Menghitung biaya operasional dan keuntungan.
* Menyediakan laporan dan grafik untuk analisis performa.

---

## **2. Kebutuhan Pengguna (User Requirements)**

### **2.1 Pengguna Utama**

1. **Admin**

   * Mengelola master data (Kolam, Pakan, Supplier, Pengguna).
   * Melihat laporan keuntungan.
2. **Pengelola Kolam**

   * Input pemakaian pakan per kolam.
   * Input data hasil panen / penjualan.
3. **Manajer Keuangan**

   * Melihat rekap transaksi dan laporan laba/rugi.

---

## **3. Kebutuhan Fungsional**

| No  | Fitur              | Deskripsi                                  |
| --- | ------------------ | ------------------------------------------ |
| F1  | Autentikasi        | Login, logout, reset password              |
| F2  | Master Kolam       | CRUD data kolam, kapasitas, lokasi         |
| F3  | Master Pakan       | CRUD data pakan termasuk kategori & satuan |
| F4  | Supplier Pakan     | CRUD data supplier                         |
| F5  | Pembelian Pakan    | Catat pembelian pakan dari supplier        |
| F6  | Penggunaan Pakan   | Input konsumsi pakan per kolam             |
| F7  | Stok Pakan         | Lihat sisa stok pakan masing‑masing kolam  |
| F8  | Produksi Ikan      | Input berat panen dan jumlah ikan          |
| F9  | Penjualan Ikan     | Input transaksi penjualan                  |
| F10 | Transaksi Keuangan | Lihat pemasukan & pengeluaran              |
| F11 | Laporan Keuangan   | Laba/rugi, grafik bulanan, FCR             |
| F12 | Notifikasi         | Alert stok pakan rendah                    |

---

## **4. Kebutuhan Non‑Fungsional**

* Responsif (PC & ponsel)
* Performa cepat walau ribuan data
* Backup & restore database
* Multi pengguna bersamaan
* Keamanan role‑based access

---

## **5. Diagram Arsitektur (Logical)**

```
USER
  |
  v
Web / Mobile UI
  |
  v
Controller (Laravel Filament API)
  |
  v
Service Layer / Validation
  |
  v
Database (MySQL / PostgreSQL)
```

---

## **6. Diagram Relasi Entitas (ERD)**

```
Users ──< Kolam
        ──< PembelianPakan
        ──< PenggunaanPakan
        ──< PenjualanIkan
        ──< TransaksiKeuangan

Supplier ──< PembelianPakan

Pakan ──< PembelianPakan
      ──< PenggunaanPakan

Kolam ──< PenggunaanPakan
```

---

## **7. Struktur Database (Tabel & Kolom)**

### **7.1 Tabel users**

| Field      | Tipe     | Keterangan              |
| ---------- | -------- | ----------------------- |
| id         | PK       | Primary key             |
| name       | String   | Nama user               |
| email      | String   | Email login             |
| password   | String   | Password                |
| role       | Enum     | admin/manager/pengelola |
| created_at | datetime |                         |
| updated_at | datetime |                         |

---

### **7.2 Tabel kolams**

| Field          | Tipe     | Keterangan     |
| -------------- | -------- | -------------- |
| kolam_id       | PK       |                |
| nama_kolam     | VARCHAR  | Nama kolam     |
| jenis_ikan     | VARCHAR  | Jenis ikan     |
| kapasitas      | INT      | Kapasitas ikan |
| lokasi         | VARCHAR  | Lokasi kolam   |
| tanggal_dibuat | datetime | Tanggal dibuat |
| created_at     | datetime |                |
| updated_at     | datetime |                |

---

### **7.3 Tabel pakan**

| Field        | Tipe     | Keterangan     |
| ------------ | -------- | -------------- |
| pakan_id     | PK       |                |
| nama_pakan   | VARCHAR  | Nama pakan     |
| kategori     | VARCHAR  | Pelet/Alami    |
| satuan       | VARCHAR  | kg, liter, pcs |
| harga_per_kg | DECIMAL  | Harga          |
| created_at   | datetime |                |

---

### **7.4 Tabel supplier**

| Field         | Tipe     | Keterangan    |
| ------------- | -------- | ------------- |
| supplier_id   | PK       |               |
| nama_supplier | VARCHAR  | Nama supplier |
| kontak        | VARCHAR  | Telp/email    |
| alamat        | TEXT     | Alamat        |
| created_at    | datetime |               |

---

### **7.5 Tabel pembelian_pakan**

| Field             | Tipe     | Keterangan        |
| ----------------- | -------- | ----------------- |
| pembelian_id      | PK       | Key               |
| pakan_id          | FK       | ke tabel pakan    |
| supplier_id       | FK       | ke tabel supplier |
| jumlah            | INT      | Jumlah pakan      |
| harga_satuan      | DECIMAL  | Harga per satuan  |
| total_harga       | DECIMAL  | jumlah * harga    |
| tanggal_pembelian | datetime |                   |
| user_id           | FK       | yang input        |
| created_at        | datetime |                   |

---

### **7.6 Tabel penggunaan_pakan**

| Field         | Tipe     | Keterangan     |
| ------------- | -------- | -------------- |
| penggunaan_id | PK       |                |
| pakan_id      | FK       | ke tabel pakan |
| kolam_id      | FK       | ke tabel kolam |
| jumlah        | DECIMAL  |                |
| tanggal       | datetime |                |
| user_id       | FK       |                |
| created_at    | datetime |                |

---

### **7.7 Tabel stok_pakan**

Digunakan untuk memantau stok pakan tersisa.

| Field       | Tipe     | Keterangan      |
| ----------- | -------- | --------------- |
| stok_id     | PK       |                 |
| pakan_id    | FK       |                 |
| kolam_id    | FK       |                 |
| stok_awal   | DECIMAL  | Dari pembelian  |
| stok_keluar | DECIMAL  | Dari penggunaan |
| stok_sisa   | DECIMAL  | dihitung        |
| updated_at  | datetime |                 |

> Stok sisa bisa dihitung otomatis menggunakan trigger atau query.

---

### **7.8 Tabel penjualan_ikan**

| Field        | Tipe     | Keterangan |
| ------------ | -------- | ---------- |
| penjualan_id | PK       |            |
| kolam_id     | FK       |            |
| berat_ikan   | DECIMAL  | Kg         |
| jumlah_ikan  | INT      |            |
| harga_total  | DECIMAL  |            |
| tanggal_jual | datetime |            |
| user_id      | FK       |            |
| created_at   | datetime |            |

---

### **7.9 Tabel transaksi_keuangan**

| Field        | Tipe     | Keterangan             |
| ------------ | -------- | ---------------------- |
| transaksi_id | PK       |                        |
| jenis        | ENUM     | pemasukan/pengeluaran  |
| nominal      | DECIMAL  |                        |
| keterangan   | TEXT     |                        |
| ref_id       | INT      | id penjualan/pembelian |
| tanggal      | datetime |                        |
| user_id      | FK       |                        |
| created_at   | datetime |                        |

---

### **7.10 Tabel FCR (Feed Conversion Ratio)**

| Field           | Tipe     | Keterangan                                   |
| --------------- | -------- | -------------------------------------------- |
| fcr_id          | PK       |                                              |
| kolam_id        | FK       |                                              |
| pakan_digunakan | DECIMAL  | total pakan                                  |
| berat_awal      | DECIMAL  |                                              |
| berat_akhir     | DECIMAL  |                                              |
| fcr             | DECIMAL  | pakan_digunakan / (berat_akhir - berat_awal) |
| tanggal         | datetime |                                              |
| created_at      | datetime |                                              |

---

## **8. Proses Bisnis Utama (Workflows)**

---

### **8.1 Pembelian Pakan**

1. Admin memilih supplier.
2. Input jenis pakan, jumlah, harga satuan.
3. Simpan → stok pakan otomatis bertambah.
4. Transaksi pembelian tercatat.

---

### **8.2 Penggunaan Pakan**

1. User pilih kolam & pakan.
2. Input jumlah pakai.
3. Stok pakan berkurang.
4. Penggunaan tercatat dengan tanggal.

---

### **8.3 Penjualan Ikan**

1. Input berat & jumlah ikan dari kolam.
2. Hitung pendapatan berdasarkan harga jual.
3. Catat transaksi penjualan.

---

### **8.4 Perhitungan Keuntungan**

Laba = **Pendapatan Penjualan Ikan** − **Total Pembelian Pakan** − **Biaya Operasional Lain**

Laporan bisa ditampilkan:

* Bulanan
* Per kolam
* Per jenis ikan

---

## **9. Laporan yang Harus Ada**

| Laporan                | Keterangan                      |
| ---------------------- | ------------------------------- |
| Laba Rugi              | Total pendapatan vs pengeluaran |
| Grafik Pembelian Pakan | 30 hari, 12 bulan               |
| Grafik Penjualan Ikan  | Bulanan                         |
| Laporan Stok Pakan     | Peringatan stok kritis          |
| FCR per Kolam          | Efisiensi pakan                 |

---

## **10. Detail Menu UI (Contoh)**

### Sidebar Navigation (Filament)

```
Collections
  - Post (badge: total)
  - Pakan (badge: total)
  - Supplier
Kolam
  - Kolam
  - Stok Pakan
Transaksi
  - Pembelian Pakan
  - Penggunaan Pakan
  - Penjualan Ikan
Laporan
  - Keuangan
  - Laporan FCR
  - Stok (grafik/alert)
```

---

## **11. Business Rules / Validations**

* Jumlah penggunaan pakan ≤ stok
* Harga jual harus ≥ harga beli
* Penjualan hanya kolam yang ada
* Hanya admin/manajer yang bisa hapus data

---

## **12. Menu Lain Opsional**

* Multi‑cabang
* Multi‑user dengan role dan permission granular
* Export Excel/PDF laporan
* Import data pakan/kolam

---

## **13. Teknologi Rekomendasi**

| Lapisan  | Teknologi             |
| -------- | --------------------- |
| Backend  | Laravel (Filament)    |
| Database | MySQL / PostgreSQL    |
| Frontend | Filament/Admin UI     |
| Charts   | Chart.js / ApexCharts |

---

## **14. Contoh Query untuk Laba/Rugi**

```sql
SELECT 
  SUM(CASE WHEN jenis='pemasukan' THEN nominal ELSE 0 END) AS total_pemasukan,
  SUM(CASE WHEN jenis='pengeluaran' THEN nominal ELSE 0 END) AS total_pengeluaran
FROM transaksi_keuangan
WHERE tanggal BETWEEN '2025-01-01' AND '2025-01-31';
```

---

Jika kamu ingin, saya bisa buatkan:

* **Skema Migration Laravel** lengkap
* **Diagram ERD visual (text/ASCII/Grafik)**
* **Blueprint API / Filament Resources**
  Cukup beri tahu modul mana yang mau dibuat dulu.
