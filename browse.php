<?php



if (isset($_GET['username'])):

?>
<?php
include 'backend/config.php';
$username = $_GET['username'];
$sql = 'SELECT * FROM MENT WHERE mentor = ?';

$stmt= $conn->prepare($sql);
$stmt->execute([$username]);
$count = $stmt->rowcount();
if ($count == 0 ){
    echo
    '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>null</title>
    </head>
    <body>
        <h1>NO MENTEE FOUND FOR THIS USER</h1>
    </body>
    </html>
    ';
    exit();
}

?>
<?php
if ($count > 0):
?>
<?php
while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
echo $row->firstname;
}
?>

<?php endif; ?>
<?php endif; ?>