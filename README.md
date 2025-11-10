## 📘 **README.md**

```markdown
# 🧩 FHIR PROJECT: System A (Client) ↔ System B (Server)

Proyek ini adalah simulasi **pertukaran data pasien dalam format FHIR (Fast Healthcare Interoperability Resources)** antara dua sistem:
- **System A (Client):** Aplikasi yang mengirim data pasien ke server.
- **System B (Server):** Aplikasi penerima yang menyimpan dan menampilkan data pasien.

---

## 🏗️ Struktur Folder

```

📦 fhir_project_
├── systemA_klinik/
│   ├── index.html          # Form input data pasien
│   
│
├── systemB_server/
│   ├── receive.php         # Endpoint untuk menerima dan menyimpan data JSON
│   ├── view.php            # Menampilkan data pasien dari file JSON
│   └── patients.json       # File penyimpanan data dalam format FHIR
│
└── README.md               # Dokumentasi proyek

```

---

## ⚙️ Cara Menjalankan

### 1️⃣ Persiapan
1. Install **XAMPP** (atau web server lain yang mendukung PHP).
2. Pastikan Apache sudah berjalan.
3. Letakkan folder proyek di dalam:
```

C:\xampp\htdocs\fhir_project

```
atau di `/opt/lampp/htdocs/fhir_project` jika kamu pakai Linux.

---

### 2️⃣ Jalankan System A (Client)
1. Buka browser dan akses:
```

[http://localhost/fhir_project/systemA_klinik/index.html](http://localhost/fhir_project/systemA_klinik/index.html)

```
2. Isi data pasien (Nama, NIK, Tanggal Lahir, dan Diagnosis).
3. Klik tombol **Kirim ke FHIR Server**.

---

### 3️⃣ Jalankan System B (Server)
1. Setelah data dikirim, browser akan menampilkan pesan:
```

✅ Data pasien berhasil disimpan dalam format FHIR JSON!

```
dan tombol:
```

[ Lihat Hasil ]   [ Kembali ke Form ]

```
2. Klik **View Hasil** untuk membuka:
```

[http://localhost/fhir_project/systemB_server/view.php](http://localhost/fhir_project/systemB_server/view.php)

````
3. Data pasien yang dikirim akan tampil dalam format JSON atau tabel (tergantung implementasi `view.php`).

---

## 📂 Format Data FHIR (Simplified JSON)

Berikut contoh struktur JSON yang dikirim dari System A ke System B:

```json
{
 "Patient": {
     "resource": {
         "resourceType": "Patient",
         "identifier": [
             {
                 "system": "https://example.org/nik",
                 "value": "1234567890"
             }
         ],
         "name": [
             {
                 "text": "John Doe"
             }
         ],
         "birthDate": "1985-01-01"
     }
 },
 "Observation": {
     "resource": {
         "resourceType": "Observation",
         "status": "final",
         "code": {
             "coding": [
                 {
                     "system": "http://loinc.org",
                     "code": "00000-0",
                     "display": "Diagnosis"
                 }
             ]
         },
         "subject": {
             "reference": "Patient/1234567890"
         },
         "valueString": "Hypertension"
     }
 }
}
````

---

## 🧠 Tujuan Pembelajaran

Proyek ini membantu memahami konsep:

* Struktur **FHIR Resource** seperti `Patient` dan `Observation`.
* Pertukaran data antar sistem (Client–Server).
* Implementasi interoperabilitas sederhana menggunakan PHP dan JavaScript.

---

## 💡 Catatan Tambahan

* File `patients.json` akan otomatis dibuat saat data pertama dikirim.
* Pastikan izin tulis (`write permission`) aktif pada folder `systemB_server`.
* Dapat dikembangkan menjadi sistem REST API dengan autentikasi dan validasi FHIR yang lebih lengkap.

---

## 👨‍💻 Developer

**Nama:** Saifi Ahmada
**Project:** Simulasi Pertukaran Data FHIR
**Tools:** PHP, HTML, JavaScript, JSON
**Versi:** 1.0.0

```

---

Mau saya tambahkan juga **contoh tampilan screenshot (mockup)** ke dalam README biar makin keren di GitHub, sob?  
Kalau iya, kirim aja hasil tangkapan layar dari:
- halaman `index.html`
- halaman sukses kirim  
- halaman `view.php`

Nanti saya bantu masukkan ke README dengan format gambar markdown.
```
