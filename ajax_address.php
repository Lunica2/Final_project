<?php
include 'config.php';

if (isset($_POST['function']) && $_POST['function'] == 'ad_address') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM address WHERE ad_address='$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);

    $response = array(
        'zipcode' => $result['ad_zipcode'],
        'telephone_ad' => $result['telephone_ad'],
        'ad_name' => $result['ad_name']
    );

    echo json_encode($response);
    exit();
}
?>
