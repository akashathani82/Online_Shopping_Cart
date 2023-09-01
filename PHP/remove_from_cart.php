<?php
session_start();

if (isset($_POST['product_id_to_remove'])) {
    $productIDToRemove = $_POST['product_id_to_remove'];

    if (isset($_SESSION['cart'][$productIDToRemove])) {
        unset($_SESSION['cart'][$productIDToRemove]);

        $response = array(
            'status' => 'success',
            'message' => 'Product removed from cart.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Product not found in the cart.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request. Product ID not provided.'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
