<?php
// Path ke file JSON
$file = __DIR__ . '/data/patients.json';

// Cek apakah file ada dan bisa dibaca
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
} else {
    $data = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pasien (FHIR Server)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        pre {
            background: #efefef;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .json-block {
            margin-top: 20px;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
        }
        a.button {
            display: inline-block;
            margin-bottom: 10px;
            background: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }
        a.button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<h2>Daftar Pasien - FHIR Server</h2>
<a href="../systemA_klinik/index.html" class="button">Form Input (System A)</a>

<?php if (empty($data)): ?>
    <p><em>Tidak ada data pasien tersimpan.</em></p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Diagnosis</th>
                <th>FHIR JSON</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $entry): ?>
                <?php 
                    $patient = $entry['Patient']['resource'] ?? [];
                    $obs = $entry['Observation']['resource'] ?? [];
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($patient['name'][0]['text'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($patient['identifier'][0]['value'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($patient['birthDate'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($obs['valueString'] ?? '-') ?></td>
                    <td>
                        <details>
                            <summary>Lihat JSON</summary>
                            <pre><?= json_encode($entry, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></pre>
                        </details>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
