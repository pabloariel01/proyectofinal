<?php


class Usuario extends CI_Model {

    var $details;

    function validate_user( $email, $password ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        // echo $email;
        // echo password_hash($password, PASSWORD_DEFAULT);
        $this->db->from('usuarios');
        $this->db->where('nombre',$email );
        $login = $this->db->get()->result();

        // $pwd= $login[0]->password ;
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        // var_dump($hashed_password);
        // echo password_verify($password, $hashed_password);
        // print $email;
        // print_r($pwd);
        // echo($password);
        //   if (password_verify($password, $pwd)) {
        //       echo '¡La contraseña es válida!';
        //   } else {
        //       echo 'La contraseña no es válida.';
        //   }

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($login) && count($login) == 1 ) {
            if(password_verify ($password , $login[0]->password )){
            // Set the users details into the $details property of this class
            $this->details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }}

        return false;
    }

    function set_session() {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $this->session->set_userdata( array(
                'id'=>$this->details->id,
                'nombre'=> $this->details->nombre,
                'rol'=>$this->details->rol,
                'isLoggedIn'=>true
            )
        );
    }

    function  create_new_user( $userData ) {
      $data['firstName'] = $userData['firstName'];
      $data['lastName'] = $userData['lastName'];
      $data['teamId'] = (int) $userData['teamId'];
      $data['isAdmin'] = (int) $userData['isAdmin'];
      $data['avatar'] = $this->getAvatar();
      $data['email'] = $userData['email'];
      $data['tagline'] = "Click here to edit tagline.";
      $data['password'] = sha1($userData['password1']);

      return $this->db->insert('user',$data);
    }




}
