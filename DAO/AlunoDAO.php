<?php

namespace App\DAO;

use App\Model\Aluno;

final class AlunoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Aluno $model) : Aluno
    {
        return ($model->$id == null) ? $this->insert($model) :
            $this->update($model);
    }

    public function insert(Aluno $model) : Aluno
    {
        $sql = "INSERT INTO aluno(nome, ra, curso) VALUES (?, ?, ?) ";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->RA);
        $stmt->bindValue(3, $model->Curso);

        $stmt->execute();

        $model->$id = parent::$conexao->lastInsertId();

        return $model;
    }

    public function update(Aluno $model) : Aluno
    {
        $sql = "UPDATE aluno SET nome=?, ra=? curso=? WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->RA);
        $stmt->bindValue(3, $model->Curso);
        $stmt->bindValue(4, $model->Id);
        $stmt->execute();

        return $model;
    }

    public function selectById(int $id) : ?Aluno
    {
        $sql = "SELECT * FROM aluno WHERE id=? ";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("App\Model\Aluno");
    }

    /**
     * Método que retorna todos os registros da tabela pessoa no bando de dados
     */
     public function select() : array
     {
        $sql = "SELECT * FROM aluno";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        // Retorna um array com as linhas retornadas da consulta. Observe que
        // o array é um array objetos. Os obijetos são do tipo stdClass
        // foram criados automaticamente pelo método fetcAll do PDO.
        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Aluno"); 
     }

     /**
      * Remove um registro da tavela pessoa do banco de dados.
      * Note que o método exige um parâmeto $id do tipo inteiro. 
      */
      public function delete(int $id) : bool
      {
        $sql = "DELETE FROM aluno WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);
        $bind->bindValue(1, $id);
        return $stmt->execute();

      }
}