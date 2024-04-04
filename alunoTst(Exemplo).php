''<?php
    //namespace tst;
    //use Persist;
    include_once();   
    class alunoTst extends persist {
        public string $nome;
        public int $matricula;
        static $local_filename = "alunoTst.txt";

        public function __construct(  ) {             
            
        }        

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        
    }