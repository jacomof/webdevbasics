<?php

//PHP file to edit the user's "about me" page. Here the user can enter or edit a description of themselves and upload/update their profile
//picture.

require_once "header.php";

//Parametization variables for the profile picture maximum vertical and horizontal size, in pixels.
$profile_pic_max_vertical = 300;
$profile_pic_max_horizontal = 200;

if(!$loggedin) die();

echo "<div class='main'> <h3> Your profile </h3>";

/*Input processing here...*/

//Auxiliary variable to hold any errors that happened during input processing.
$error = "";

//We first retrieve the user's "about me" or description from the database, if they have one.
$description = "";

$fetch_description = execute_query("SELECT description FROM USERS WHERE username = '$user' AND description IS NOT NULL;");

if($fetch_description->num_rows){

    $description = ($fetch_description->fetch_array(MYSQLI_ASSOC))['description'];
    $description = stripslashes($description);

}



if(isset($_POST['description'])){

    //We sanitize the string for security.
    $new_description = sanitize_string($_POST['description']);

    //We replace trailing whitespaces.
    $new_description = preg_replace('/[\s\t]+$/', '', $new_description);

    //We update the description of the user in the database.
    if(strlen($new_description) > 0){

        execute_query("UPDATE USERS SET description = '$new_description' WHERE username = '$user';");
        $description = stripslashes($new_description);
    
    }

}


//Validation and transformation of posted image
if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != ""){

    $accept = false;
    $type = "";

    //First we check wether the image is from one of the accepted image types.
    switch($_FILES['profile_pic']['type']){

        case 'image/jpeg':
            $accept = true;
            $type = 'jpeg';
            break;

        case 'image/jpg':
            $accept = true;
            $type = 'jpg';
            break;

        case 'image/png':
            $accept = true;
            $type = 'png';
            break;

        case 'image/bmp':
            $accept = true;
            $type = 'bmp';
            break;

        default:
            $accept = false;

    }

    //As an extra validation we check the file size, to avoid operating on a potentially large malicious payload.
    $accept = $_FILES['profile_pic']['size'] < (1024*1024*100);

    //If validation seems fine, we proceed.
    if($accept){

        //We create a unique path for the user and move the image from its temporary location to the created path so we can operate on the image.
        $filepath = "./images/$user." . $type;
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filepath);
        
        //We use the auxiliary function load_image that we created to load the image using the correct function according to its type.
        $img = load_image($filepath, $type);

        //In case we fail at loading the file, we notify the user that his file is corrupted or was somehow not transmitted correctly.
        if(!$img){
            $error = "Uploaded image corrupted or unreadable.";
        }

        //We proceed to resize the image according to the maximum profile picture sizes we specified at the beginning of the script.
        //We conserve at all times the image aspect ratio. 
        //In case both of the images' dimensions (heigh and width) are smaller than the maximum sizes, we leave the image as is.
        $h_src = $h_dst = imagesx($img);
        $v_src = $v_dst = imagesy($img);

        if($h_src > $profile_pic_max_horizontal || $v_src > $profile_pic_max_vertical){

            if($h_src > $v_src){

                $ratio = $v_src/$h_src;
                $h_dst = $profile_pic_max_horizontal;
                $v_dst = $profile_pic_max_horizontal*$ratio;
                
            }else{

                $ratio = $h_src/$v_src;
                $v_dst = $profile_pic_max_vertical;
                $h_dst = $profile_pic_max_vertical*$ratio;
                
            }

        }



        //We create a black destination image to which we copy and resize the original image.
        $transformed_img = imagecreatetruecolor($h_dst, $v_dst);

        imagecopyresized($transformed_img, 
        $img, 
        0, 
        0, 
        0, 
        0, 
        $h_dst, 
        $v_dst, 
        $h_src, 
        $v_src);
        
        //Finally we apply a convolution to the image to soften its edges, since as we make it smaller we are downsampling it and therefore reducing
        //its quality (effects like aliasing are going to occurr in this situation).
        //imageconvolution($transformed_img, [[-1,-1, -1], [-1,16,-1], [-1,-1,-1]], 8, 0);

        //We delete the temporal image we created to process the image. 
        unlink($filepath);

        //We save the image as a jpeg image in the server, for it to be read on the show_profile function.
        imagejpeg($transformed_img, "./images/$user.jpeg", 100);

        //Finally, we free up the memory used by the images with the imagedestroy functions.
        imagedestroy($img);
        imagedestroy($transformed_img);

        

    }else $error = "Type of uploaded file's type not supported or file too large.";

}

//We show the profile of the user using the auxiliary function show_profile, which displays the user's profile picture and
show_profile($user);

//Finally, we print the form used to upload both the user's description and profile picture.
echo <<<_END
    <form enctype="multipart/form-data" action="profile.php" method="post" class="profile-input">
        <!--In case an error ocurred during file or description submission, we report it here.-->
        <div class='main error'>$error</div>
        <textarea placeholder="Write something about you!" cols='75' rows='3' name='description'>$description</textarea> <br>
        <!--We validate as much as possible on the client side by using the "accept" property in the file input element.
        This property helps the user know which files are expected by the server, but musn't be used by itself, as it can be easily
        manipulated by the user (it just tells the browser to give hints to the user as to which files are accepted).-->
        <span id="file-input-container">Profile picture: <input type="file" accept="image/jpg, image/png, image/jpeg, image/tiff, image/bmp"
        name="profile_pic" class="main">
        <input type="submit" value="Save profile" id="profile-submit-button"> </span>
        <br>
    </form>
    </div>
</body>
_END;



?>