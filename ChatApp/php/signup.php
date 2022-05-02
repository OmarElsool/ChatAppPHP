<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0 ){ // that's mean email already exist 
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){ // $_FILES return array of [file name, file type , error , file size , tmp_name]
                    $img_name = $_FILES['image']['name'];
                    $img_tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); // get the extension like jpg png
                    $extensions = ['png','jpeg','jpg'];

                    if(in_array($img_ext, $extensions) === true){

                        $time = time(); // every img have unique name so we need the time the img uploaded in

                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($img_tmp_name, "images/".$new_img_name)){ // if user uploaded img moved to our folder successfully
                            $status = "Active now";
                            $random_id = rand(time(), 1000000);

                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ('{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                            if($sql2){  // if data inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0 ){
                                    $row = mysqli_fetch_assoc($sql3); // get all the data with this email
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            }else{
                                echo "Something Went Wrong!!";
                            }
                        }
    
                    }else{
                        echo "Please Select an img with extension jpg-jpeg-png";
                    }
                }else{
                    echo "Please select an image file!";
                }
            }
        }else{
            echo "$email - This email is not valid!";
        }
    }else{
        echo "All input field are required!";
    }
?>