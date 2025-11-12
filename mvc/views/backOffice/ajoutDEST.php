<?php
session_start();

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Use correct form input names
    $name  = $_POST['placename'] ?? '';
    $price = $_POST['price'] ?? '';
    $imageName = $_FILES['image']['name'] ?? '';

    // Validate inputs
    if (!$name || !$price || !$imageName) {
        $error = "Tous les champs sont requis.";
    } else {
        // Ensure img folder exists
        $uploadDir = __DIR__ . '/img/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName)) {

            // Save new destination to session
            $_SESSION['new_destination'] = [
                'name' => $name,
                'price' => $price,
                'image' => $imageName
            ];

            // Redirect to destination page
            header('Location: destination.php');
            exit();
        } else {
            $error = "Erreur lors de l'upload de l'image.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Ajouter Destination</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Ajouter une nouvelle destination</h3>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" enctype="multipart/form-data" id="addDestinationForm">
        <div class="mb-3">
            <label>Nom de la destination</label>
            <input type="text" name="placename" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Destination</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$('#addDestinationForm').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: 'ajoutDEST.php',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response){
            alert('Destination ajoutée avec succès!');
            location.reload();
        },
        error: function(){
            alert('Destination ajoutée avec succès!');
        }
    });
});
</script>
</body>
</html>
