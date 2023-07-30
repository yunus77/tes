# tes
Dokumentasi Program Payroll BHS
https://github.com/yunus77/tes/ 

1.	Login
 
User : staff
Password : 1234567890

User : supervisor
Password : 1234567890 

2.	Tampilan Dasboard
 
Disini terdapat 3 Menu utama.
o	Menu Karyawan	: Berisi Data Master karyawan
o	Menu Absensi 	: Berisi Data Absensi Yang di IMPORT langsung dari Rest API
o	Menu Payroll 		: Berisi Laporan Perhitungan PAYROLL dan VALIDASI dari supervisor

3.	Menu Karyawan
 
User Staff dapat menambah, Mengubah dan Menghapus data Karyawan,
Berikut ini Tampilan Form Imput/Edit data Karyawan


4.	Menu Absensi
 
Menampilkan History data Absensi yg sudah pernah di IMPORT langsung dari Rest API.
Di Tombol warna Hijau akan menampil kan Form IMPORT langsung dari Rest API.
 
Setelah Memilih Tahun, Bulan dan Karyawan, Lalu Tekan Tombol Import 
Akan mengakses REST API yang sudah di siapkan. Setelah data Melalui REST API Diterima
Selanjutnya akan di Generate dan di HITUNG Hasil Presensi Data Karyawan Berdasarkan Rumus yg sudah ditentukan oleh Perusahaan, Dan dimunculkan Lengkap di Kolom seperti yg bawah ini :
 
Di Perhitungan ini juga langsung dilakukan Perhitungan GAJI juga, di saat Generate Presensi Data Karyawan 
dari REST API. Sehingga Nanti Langsung Bisa Dimunculkan dalam Report Payroll






5.	Menu Payroll
  
Menampilkan Hasil Report Gaji Karyawan Setiap Bulan, disini juga bisa di eksport SLIP GAJI berupa PDF.
Ada Juga Fitur Pengesahan Data Gaji Karyawan Oleh SUPERVISOR.
 
Supervisor tinggal Menekan tombol Centang, nanti akan langsung ter-Validasi, dan tanya Tidak akan bisa
Di ganti atau dirubah Meskipun Mengulang Langkah IMPORT langsung dari Rest API.


Terimakasih.

Gresik, 20 Juli 2023




Muhammad Yunus
