<?php 
class pergunta{


    public $id_pergunta;
    public $pergunta;	
    public $resposta;	
    public $nome_solicitante;
    public $email_solicitante;	
    public $situacao;	
    public $data_pergunta;	
    public $data_resposta;	
    public $adm_id_resposta;
    public $status_pergunta;


    public function carregar()
    {   
        $sql = "SELECT * FROM tb_perguntas WHERE id_pergunta=".$this->id_pergunta;
        include "../conexao.php";
        $resultado = $conexao->query($sql);
        $linha = $resultado->Fetch();
        $this->id_pergunta = $linha['id_pergunta'];
        $this->pergunta = $linha['pergunta'];
        $this->resposta = $linha['resposta'];
        $this->adm_id_resposta = $linha['adm_id_resposta'];
       
    }


    public function __construct($id_pergunta = false)
    {
        $this->id_pergunta = $id_pergunta;
        if($id_pergunta){
            $this->id_pergunta = $id_pergunta;
            $this->carregar();
        }
    }


    public function postar_pergunta ()
    {
        $sql = "UPDATE tb_perguntas
        SET
        pergunta = '" . $this->pergunta . "',
        resposta = '" . $this->resposta . "', 
        adm_id_resposta = '" . $this->adm_id_resposta . "',
        status_pergunta = '" . $this->status_pergunta . "'
        WHERE id_pergunta = " . $this->id_pergunta;


        include "../conexao.php";
        $conexao-> exec($sql);
    }
    

    public function receber_pergunta ()
    {
        $sql = "INSERT INTO tb_perguntas (nome_solicitante,pergunta, email_solicitante,situacao) VALUES (
            ' " .$this->nome_solicitante." ' ,
            ' " .$this->pergunta." ' ,
            ' " .$this->email_solicitante." ' ,
            ' " .$this->situacao." ' 
        )";
        include "../conexao.php";
        $conexao-> exec($sql);
    }

    public function receber_pergunta_adm ()
    {
        $sql = "INSERT INTO tb_perguntas (pergunta,resposta,nome_solicitante,email_solicitante,situacao,adm_id_resposta,status_pergunta,data_resposta) VALUES (
            ' " .$this->pergunta." ' ,
            ' " .$this->resposta." ' ,
            ' " .$this->nome_adm." ' ,
            ' " .$this->adm_email." ',
            'adm',
            ' " .$this->adm_id_resposta." ',
            'RES',
            NOW()

        )";
        include "../conexao.php";
        $conexao-> exec($sql);
    }


    public function listar_pergunta_sugerida()
    {
        
        $sql = "SELECT * FROM tb_perguntas WHERE status_pergunta = 'NR' ";
        include "../conexao.php";
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        return $lista;
    }


    public function listar_pergunta_index()
    {
        $sql = "SELECT * FROM tb_perguntas WHERE status_pergunta = 'RES' ";
        include "conexao.php";
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        return $lista;
    }


    public function listar_pergunta_postada()
    {
        $sql = "SELECT * FROM tb_perguntas p JOIN tb_adm a 
        ON p.adm_id_resposta= a.adm_id
        WHERE status_pergunta = 'RES' 
        ORDER BY p.id_pergunta";
        include "../conexao.php";
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        return $lista;
    }


    public function anular_pergunta()
    {   

        $sql = "UPDATE tb_perguntas
        SET
        status_pergunta = 'EXC'
        WHERE id_pergunta = " . $this->id_pergunta;
        
        include "../conexao.php";
        $conexao-> exec($sql);
    }


    public function listar_pergunta_anulada ()
    {
        $sql = "SELECT * FROM tb_perguntas WHERE status_pergunta = 'EXC' ";
        include "../conexao.php";
        $resultado = $conexao->query($sql);
        $lista = $resultado->fetchAll();
        return $lista;
    }


}


?>