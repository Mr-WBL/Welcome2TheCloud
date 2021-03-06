<?php
require_once 'include/db_connection.php';
require_once 'objects/Login.php';
require_once 'objects/Product.php';



function getUserValues() {
    /**
     * Function to get the values from the form 
     * Returns: List with all elements from the form, if any fail -> element is null
     */

    $productName = NULL;
    $productPrice = NULL;
    $productDesc = NULL;
    $categoryId = NULL;
    $productImageURLImage = NULL;


	if (isset($_POST['productName'])){
		$productName = $_POST['productName'];
	}
	if (isset($_POST['productPrice'])){
		$productPrice = $_POST['productPrice'];
	}
	if (isset($_POST['productDesc'])){
		$productDesc = $_POST['productDesc'];
    }
	if (isset($_POST['categoryId'])){
		$categoryId = $_POST['categoryId'];
    }
    if (isset($_FILES['productImageURL'])){
		$productImageURLImage = $_FILES['productImageURL'];
    }
	
	return array($productName, $productPrice, $productDesc, $categoryId, $productImageURLImage);
}


function mainCreateFunction() {
    /**
     *  Main function for this page, prints out all orders and all products
     *  Returns: Null if successful, False if not logged in
     */

        /* Creates the connection to the database */
        $connection = createConnection();
        
        // Checks to see if the person is logged in and quits if they're not //
        $loggedIn = Login::checkToken($connection);
        if (!$loggedIn){
            return false;
        }
        list($productName, $productPrice, $productDesc, $categoryId, $productImageURLImage) = getUserValues();

		$success = Product::createProduct($connection, $productName, $productPrice, $productDesc, $categoryId, $productImageURLImage);
		// If the account is successfully created, log the account in
		if ($success){
            echo "Success!";
            return true;
        }
	}

$result = mainCreateFunction();
header('Location:/listprod.php');

?>