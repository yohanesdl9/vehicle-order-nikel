# Sistem Pemesanan Kendaraan Perusahaan Tambang

## Daftar Isi

1. [Daftar Username dan Password](#daftar-username-dan-password)
2. [Tech Stack yang Digunakan](#tech-stack-yang-digunakan)
3. [Install Composer Dependency Project](#install-composer-dependency-project)
4. [Panduan Singkat Penggunaan Aplikasi](#panduan-singkat-penggunaan-aplikasi)
   1. [Dashboard](#dashboard)
   2. [Pesan Kendaraan](#pesan-kendaraan)
   3. [Kendaraan](#kendaraan-admin-only)
   4. [Rental Kendaraan](#rental-kendaraan-admin-only)
   5. [Pegawai](#pegawai-admin-only)
   6. [Manajemen User](#manajemen-user-admin-only)
   7. [Log Aktivitas](#log-aktivitas-admin-only)

## Daftar Username dan Password

| Hak Akses         | Username     | Password     |
| ----------------- | ------------ | ------------ |
| Admin             | admin        | admin123     |
| Staf Verifikasi 1 | verificator1 | verificator1 |
| Staf Verifikasi 2 | verificator2 | verificator2 |

## Tech Stack yang Digunakan

- PHP versi 7.4.27
- CodeIgniter 3.1.11
- MySQL 10.4.22

## Install Composer Dependency Project

Karena di project ini menggunakan library dari Composer, sebelum menginstal aplikasi web ini, perhatikan hal berikut :

1. Pastikan Composer sudah terinstal di komputer Anda. Jika belum, Anda bisa mendownload Composer di link https://getcomposer.org/download dan menginstalnya.
2. Untuk menginstal semua dependencies yang ada di project ini, buka Visual Studio Code, kemudian buka folder root project ini. Buka Terminal (dengan memencet tombol Ctrl+`atau View > Terminal), dan ketikkan perintah`composer update`.

## Panduan Singkat Penggunaan Aplikasi

### Login ke Aplikasi

1. Buka halaman web. Anda akan diarahkan pertama kali ke halaman Login.
2. Masukkan username dan password sesuai yang tertera di Daftar Username dan Password. Anda dapat memberi tanda centang di bagian **Tampilkan Password** untuk menampilkan password yang sedang diketikkan.
3. Klik Login. Jika username dan password benar, maka Anda akan diarahkan langsung ke halaman Dashboard.

### Dashboard

User dapat melihat jumlah pemesanan kendaraan secara keseluruhan dan berdasarkan status approval dari staf verifikasi dan admin dalam satu bulan dan satu tahun.

Terdapat juga grafik penggunaan kendaraan dalam satu bulan dan satu tahun (kendaraan tertentu digunakan sebanyak berapa kali dalam satu bulan atau satu tahun).

### Pesan Kendaraan

Admin dapat menambahkan pemesanan kendaraan, melihat detail pemesanan kendaraan dan mengubah status approval pemesanan kendaraan yang sudah disetujui oleh staf verifikasi (verifikasi tahap kedua). Staf verifikasi dapat melihat detail pemesanan kendaraan dan mengubah status approval pemesanan kendaraan yang dibuat oleh admin (verifikasi tahap pertama).

Jika terdapat pemesanan kendaraan yang perlu ditinjau oleh admin dan staf verifikasi, akan muncul badge di samping kanan tulisan **Pesan Kendaraan** di sidebar menu untuk memberitahukan kepada user.

Admin dan staf verifikasi dapat menampilkan semua data pemesanan yang dibuat dengan berbagai filter yang tersedia :

1. Filter dan mengurutkan dari tanggal pemesanan, tanggal mulai/tanggal selesai digunakan, terurut dari tanggal pemesanan, tanggal mulai/tanggal selesai digunakan yang paling baru.
2. Filter berdasarkan periode tanggal, tanggal (data dalam sehari), atau bulan dan tahun pemesanan atau penggunaan kendaraan (bergantung dari filter yang dipilih dari poin nomor 1).
3. Filter status approval dari staf verifikasi dan admin.

Admin dapat melihat semua data pemesanan yang dibuat, sedangkan staf verifikasi hanya dapat melihat semua data pemesanan yang di-_assign_ kepada staf verifikasi yang bersangkutan untuk diverifikasi.

Laporan pemesanan kendaraan berdasarkan filter yang ditetapkan juga dapat di-export ke Excel dengan klik tombol **Ekspor ke Excel**.

#### Membuat Pemesanan Baru

Untuk membuat pemesanan baru, klik tombol **Tambah Pemesanan Baru**. Akan muncul popup berisi form dan admin harus mengisikan hal berikut :

1. Pemesan (wajib memilih karyawan yang melakukan pemesanan)
2. Driver (wajib memilih karyawan yang akan menyetir kendaraan yang dipilih)
3. Kendaraan (wajib memilih kendaraan yang digunakan)
4. Keterangan (wajib diisi, berisi keterangan untuk apa kendaraan akan digunakan)
5. Tanggal pemakaian (tanggal mulai dan tanggal selesai wajib diisi, tetapi jika kendaraan hanya dipakai satu hari, cukup mengisi tanggal mulai dan centang di checkbox **Satu Hari Pemakaian**).
6. Staf Verifikasi (wajib memilih user Staf Verifikasi yang akan melakukan verifikasi tahap pertama untuk pemesanan yang akan dibuat)

Setelah selesai mengisikan 6 hal yang disebutkan di atas, klik Simpan Data.

#### Verifikasi Tahap 1 (oleh Staf Verifikasi)

Untuk melakukan verifikasi tahap 1, staf verifikasi harus mengklik tombol berwarna biru di pemesanan yang akan diverifikasi. Akan muncul popup berisi detail pemesanan, dan staf verifikasi harus memilih untuk menyetujui atau menolak pemesanan, dan wajib mengisikan alasan pesanan ditolak. Klik Simpan Data.

#### Verifikasi Tahap 2 (oleh Admin)

Untuk melakukan verifikasi tahap 2, admin harus mengklik tombol berwarna hijau di pemesanan yang akan diverifikasi (yang sudah disetujui oleh staf verifikasi di tahap 1). Akan muncul popup berisi detail pemesanan, dan admin harus memilih untuk menyetujui atau menolak pemesanan, dan wajib mengisikan alasan pesanan ditolak. Klik Simpan Data.

### Kendaraan (Admin Only)

Admin dapat mengelola data kendaraan baik kendaraan milik perusahaan maupun kendaraan yang disewa dari perusahaan rental mobil.

Untuk menambahkan dan/atau mengubah data kendaraan, form yang harus diisi adalah sebagai berikut :

1. Merek Kendaraan (wajib diisi)
2. Model Kendaraan (wajib diisi)
3. Nomor Polisi (wajib diisi, dan tidak boleh sama dengan data kendaraan lain)
4. Nomor Rangka (opsional, tetapi jika diisi tidak boleh sama dengan data kendaraan lain)
5. Nomor Mesin (opsional, tetapi jika diisi tidak boleh sama dengan data kendaraan lain)
6. Tahun Kendaraan (wajib diisi)
7. Jenis Angkutan (pilih salah satu)
8. Tipe Kepemilikan (pilih salah satu)
9. Tempat Rental Kendaraan (wajib diisi jika tipe kepemilikan dipilih Sewa dari Rental)

#### Riwayat Konsumsi BBM

Sub-menu ini dapat diakses dengan klik tombol berwarna hijau di tabel data kendaraan. Admin dapat melihat, menambahkan dan mengubah data riwayat konsumsi BBM kendaraan dengan menambahkan tanggal pengecekan, total kilometer yang ditempuh dan konsumsi bahan bakar (dalam km/L).

#### Jadwal Service

Sub-menu ini dapat diakses dengan klik tombol berwarna biru di tabel data kendaraan. Admin dapat melihat, menambahkan dan mengubah data jadwal service kendaraan dengan mengisi tanggal, keterangan service yang dilakukan, dan lokasi service kendaraan.

### Rental Kendaraan (Admin Only)

Admin dapat mengelola data perusahaan rental kendaraan yang disewa oleh perusahaan ini.

Untuk menambahkan dan/atau mengubah data perusahaan rental kendaraan, form yang harus diisi adalah sebagai berikut :

1. Nama Perusahaan (wajib diisi)
2. Alamat (wajib diisi)
3. Telepon (wajib diisi)

### Pegawai (Admin Only)

Admin dapat mengelola data pegawai yang bekerja di perusahaan ini.

Untuk menambahkan dan/atau mengubah data pegawai, form yang harus diisi adalah sebagai berikut :

1. Nama Pegawai (wajib diisi)
2. Alamat (wajib diisi)
3. Telepon (wajib diisi)

### Manajemen User (Admin Only)

Admin dapat mengelola data user baik admin maupun staf verifikasi yang dapat menggunakan aplikasi web ini.

Untuk menambahkan dan/atau mengubah data user, form yang harus diisi adalah sebagai berikut :

1. Nama Pengguna (wajib diisi)
2. Hak Akses (pilih salah satu)
3. Username (wajib diisi dan tidak boleh sama dengan user lain)
4. Password (pada saat menambahkan data, password wajib diisi, tetapi pada saat mengubah data, password hanya diisi jika ingin mengubah password).

### Log Aktivitas (Admin Only)

Admin dapat melihat log aktivitas yang terjadi di aplikasi web (insert update dan delete data oleh siapa saja). Admin juga dapat menampilkan log aktivitas berdasarkan filter rentang tanggal tertentu, tanggal (log aktivitas dalam satu hari), serta bulan dan tahun (log aktivitas di bulan dan tahun yang dipilih)
