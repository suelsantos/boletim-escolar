<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Boletim Controller
 *
 * Controlador responsável pela geração de boletins em formato PDF.
 * Carrega os modelos de Aluno e Nota para obter as informações necessárias para a criação do PDF.
 *
 * @package     CodeIgniter
 * @subpackage  Controllers
 * @category    PDF Generation
 */
class Boletim extends CI_Controller {
	/**
     * Construtor do controller
     *
     * Carrega os modelos necessários e as bibliotecas para gerar o PDF.
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Aluno_model');
        $this->load->model('Nota_model');
        $this->load->database();
        $this->load->library('Pdf');
    }

	/**
     * Gera o PDF do boletim do aluno
     *
     * Gera um boletim escolar em formato PDF, contendo as informações do aluno e suas notas.
     * O PDF é gerado com título personalizado, cabeçalhos e uma tabela de disciplinas e notas.
     * 
     * @param  int $id ID do aluno
     * @return void
     */
    public function gerar_pdf($id = NULL) {
		// Verificar se o ID é válido (por exemplo, diferente de 0)
		if ($id === 0 || !filter_var($id, FILTER_VALIDATE_INT)) {
			show_404(); // Exibe o erro 404 se o ID não for passado ou não for um número inteiro válido
			return;
		}

		// Verificar se o ID é um número inteiro
		if (!filter_var($id, FILTER_VALIDATE_INT)) {
			show_error('ID do aluno inválido.', 400, 'Erro de Validação');
			return;
		}
		
		// Recuperar informações do aluno
        $aluno = $this->Aluno_model->get_aluno($id);
        if (!$aluno) {
            show_error('Aluno não encontrado.', 404, 'Erro Encontrado');
            return;
        }

		// Recuperar notas do aluno
        $notas = $this->Nota_model->get_notas($id);

        // Criando o PDF
        $pdf = new Pdf();
        $pdf->AddPage();

		// Nome do Aluno
		$nome_aluno = iconv('UTF-8', 'windows-1252', $aluno->nome);

		// Definindo o título do PDF
        $pdf->SetTitle('Boletim Escolar - ' . $nome_aluno); // Definir título do PDF com o nome do aluno

        // Cabeçalho do Boletim
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(33, 37, 41); // Cor do texto: cinza escuro
        $pdf->Cell(190, 10, 'Boletim Escolar', 0, 1, 'C');
        $pdf->Ln(10);

        // Informações do Aluno
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0); // Cor do texto: preto		
        $pdf->Cell(40, 10, "Nome: " . $nome_aluno, 0, 1);
        $pdf->Cell(40, 10, "Matricula: " . $aluno->matricula, 0, 1);
        $pdf->Ln(10);

        // Cabeçalho da Tabela
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(220, 220, 220); // Cor de fundo: cinza claro

        // Largura da página sem margens (200mm da largura da página - 10mm de margem esquerda e 10mm de margem direita)
        $table_width = 190;

        // Ajustando a largura das células proporcionalmente
        $disciplina_width = 140; // 140mm para a disciplina
        $nota_width = 50; // 50mm para a nota

        // Cabeçalho da tabela (com a largura ajustada)
        $pdf->Cell($disciplina_width, 10, 'Disciplina', 1, 0, 'C', true);
        $pdf->Cell($nota_width, 10, 'Nota', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 12);		

        // Linhas da Tabela
        if (empty($notas)) {
            $pdf->Cell($table_width, 10, 'Nenhuma nota disponivel', 1, 1, 'C');
        }
		else {
            foreach ($notas as $nota) {
                $disciplina = iconv('UTF-8', 'windows-1252', $nota->disciplina);

                // Linhas da tabela (com a largura ajustada)
                $pdf->Cell($disciplina_width, 10, $disciplina, 1);
                $pdf->Cell($nota_width, 10, $nota->nota, 1, 1, 'C');
            }
        }

		// Gera o PDF
        $pdf->Output();
    }
}
