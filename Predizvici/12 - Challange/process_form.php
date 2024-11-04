<?php
// process_form.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once 'db.php';

    // Retrieve form data
$coverImageUrl = $_POST['cover_image_url'];
$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$category = $_POST['category'];

$product1_url = $_POST['product1_url'];
$product1_description = $_POST['product1_description'];
$product2_url = $_POST['product2_url'];
$product2_description = $_POST['product2_description'];
$product3_url = $_POST['product3_url'];
$product3_description = $_POST['product3_description'];
$contact_description = $_POST['contact_description'];
$linkedin_url = $_POST['linkedin_url'];
$facebook_url = $_POST['facebook_url'];
$twitter_url = $_POST['twitter_url'];
$instagram_url = $_POST['instagram_url'];


    try {
        // Create a new database connection
        $db = new DB();
        $conn = $db->getConnection();

        // Prepare and execute the SQL query to insert data into the database
        $stmt = $conn->prepare("INSERT INTO companies (cover_image_url, title, subtitle, description, phone, location, category, product1_url, product1_description, product2_url, product2_description, product3_url, product3_description, contact_description, linkedin_url, facebook_url, twitter_url, instagram_url) VALUES (:coverImageUrl, :title, :subtitle, :description, :phone, :location, :category, :product1Url, :product1Description, :product2Url, :product2Description, :product3Url, :product3Description, :contactDescription, :linkedinUrl, :facebookUrl, :twitterUrl, :instagramUrl)");

        $stmt->bindParam(':coverImageUrl', $coverImageUrl);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':subtitle', $subtitle);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':location', $location);
$stmt->bindParam(':category', $category);

$stmt->bindParam(':product1Url', $product1_url); // Corrected
$stmt->bindParam(':product1Description', $product1_description); // Corrected
$stmt->bindParam(':product2Url', $product2_url); // Corrected
$stmt->bindParam(':product2Description', $product2_description); // Corrected
$stmt->bindParam(':product3Url', $product3_url); // Corrected
$stmt->bindParam(':product3Description', $product3_description); // Corrected
$stmt->bindParam(':contactDescription', $contact_description);
$stmt->bindParam(':linkedinUrl', $linkedin_url);
$stmt->bindParam(':facebookUrl', $facebook_url);
$stmt->bindParam(':twitterUrl', $twitter_url);
$stmt->bindParam(':instagramUrl', $instagram_url);


        

        // Execute the query
        $stmt->execute();

        // Get the ID of the newly inserted record
        $newCompanyId = $conn->lastInsertId();

        // Redirect the user to company.php with the new company's ID
        header("Location: company.php?id=$newCompanyId");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    // If the form was not submitted via POST method, redirect to the home page or display an error message
    header("Location: index.php");
    exit();
}
?>
