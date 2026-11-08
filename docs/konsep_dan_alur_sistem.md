File `docs/konsep_dan_alur_sistem.md` berfungsi sebagai **dokumentasi arsitektur sistem** dan **panduan teknis (contekan wawancara)** kamu saat sesi *Tanya Jawab* dan *Live Coding*.

Berikut struktur dan isi lengkap yang bisa langsung kamu salin ke dalam file `docs/konsep_dan_alur_sistem.md`:

```markdown
# Dokumentasi Konsep, Arsitektur & Alur Sistem Manajemen Aset Rumah Sakit

Dokumen ini memuat ringkasan arsitektur sistem, skema relasi database, logika bisnis rumah sakit, dan panduan teknis implementasi untuk aplikasi Sistem Manajemen Aset Rumah Sakit.

---

## 1. Latar Belakang & Masalah Riil Fasilitas Kesehatan
Di fasilitas kesehatan seperti rumah sakit:
1. **Mobilitas Alat Medis Sangat Tinggi:** Alat medis kritis (seperti *Syringe Pump*, *Ventilator*, *Defibrillator*) sering dipindahkan dari IGD ke ICU atau bangsal perawatan. Tanpa pencatatan mutasi yang ketat, alat sering hilang atau sulit dilacak saat keadaan darurat.
2. **Kepatuhan Kalibrasi & Standar Akreditasi:** Alat elektromedis wajib menjalani kalibrasi berkala agar akurasi dan keamanannya terjamin. Keterlambatan kalibrasi berisiko membahayakan pasien dan melanggar audit rumah sakit.
3. **Pencatatan Aset Berkelanjutan:** Pihak logistik rumah sakit membutuhkan pelacakan status (tersedia, digunakan, perbaikan, afkir), nilai depresiasi/perolehan, serta masa garansi vendor.

---

## 2. Arsitektur Database & Relasi Relasional

Sistem menggunakan skema relasional yang ternormalisasi untuk menghindari duplikasi data dan anomali pembaruan.

### A. Tabel Master Data
* **`categories`**: Klasifikasi aset (`id`, `name`, `code`, `description`). Contoh: Alat Medis Kritis (`MED`), Bed Pasien (`FUR`), Elektronik (`ELE`).
* **`rooms`**: Data fisik lokasi ruangan (`id`, `name`, `code`, `floor`, `pic_name`). Contoh: Ruang IGD (`R-IGD-01`), ICU, OK-01.
* **`vendors`**: Data rekanan penyedia/distributor alat kesehatan (`id`, `name`, `contact_person`, `phone`, `email`, `address`).

### B. Tabel Utama (Core Entity)
* **`assets`**: Entitas utama alat/barang rumah sakit.
  * `asset_code`: Pengenal unik (unik untuk QR/Barcode).
  * `category_id`, `current_room_id`, `vendor_id`: Relasi foreign key.
  * `serial_number`, `brand`, `purchase_date`, `purchase_price`, `warranty_expiry`.
  * `condition`: `baik`, `rusak_ringan`, `rusak_berat`.
  * `status`: `tersedia`, `sedang_digunakan`, `dalam_perbaikan`, `afkir`.
  * `indexes`: Pengindeksan pada kolom `name`, `status`, `condition`, serta composite index `(category_id, current_room_id)` untuk optimasi query pencarian Livewire.

### C. Tabel Transaksional (Nilai Inovasi)
* **`asset_transfers`**: Rekam jejak mutasi alat antar-ruang (`asset_id`, `from_room_id`, `to_room_id`, `transfer_date`, `transferred_by`, `notes`).
* **`maintenance_logs`**: Log pemeliharaan & kalibrasi berkala (`asset_id`, `maintenance_type`, `action_date`, `next_maintenance_date`, `cost`, `technician_name`, `status`, `description`).

---

## 3. Alur Kerja Logika Bisnis (Business Flow)

### 1. Siklus Pengadaan & Input Aset Baru (Create)
* Petugas memasukkan data aset via modal/form Livewire (pilihan Kategori, Lokasi Awal, Vendor, No Seri, dsb).
* Sistem memvalidasi data dan otomatis membuat kode aset (`asset_code`) unik.
* Kode aset ini menjadi rujukan untuk label QR Code fisik barang.

### 2. Monitoring & Operasional Harian (Read & Search)
* Dasbor menampilkan daftar aset dengan pembagian halaman (pagination) instan.
* Pencarian real-time menggunakan mekanisme `debounce` Livewire sehingga tidak membebani server saat petugas mengetik.
* Filter multi-kriteria (berdasarkan Ruangan, Kategori, Status) bekerja secara reaktif tanpa me-reload browser.

### 3. Pemindahan Ruangan (Mutasi Alat)
* Saat alat medis dipinjam atau dipindahkan ke ruangan lain:
  1. `current_room_id` pada tabel `assets` diperbarui ke ruangan target.
  2. Sistem secara otomatis mencatat baris baru di tabel `asset_transfers` mencakup lokasi lama, lokasi baru, nama perawat/staf pemindah, dan stempel waktu.

### 4. Siklus Pemeliharaan & Kalibrasi (Maintenance)
* Teknisi elektromedis atau vendor mencatat tindakan servis/kalibrasi di `maintenance_logs`.
* Sistem mencatat tanggal kalibrasi berikutnya (`next_maintenance_date`).
* Pada dasbor, sistem menampilkan indikator peringatan alat yang mendekati jatuh tempo kalibrasi.

---

## 4. Aspek Teknis & Optimasi Kode (Laravel + Livewire)

1. **Pencegahan N+1 Query Problem:**
   Pengambilan data pada tabel dasbor selalu memakai *Eager Loading*:
   ```php
   Asset::with(['category', 'room', 'vendor'])->latest()->paginate(10);

```

2. **Reaktivitas Tanpa Beban Berlebih:**
* Penggunaan `wire:model.live.debounce.300ms="search"` untuk menunda request pencarian sampai pengetikan berhenti sejenak.
* Trait `WithPagination` untuk navigasi halaman tabel dinamis tanpa me-reload seluruh DOM.


3. **Database Indexing:**
Penambahan indeks pada kolom `status`, `condition`, `next_maintenance_date`, dan pencarian teks untuk menjaga query tetap cepat ketika volume data bertambah.

---

## 5. Ringkasan Poin Tanya Jawab (Interview Cheat Sheet)

* **Kenapa tidak menyimpan riwayat mutasi langsung di tabel assets?**
* *Jawaban:* Jika hanya menyimpan di tabel `assets`, kita hanya tahu lokasi saat ini, tetapi kehilangan riwayat (siapa yang memindahkan dan kapan dipindahkan). Tabel `asset_transfers` menjamin akuntabilitas audit rumah sakit.


* **Mengapa menambahkan modul kalibrasi/maintenance?**
* *Jawaban:* Rumah sakit memiliki regulasi ketat mengenai kelayakan alat medis. Fitur jadwal dan log kalibrasi membantu menjamin keselamatan pasien dan kesiapan akreditasi fasilitas kesehatan.


* **Bagaimana memastikan performa aplikasi tetap cepat di Livewire?**
* *Jawaban:* Menerapkan Eager Loading (`with()`), membatasi query dengan pagination, menambahkan debouncing pada pencarian, serta memberi indeks database pada kolom filter.



```

---