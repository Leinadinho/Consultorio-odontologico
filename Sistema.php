<?php

require_once "persist.php";
require_once "Perfil.php";
require_once "Cache.php";

final class Sistema extends persist{

    private array $listaPerfis;
    private static ?Sistema $instance;

    private array $cache;
    private function __construct() {
        $this->listaPerfis = [];
        $this->cache = [];
        $this->logados = [];
    }
    private function __clone(){
    }
    public static function getInstance(): Sistema{

        if(!isset(self::$instance)){
            self::$instance = new static();
        }

        return self::$instance;
    }
    public function criarPerfil(string $login, string $senha, Pessoa $usuario, int $nivel) {

        $novoPerfil = new Perfil($login, $senha, $usuario, $nivel);

        array_push($this->listaPerfis, $novoPerfil);

        return $this->logar($usuario->getCpf(), $senha);
    }
    public function getPerfil(string $cpf) {
        for($i = 0; $i < count($this->listaPerfis); $i++){
            if($this->listaPerfis[$i]->getUsuario()->getCpf() == $cpf){
                return $this->listaPerfis[$i];
        }
    }
    echo "Cpf não cadastrado.";
    return ;
}

    public function logar(string $cpf, string $senha){
        $usuario = $this->getPerfil($cpf);
        if(!$usuario){
            echo "Usuario não encontrado";
            return ;
        }

        $usuario->setIsLogged();

        for($i = 0; $i < count($this->cache); $i++){
            if($this->cache[$i]->getUsuario()->getUsuario()->getCpf() == $cpf && $this->cache[$i]->getSaida() == null){
                $this->cache[$i]->setSaida(new Data(date("d"), date("m"), date("Y"), date("H") - 3, date("i")));
                return $usuario;
            };
        }

        if($usuario->getSenha() != $senha){
            echo "Senha incorreta";
            return ;
        }

        $log = new Cache($usuario, new Data(date("d"), date("m"), date("Y"), date("H") - 3, date("i")));
        array_push($this->cache, $log);
        return $usuario;
    }
    public function showLog(){
        for($i = 0; $i < count($this->cache); $i++){
            echo "Entrada: " . $this->cache[$i]->getAcesso() . PHP_EOL;  
        }
    }

    static public function getFilename() {
    return "";
}
}

//(string $nome, string $rg, string $cpf, string $email, string $telefone)
$p1 = new Pessoa("n1","r1","c1","e1","t1");
$p2 = new Pessoa("n2","r2","c2","e2","t2");
$p3 = new Pessoa("n3","r3","c3","e3","t3");

$sistema = Sistema::getInstance();

//(string $login,string $senha, Pessoa $usuario, int $nivel)
$perfil1 = $sistema->criarPerfil("Ze1", "Senha1", $p1, 1);