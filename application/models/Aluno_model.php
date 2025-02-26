<?php
/**
 * Classe Aluno_model
 *
 * Modelo responsável por interagir com a tabela 'alunos' no banco de dados.
 * Contém métodos para realizar operações de recuperação de dados relacionados aos alunos.
 * 
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Aluno
 */
class Aluno_model extends CI_Model {
    /**
     * Recupera um aluno pelo ID
     *
     * Este método busca os dados de um aluno na tabela 'alunos' com base no ID fornecido.
     * Retorna o objeto aluno correspondente ao ID ou null caso não encontre nenhum resultado.
     * 
     * @param  int $id ID do aluno a ser recuperado
     * @return object|null Objeto contendo os dados do aluno ou null se não encontrado
     */
	public function get_aluno($id) {
        return $this->db->where('id', $id)->get('alunos')->row();
    }
}
