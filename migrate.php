<?php
require_once 'config/db.php';

try {
    // Read the migration file
    $sql = file_get_contents('sql/clothing_migration.sql');

    // Execute the SQL statements
    $pdo->exec($sql);

    echo "✅ Migration completed successfully!<br>";
    echo "Database has been updated with clothing products.<br>";
    echo "<a href='index.php'>Go to Home Page</a>";

} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage();
}
?>