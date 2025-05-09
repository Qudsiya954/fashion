<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fashion Recomendation-Home</title>
    <?php require('inc/links.php') ?>
</head>

<body>
    <?php require('inc/header.php');
    // Redirect if the user is not logged in
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    // Fix SQL query by removing single quotes around id
    $u_exist = select("SELECT * FROM `user` WHERE `sr_no`=? LIMIT 1", [$_SESSION['uId']], 's');

    if (!$u_exist || mysqli_num_rows($u_exist) == 0) {
        redirect('index.php');
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);


    ?>


    <!-- Profile Hero Section -->
    <section class="page-hero">
        <div class="hero-content">
            <h1 data-aos="fade-up">My Profile</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">Manage your personal information</p>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="section profile-section">
        <div class="container ">
            <div class="profile-container shadow" data-aos="fade-up">

                <div class="profile-header">

                    <div class="profile-avatar">
                        <form id="profile-form">
                            <img src="<?php echo USER_IMG_PATH . $u_fetch['profile']; ?>" id="profile-img" alt="Profile Picture" class="profile-image">
                            <div class="profile-avatar-edit">
                                <label for="avatar-upload" class="avatar-edit-btn">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" name="profile" accept=".jpg, .jpeg, .png, .webp" id="avatar-upload" hidden>
                            </div>
                        </form>
                    </div>
                </div>
                <form id="info-form">
                    <div class="profile-info">

                        <div class="info-group">
                            <label>Name</label>
                            <div class="info-value">
                                <input type="text" name="name" value="<?php echo $u_fetch['name']; ?>" class="form-control shadow-none" required>

                            </div>
                        </div>
                        <div class="info-group">
                            <label>Date of Birth</label>
                            <div class="info-value">
                                <input type="date" name="dob" value="<?php echo $u_fetch['dob']; ?>" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="info-group">
                            <label>Email</label>
                            <div class="info-value">
                                <input type="email" name="email" value="<?php echo $u_fetch['email']; ?>" class="form-control shadow-none" required>
                            </div>
                        </div>

                        <div class="info-group">
                            <label>Phone Number</label>
                            <div class="info-value">
                                <input type="number" name="phonenum" value="<?php echo $u_fetch['phonenum']; ?>" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="info-group">
                            <label>Gender</label>
                            <div class="info-value">
                                <input type="text" name="gender" value="<?php echo $u_fetch['gender']; ?>" class="form-control shadow-none" required>

                            </div>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn btn-custom" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>



        </div>
    </section>




    <?php require('inc/footer.php') ?>

    <script type="module" src="main.js"></script>
    <?php require('inc/scripts.php')  ?>
    <script>
        let info_form = document.getElementById('info-form');

        info_form.addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData();
            data.append('info-form', '');
            data.append('name', info_form.elements['name'].value);
            data.append('phonenum', info_form.elements['phonenum'].value);
            data.append('dob', info_form.elements['dob'].value);
            data.append('gender', info_form.elements['gender'].value);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/profile.php', true);

            xhr.onload = function() {
                let response = this.responseText.trim(); // ✅ Remove any extra spaces

                console.log("Server Response:", response); // ✅ Debugging

                if (response === 'phone_already') {
                    alert('error', 'Phone number already exists');
                } else if (response === 'error') {
                    alert('error', 'Failed to update profile');
                } else if (response === 'success') {
                    alert('success', 'Profile updated successfully');

                    setTimeout(() => {
                        location.reload(); // ✅ Corrected: Reload the page
                    }, 1000);
                } else {
                    alert('error', 'Something went wrong: ' + response);
                }
            };

            xhr.send(data);
        });



        let profile_form = document.getElementById('profile-form');
        let profile_img = document.getElementById('profile-img'); // Ensure there's an <img> with this ID

        profile_form.elements['profile'].addEventListener('change', function(e) {
            e.preventDefault();

            let fileInput = profile_form.elements['profile'];
            if (fileInput.files.length === 0) {
                alert("Please select a file to upload.");
                return;
            }

            // Preview selected image
            let reader = new FileReader();
            reader.onload = function(e) {
                profile_img.src = e.target.result; // Update profile picture preview
            };
            reader.readAsDataURL(fileInput.files[0]);

            // Upload the image
            let data = new FormData(profile_form);
            data.append('profile-form', '');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/profile.php', true);

            xhr.onload = function() {
                console.log("Response:", this.responseText); // Debugging

                if (this.responseText.trim() === 'inv_image') {
                    alert('error', "Only jpeg, jpg, webp images allowed");
                } else if (this.responseText.trim() === 'upd_failed') {
                    alert('error', "Failed to upload image");
                } else if (this.responseText.trim() === 'success') {
                    alert('success', "Profile picture updated successfully");
                    window.reload();
                } else {
                    alert('error', "Unexpected response: " + this.responseText);
                }
            };

            xhr.onerror = function() {
                alert('error', "An error occurred while uploading.");
            };

            xhr.send(data);
        });
    </script>


</body>

</html>