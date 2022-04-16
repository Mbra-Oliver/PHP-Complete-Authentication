<?php
session_start();

if(isset($_SESSION['logged'])){
    header('location: /');
}
include('db.php');

if(isset($_POST['handle_login'])){

	$email = $_POST['email'];
	$password = $_POST['password'];
	$have_error = false;
	$error_text = '';
	///Verifier que tous lesz champs sont saisie

    if(!empty($email) && !empty($password)){

        $query = $connect->prepare('SELECT * FROM users where email = ?');
        $query->execute(array($email));

        if($query->rowCount() >=1){
            
            foreach($query as $result){

                if($result['password'] == sha1( $password)){

                    $_SESSION['name'] = $result['name'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['logged'] = true;

                    header('location: /');


                }else{
                    $have_error=true;
                    $error_text = 'Password dont reconize';
                }

            }

        }else{
            $have_error=true;
            $error_text= 'Adresse mail non reconnu';
        }

    }else{
        $have_error=true;
        $error_text = 'All field are required';
    }


}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>PHP | Absolute Beginner</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Absolute Beginner | User Authentication</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post">
					<label for="chk" aria-hidden="true">Mbra-academie</label>

					<?php
						if(isset($have_error)){?>
							<span style="color: #573b8a; font-size: 15px; display: flex; margin-left: 60px; font-weight: 400; "><?= $error_text ?></span>
						<?php }
					
					?>
					

					<input type="email" name="email"  placeholder="Email" >
					<input type="password" name="password"  placeholder="Password" >
				<button type="submit" name="handle_login">Connect to Mbra Academie</button>
				</form>
			</div>

	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>
