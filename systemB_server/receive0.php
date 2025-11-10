<?php
// Header agar bisa menerima request dari browser
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

// Pastikan method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    // Validasi sederhana
    if ($data && isset($data['resourceType']) && $data['resourceType'] === 'Patient') {
        $filename = __DIR__ . "/data/patients.json";

        // Jika file belum ada, buat array kosong
        if (!file_exists($filename)) {
            file_put_contents($filename, json_encode([]));
        }

        // Ambil data lama dan tambahkan data baru
        $patients = json_decode(file_get_contents($filename), true);
        $patients[] = $data;

        // Simpan kembali
        file_put_contents($filename, json_encode($patients, JSON_PRETTY_PRINT));

        echo "✅ Data pasien berhasil disimpan dalam format FHIR JSON!";
    } else {
        echo "❌ Data tidak valid. Pastikan format FHIR benar.";
    }
} else {
    echo "Gunakan metode POST untuk mengirim data pasien.";
}
?>