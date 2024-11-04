<?php

require_once 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('Company ID not provided.');

$db = new DB();
$conn = $db->getConnection();

$stmt = $conn->prepare('SELECT * FROM companies WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();

?>

<?php
// Assuming you have retrieved $company from the database as shown in your code

if ($stmt->rowCount() > 0) {
    $company = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style2.css">
        <title><?php echo $company['title']; ?></title>

        <!-- Include any CSS styling you need -->
    </head>
    <body>

        <header>
            <img src="<?php echo $company['cover_image_url']; ?>" alt="Company Cover Image">
            <h1><?php echo $company['title']; ?></h1>
            <h2><?php echo $company['subtitle']; ?></h2>
        </header>

        <nav>
            <!-- Your navigation links -->
        </nav>

        <section id="about">
            <h2>About Us</h2>
            <p><?php echo $company['description']; ?></p>
        </section>

        <section id="products-services">
    <h2><?php echo ucfirst($company['category']); ?></h2>
    
    <div class="product-card">
        <h3><?php echo $company['product1_description']; ?></h3>
        <img src="<?php echo $company['product1_url']; ?>" alt="Product 1 Image">
    </div>

    <div class="product-card">
        <h3><?php echo $company['product2_description']; ?></h3>
        <img src="<?php echo $company['product2_url']; ?>" alt="Product 2 Image">
    </div>

    <div class="product-card">
        <h3><?php echo $company['product3_description']; ?></h3>
        <img src="<?php echo $company['product3_url']; ?>" alt="Product 3 Image">
    </div>
</section>

<section id="contact">
            <h2>Contact Us</h2>
            <p><?php echo $company['contact_description']; ?></p>
            <!-- Your contact form design here -->
        </section>


        <footer>
            <!-- Your footer content -->
        </footer>

    </body>
    </html>

<?php
} else {
    echo 'Info not provided';
}
?>
