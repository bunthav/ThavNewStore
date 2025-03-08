<!-- FILE: form.php -->
<section class="form-section">
    <?php if (!empty($errors)): ?>
        <div class="error">
            <h3>Please fix these errors:</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="test.php?p=form">
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" name="full_name" required
                   value="<?= $_POST['full_name'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <div>
                <label>
                    <input type="radio" name="gender" value="Male" required
                        <?= isset($_POST['gender']) && $_POST['gender'] === 'Male' ? 'checked' : '' ?>> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female"
                        <?= isset($_POST['gender']) && $_POST['gender'] === 'Female' ? 'checked' : '' ?>> Female
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Age:</label>
            <input type="number" name="age" min="1" required
                   value="<?= $_POST['age'] ?? '' ?>">
        </div>

        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($submitted_data)): ?>
        <div class="user-info">
            <h3>Submitted Information:</h3>
            <p><strong>Name:</strong> <?= $submitted_data['full_name'] ?></p>
            <p><strong>Gender:</strong> <?= $submitted_data['gender'] ?></p>
            <p><strong>Age:</strong> <?= $submitted_data['age'] ?></p>
        </div>
    <?php endif; ?>
</section>