<?php 
    session_start();
    include_once "header.php"; 
    if(isset($_SESSION['unique_id'])){
        header("location: user.php");
    }
?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <!-- using enctype="multipart/form-data" because we have file input -->
            <form action="#" enctype="multipart/form-data"> 
                <div class="error-text"></div>
                <div class="name-details">
                    <!-- first name -->
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <!-- last name -->
                    <div class="field input">
                        <label for="">last Name</label>
                        <input type="text" name="lname" placeholder="last Name" required>
                    </div>
                </div>
                <div>
                    <!-- email -->
                    <div class="field input">
                        <label for="">Email Address</label>
                        <input type="text" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <!-- password -->
                    <div class="field input">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Enter Your Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <!-- Image -->
                    <div class="field image">
                        <label for="">Select Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue To Chat">
                    </div>
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login Now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>