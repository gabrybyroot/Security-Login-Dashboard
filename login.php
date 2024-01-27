<?php
require_once('config.php');

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_select = "SELECT * FROM users WHERE username = ?";
    $stmt = $connessione->prepare($sql_select);
    $stmt->bind_param("s", $username);

    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $stored_hash = $row['password'];
            if(password_verify($password, $stored_hash)){
                if($row['status'] == 'verificato'){
                    if($row['status_account'] == 'attivo'){
                        session_start();

                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['loggato'] = true;
                        $_SESSION['username'] = $row['username'];

                        if(isset($_SESSION['registrato'])){
                            echo "<script>alert('Registrazione avvenuta con successo CIAO.')</script>";
                            unset($_SESSION['registrato']);
                        }

                        header("location: ../areaprivata.php");
                    }else{
                        $error = "Il tuo account è bloccato. Contatta il supporto.";
                    }
                }else{
                    $error = "Account non verificato. Verifica l'email prima di effettuare l'accesso.";
                }
            }else{
                $error = "La password non è corretta";
            }
        }else{
            $error = "Non ci sono account con quello username";
        }
    }else{
        $error = "Errore in fase di login";
    }

    $stmt->close();
    $connessione->close();

    echo "<script>window.location.href = '../loginform.php?error=" . urlencode($error) . "';</script>";
    exit();
}
?>
