
# TEST CASES - KURSUSKU

## Pengujian Aplikasi KursusKu
Fitur: Create dan Read Data Kursus
Database: MySQL
Framework: Laravel

### TC-01: Menambahkan Data Kursus
- Tujuan: Memastikan data kursus berhasil ditambahkan.
- Langkah: Mengisi seluruh formulir dengan data yang benar.
- Hasil yang diharapkan: Data berhasil disimpan dan muncul di halaman Daftar Kursus.
- Status: Berhasil.

### TC-02: Kode Kursus Kosong
- Tujuan: Menguji validasi kode kursus.
- Langkah: Mengosongkan kolom kode kursus lalu menyimpan formulir.
- Hasil yang diharapkan: Sistem menampilkan pesan kesalahan.
- Status: Berhasil jika pesan kesalahan muncul.

### TC-03: Kode Kursus Duplikat
- Tujuan: Memastikan kode kursus tidak boleh sama.
- Langkah: Memasukkan kode WEB-101 yang sudah digunakan.
- Hasil yang diharapkan: Sistem menolak kode yang duplikat.
- Status: Berhasil jika pesan kesalahan muncul.

### TC-04: Nama Kursus Kosong
- Tujuan: Menguji validasi nama kursus.
- Langkah: Mengosongkan nama kursus lalu menyimpan formulir.
- Hasil yang diharapkan: Sistem menampilkan pesan kesalahan.
- Status: Belum diuji.

### TC-05: Biaya Bernilai Negatif
- Tujuan: Memastikan biaya tidak boleh negatif.
- Langkah: Memasukkan biaya -1000.
- Hasil yang diharapkan: Sistem menolak nilai biaya tersebut.
- Status: Belum diuji.

### TC-06: Kuota Bernilai Nol
- Tujuan: Memastikan kuota minimal 1 peserta.
- Langkah: Memasukkan kuota 0.
- Hasil yang diharapkan: Sistem menampilkan pesan kesalahan.
- Status: Belum diuji.

### TC-07: Status Tidak Valid
- Tujuan: Memastikan status sesuai pilihan yang tersedia.
- Langkah: Mengirim status selain draft, open, atau closed.
- Hasil yang diharapkan: Sistem menolak status tersebut.
- Status: Belum diuji.

### TC-08: Melihat Data Kursus
- Tujuan: Memastikan data kursus ditampilkan.
- Langkah: Membuka halaman /courses.
- Hasil yang diharapkan: Minimal 8 data kursus tampil.
- Status: Berhasil jika 8 data muncul.
