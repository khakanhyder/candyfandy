<?php
require_once 'config.php';
$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
echo "<pre>";
// All manufacturers
$r = $conn->query("SELECT manufacturer_id, name FROM " . DB_PREFIX . "manufacturer ORDER BY name");
echo "ALL MANUFACTURERS:\n";
while ($row = $r->fetch_assoc()) echo "  [{$row['manufacturer_id']}] {$row['name']}\n";

// Autocomplete limit setting
$r2 = $conn->query("SELECT value FROM " . DB_PREFIX . "setting WHERE code='config' LIMIT 200");
echo "\nAUTOCOMPLETE LIMIT SETTING:\n";
while ($row = $r2->fetch_assoc()) {
    if (str_contains($row['value'], 'autocomplete')) echo "  " . $row['value'] . "\n";
}
$r3 = $conn->query("SELECT * FROM " . DB_PREFIX . "setting LIMIT 500");
$found = false;
while ($row = $r3->fetch_assoc()) {
    if (str_contains($row['value'] ?? '', 'autocomplete') || str_contains($row['key'] ?? '', 'autocomplete')) {
        echo "  key={$row['key']} value={$row['value']}\n";
        $found = true;
    }
}
if (!$found) echo "  (not set - will default to 20)\n";
echo "</pre>";
