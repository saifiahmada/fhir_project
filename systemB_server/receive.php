<?php
header('Content-Type: text/html; charset=utf-8');

// Pastikan folder data ada
$dataDir = __DIR__ . '/data';
if (!file_exists($dataDir)) {
    mkdir($dataDir, 0777, true);
}

$file = $dataDir . '/patients.json';

// Ambil data dari POST
$name = $_POST['name'] ?? '';
$nik = $_POST['nik'] ?? '';
$birthDate = $_POST['birthDate'] ?? '';
$diagnosis = $_POST['diagnosis'] ?? '';

// Buat struktur FHIR Patient
$patient = [
    "resource" => [
        "resourceType" => "Patient",
        "identifier" => [
            [
                "system" => "https://example.org/nik",
                "value" => $nik
            ]
        ],
        "name" => [
            [
                "text" => $name
            ]
        ],
        "birthDate" => $birthDate
    ]
];

// Buat struktur FHIR Observation (diagnosis)
$observation = [
    "resource" => [
        "resourceType" => "Observation",
        "status" => "final",
        "code" => [
            "coding" => [
                [
                    "system" => "http://loinc.org",
                    "code" => "00000-0",
                    "display" => "Diagnosis"
                ]
            ]
        ],
        "subject" => [
            "reference" => "Patient/$nik"
        ],
        "valueString" => $diagnosis
    ]
];

// Gabungkan dua resource dalam satu entri
$entry = [
    "Patient" => $patient,
    "Observation" => $observation
];

// Baca file JSON lama
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) {
        $data = [];
    }
} else {
    $data = [];
}

// Tambahkan entri baru
$data[] = $entry;

// Simpan kembali ke file
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

echo "✅ Data pasien berhasil disimpan dalam format FHIR JSON!";
echo "<br>";
echo '<a href="view.php">Lihat Hasil</a>';
echo "<br>";
echo '<a href="../systemA_klinik/index.html">Form Input (SystemA)</a>';
?>
