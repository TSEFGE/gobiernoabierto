<?php
/* inicio de prueba
*/
require 'vendor/autoload.php';
include_once 'init.php';
include_once __DATA_PATH__ . '/dao/FGEServicesDAO.php';
$dao = new FGEServicesDAO();
$logger = Logger::getLogger("index.php");
// First start a session. This should be right at the top of your login page.
session_start();
    // Check to see if this run of the script was caused by our login submit button being clicked.
if (isset($_POST['login-submit'])) {
        // Also check that our email address and password were passed along. If not, jump
        // down to our error message about providing both pieces of information.
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $ldapconn = ldap_connect("ldap://192.108.24.107") or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn , LDAP_OPT_REFERRALS, 0);
        if (ldap_bind($ldapconn,$usuario.'@fiscaliaveracruz.gob.mx',$password)){
              $result=$dao->authentication($usuario,$password);
        }
        if (count($result>0)){
             // If the user record was found, compare the password on record to the one provided hashed as necessary.
            // If successful, now set up session variables for the user and store a flag to say they are authorized.
            // These values follow the user around the site and will be tested on each page.
      //      $hash = $result[0]['password'];

            
         //   if (password_verify($password, $hash)) {
            //if (true) {
                /*
                $_SESSION['is_auth'] = true;
                $_SESSION['idUsuario'] = $result[0]['id'];
                $_SESSION['userLevel'] = $result[0]['level'];
                $_SESSION['idUnidad'] = $result[0]['idUnidad'];
                header('location: registrar.php');
                */

                if ($result[0]['activacion']==1) {

                    /*
                    if ($result[0]['level']== -1) {
                        $_SESSION['is_auth'] = true;
                        $_SESSION['idUsuario'] = $result[0]['id'];
                        $_SESSION['userLevel'] = $result[0]['level'];
                        $_SESSION['idUnidad'] = $result[0]['idUnidad'];
                        header('location: usergestion.php');    
                    }else{
                    */
                        $_SESSION['is_auth'] = true;
                        $_SESSION['idUsuario'] = $result[0]['id'];
                        $_SESSION['userLevel'] = $result[0]['level'];
                        $_SESSION['idUnidad'] = $result[0]['idUnidad'];
                        header('location: registrar.php');
                    //}
                }else {
                    $_SESSION['is_auth'] = false;
                    session_destroy();
                    $error = "1";
                    header("location:login.php?error1=".$error);
                }
          /*  } else {
                $_SESSION['is_auth'] = false;
                session_destroy();
                $error = "1";
                header("location:login.php?error1=".$error);
            }*/

        }
        else{
            $_SESSION['is_auth'] = false;
            session_destroy();
            $error = "1";
            header("location:login.php?error1=".$error);
        }
    }
}


?>
