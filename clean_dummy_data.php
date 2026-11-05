<?php

$dbPath = __DIR__ . '/database/database.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Tables to clear (leaving users and migrations intact)
$tablesToClear = [
    'articles',
    'events',
    'galleries',
    'aspirations',
    'youth_members',
    'finance_transactions',
    'inventory_items',
    'hall_of_fames',
    'activity_logs',
    'businesses',
];

echo "=== MENGOSONGKAN DATA DUMMY (MENYIMPAN AKUN LOGIN ADMIN) ===\n\n";

foreach ($tablesToClear as $table) {
    try {
        $pdo->exec("DELETE FROM {$table}");
        // Reset auto increment sequence
        $pdo->exec("DELETE FROM sqlite_sequence WHERE name='{$table}'");
        echo "[BERSIH] Tabel '{$table}' berhasil dikosongkan.\n";
    } catch (\Exception $e) {
        echo "[SKIP] Tabel '{$table}': " . $e->getMessage() . "\n";
    }
}

// Vacuum database to shrink file size
$pdo->exec("VACUUM");

echo "\n=== DAFTAR AKUN ADMIN YANG TETAP AMAN TERSIMPAN: ===\n";
$stmt = $pdo->query("SELECT id, name, email, role FROM users");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Nama: {$row['name']} | Email: {$row['email']} | Role: {$row['role']}\n";
}

echo "\nSelesai! Seluruh data dummy telah bersih, akun login tetap utuh 100%.\n";
