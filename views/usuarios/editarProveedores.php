<?php
require '../../includes/conexionBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdProveedor = $_POST['IdProveedor'];
    $sql = "SELECT * FROM tblproveedores WHERE IdProveedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $IdProveedor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
}
?>
