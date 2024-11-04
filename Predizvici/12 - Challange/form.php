<!-- form.php -->
<!-- page2.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">
    <title>Company Information Form</title>
    <!-- Include any CSS styling you need -->
</head>
<body class="bg-site">

    <form action="process_form.php" method="post">
        <label for="cover_image_url">Url link for the cover image:</label>
        <input type="text" name="cover_image_url" required><br>

        <label for="title">Title for the page:</label>
        <input type="text" name="title" required><br>

        <label for="subtitle">Subtitle for the page:</label>
        <input type="text" name="subtitle" required><br>

        <label for="description">Short description of the company:</label>
        <textarea name="description" rows="4" required></textarea><br>

        <label for="phone">Telephone number:</label>
        <input type="tel" name="phone" required><br>

        <label for="location">Location:</label>
        <input type="text" name="location" required><br>

        <label for="category">Choose between services and products:</label>
        <select name="category" required>
            <option value="services">Services</option>
            <option value="products">Products</option>
        </select><br>

        <label for="location">Product Image 1</label>
        <input type="text" name="product1_url" required>
        <br>
        <label for="location">Description of product</label>
        <input type="text" name="product1_description" required>
        <br>
        <label for="location">Product Image 2</label>
        <input type="text" name="product2_url" required>
        <br>
        <label for="location">Description of product</label>
        <input type="text" name="product2_description" required>
        <br>
        <label for="location">Product Image 3</label>
        <input type="text" name="product3_url" required>
        <br>
        <label for="location">Description of product</label>
        <input type="text" name="product3_description" required>
        <br>
        <label for="location">Contact</label>
        <input type="text" name="contact_description" required>
        <br>
        <label for="location">Linkedin</label>
        
        <input type="text" name="linkedin_url" required>
        <br>
        <label for="location">Facebook</label>
        <input type="text" name="facebook_url" required>
        <br>
        <label for="location">Twitter</label>
        <input type="text" name="twitter_url" required>
        <br>
        <label for="location">Google+</label>
        <input type="text" name="instagram_url" required>
        <br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>
