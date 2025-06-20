<?php
    namespace NovoPHPmain\Model;

    use NovoPHPmain\DAO\LoginDAO;
    use Exception;

    final class Login extends Model
    {
        public $Id, $Email, $Senha, $Nome;

    public function logar() : ?Login
    {
        return new LoginDAO()->autenticar($this);
    }

    }

?>