<?php
    require_once ("include/config.php");
    require_once ("func/calc_fpa.php");
    
    if (isset($_POST['send_amount'])) {
        $amount_without_fpa = Calc_Fpa($_POST['amount']);
        echo "$amount_without_fpa";
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

            <?php require_once ("navbar.php");?>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action='index.php' method='post' class='row g-3 m-2' autocomplete="off">
                            <div class='row'>
                                <div class='col-md-12 m-1'>
                                    <div class='form-floating'>
                                        <input type='text' name='amount' class='form-control shadow w-100' id='amount' maxlength='4'>
                                        <label for='amount' class='form-label'>Ποσό με</label>
                                    </div>	
                                </div>
                            </div>
                            <div class='row mt-2'>
                                <div class='col-md-12'>
                                    <button class='btn btn-outline-info shadow w-100' type='submit' name='send_amount'>Υπολογισμός</button>
                                </div>
                            </div>
                        </form>                   
                    </div>
                </div> 
            </div> 

            <?php require_once ("footer.php");?>
            <?php require_once ("scripts.php");?>