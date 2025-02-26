<?php
/**
 * Classe Nota_model
 *
 * Modelo responsável por interagir com as tabelas 'notas' e 'disciplinas' no banco de dados.
 * Contém métodos para recuperar as notas de um aluno e suas disciplinas associadas.
 * 
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Nota
 */
class Nota_model extends CI_Model {
    /**
     * Recupera as notas de um aluno
     *
     * Este método busca as notas e as disciplinas associadas a um aluno com base no ID do aluno.
     * Realiza uma junção entre as tabelas 'notas' e 'disciplinas' e retorna os resultados de disciplina e nota.
     * 
     * @param  int $aluno_id ID do aluno cujas notas serão recuperadas
     * @return array Um array de objetos contendo as disciplinas e notas do aluno
     */
	public function get_notas($aluno_id) {
        $this->db->select('disciplinas.nome as disciplina, notas.nota');
        $this->db->from('notas');
        $this->db->join('disciplinas', 'notas.disciplina_id = disciplinas.id');
        $this->db->where('notas.aluno_id', $aluno_id);
        return $this->db->get()->result();
    }
}
