<!-- FILE: index.php -->
<?php
// Handle form submission
$errors = [];
$submitted_data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    if (empty($_POST['full_name'])) {
        $errors[] = "Full name is required";
    }
    if (empty($_POST['gender'])) {
        $errors[] = "Gender is required";
    }
    if (empty($_POST['age']) || !is_numeric($_POST['age'])) {
        $errors[] = "Valid age is required";
    }

    // Store if no errors
    if (empty($errors)) {
        $submitted_data = [
            'full_name' => htmlspecialchars($_POST['full_name']),
            'gender' => htmlspecialchars($_POST['gender']),
            'age' => (int)$_POST['age']
        ];
    }
}

// Include header
include 'header.php';
?>

<main>
    <?php
    // Page routing
    $page = $_GET['p'] ?? '';
    
    if ($page === 'form') {
        include 'form.php';
    } else {
        echo '<h2>Hello! Welcome to User Registration!</h2>';
        echo '<p>Navigate to the form using the menu above</p>';
    }
    ?>
</main>

<?php include 'footer.php'; ?>