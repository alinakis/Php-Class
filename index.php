<?php
    require_once ("include/config.php");
    require_once ("func/func_database.php");

    $message = false;

    $database = new Database($host, $user, $pass, $db);
    
    if (isset($_POST['subscribe'])) {
        $name_users = $_POST['name_users'];
        $surname_users = $_POST['surname_users'];
        $email_users = $_POST['email_users'];
        $password_users = $_POST['password_users'];
        $mobile_users = $_POST['mobile_users'];
       

        $database->connect();

        $query = "INSERT INTO 00_users (name_users, surname_users, email_users, password_users, mobile_users) VALUES (?, ?, ?, ?, ?)";

        if (!($stmt = $database->mysqli->prepare($query))) {
			die("Prepare failed: " . $database->mysqli->error);
		}

        $stmt->bind_param("sssss", $name_users, $surname_users, $email_users, $password_users, $mobile_users);

        if (!$stmt->execute()) {
			$stmt->close();
			$database->disconnect();
            $message = true;
            $alert_color = "alert-danger";
            $message_text = "Η εγγραφή σας δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε ξανά.";
        }
        else {
            $stmt->close();
            $database->disconnect();
            $message = true;
            $alert_color = "alert-success";
            $message_text = "Η εγγραφή σας ολοκληρώθηκε με επιτυχία.";
        }
    }

    if (isset($_POST['login'])) {
        $email_users = $_POST['email_users'];
        $password_users = $_POST['password_users'];

        $database->connect();

        $query = "SELECT * FROM 00_users WHERE email_users = ? AND password_users = ? LIMIT 1";

        if (!($stmt = $database->mysqli->prepare($query))) {
			die("Prepare failed: " . $database->mysqli->error);
		}
		
		$stmt->bind_param("ss", $email_users, $password_users);

        if (!$stmt->execute()) {
			$stmt->close();
			$database->disconnect();
            $message = true;
            $alert_color = "alert-danger";
            $message_text = "Η είσοδος σας δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε ξανά.";
        }
        else {

            $result = $stmt->get_result();
  
            if (!$result) {
            die("Failed to get result set: " . $database->mysqli->error);
            }

            if ($result->num_rows != 1) {
			$stmt->close();
            $database->disconnect();
            }
            else {
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name_users'];
                    $surname = $row['surname_users'];
                    $mobile = $row['mobile_users'];
                }

                $stmt->close();
                $database->disconnect();
                $message = true;
                $alert_color = "alert-success";
                $message_text = "Η είσοδος $name $surname ολοκληρώθηκε με επιτυχία. Το τηλέφωνό σας είναι το $mobile.";
             }
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            
            <?php require_once ("header.php");?>
            <?php require_once ("stylesheets.php");?>

            <title>My Website</title>
        </head>    

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action='index.php' method='post' class='row g-3 m-2' autocomplete="off">
                            <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='text' name='name_users' class='form-control shadow w-100' id='name_users' maxlength='50'>
                                        <label for='name_users' class='form-label'>Όνομα</label>
                                    </div>	
                                </div>
                            </div>
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='text' name='surname_users' class='form-control shadow w-100' id='surname_users' maxlength='50' autocomplete="new-password">
                                        <label for='surname_users' class='form-label'>Επώνυμο</label>
                                    </div>	
                                </div>
                            </div>
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='email' name='email_users' class='form-control shadow w-100' id='email_users' maxlength='50' autocomplete="new-password">
                                        <label for='email_users' class='form-label'>Email</label>
                                    </div>	
                                </div>
                            </div>
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='tel' name='mobile_users' class='form-control shadow w-100' id='mobile_users' maxlength='10' autocomplete="new-password">
                                        <label for='mobile_users' class='form-label'>Τηλέφωνο</label>
                                    </div>	
                                </div>
                            </div>
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='password' name='password_users' class='form-control shadow w-100' id='password_users' maxlength='10' autocomplete="new-password"  required>
                                        <label for='password_users' class='form-label'>Κωδικός</label>
                                    </div>	
                                </div>
                            </div>
                            <div class='row mt-2'>
                                <div class='col-md-12'>
                                    <button class='btn btn-outline-info shadow w-100' type='submit' name='subscribe'>Εγγραφή</button>
                                </div>
                            </div>
                        </form>                   
                    </div>
                </div> 
            </div> 

            <?php
                if ($message == true) {
                    echo "
                        <div class='container'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='alert $alert_color alert-dismissible fade show' role='alert'>
                                        <strong>$message_text</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    ";
                }
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action='index.php' method='post' class='row g-3 m-2' autocomplete="off">
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='email' name='email_users' class='form-control shadow w-100' id='email_users' maxlength='50' autocomplete="new-password">
                                        <label for='email_users' class='form-label'>Email</label>
                                    </div>	
                                </div>
                            </div>
                             <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='password' name='password_users' class='form-control shadow w-100' id='password_users' maxlength='10' autocomplete="new-password"  required>
                                        <label for='password_users' class='form-label'>Κωδικός</label>
                                    </div>	
                                </div>
                            </div>
                            <div class='row mt-2'>
                                <div class='col-md-12'>
                                    <button class='btn btn-outline-info shadow w-100' type='submit' name='login'>Είσοδος</button>
                                </div>
                            </div>
                        </form>                   
                    </div>
                </div> 
            </div> 

            <?php require_once ("footer.php");?>
        </body>
    </html>            
            <?php require_once ("scripts.php");?>