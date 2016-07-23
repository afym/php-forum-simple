<?php 

class LoginData extends DataBase
{
   public function login($email, $password)
   {
       $hash = sha1($password);
       $where = "correo = \"$email\" AND contrasena = \"$hash\"";

       $users = $this->dataBase()->select('tb_usuario', ['id', 'nombre', 'apellido'], $where);

       if ($users->num_rows == 1) {
           return $users->fetch_assoc();
       }

       return null;
   }
}