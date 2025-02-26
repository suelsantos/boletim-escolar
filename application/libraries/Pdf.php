<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Verifique se o Composer está carregando o FPDF
if (file_exists(APPPATH . '../vendor/autoload.php')) {
    require_once APPPATH . '../vendor/autoload.php';
}
else {
    show_error('O Composer não está instalado corretamente ou a biblioteca FPDF não está instalada.', 500);
}

/**
 * Classe Pdf
 *
 * Esta classe estende a classe FPDF e fornece funcionalidades adicionais para trabalhar com PDFs,
 * incluindo a capacidade de carregar HTML e renderizar ou transmitir o PDF gerado.
 * 
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    PDF Generation
 */
class Pdf extends FPDF {
	/**
     * Construtor da classe Pdf
     *
     * Chama o construtor da classe pai (FPDF) para inicializar o objeto PDF.
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

	/**
     * Carrega o conteúdo HTML no PDF
     *
     * Recebe uma string HTML e adiciona ao PDF, configurando a fonte e a formatação.
     * 
     * @param  string $html Conteúdo HTML a ser carregado no PDF
     * @return void
     */
    public function load_html($html) {
        $this->AddPage();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $html);
    }

	/**
     * Renderiza o PDF e o envia para a saída
     *
     * Gera o PDF final e o envia para o navegador ou para o fluxo de saída.
     * 
     * @return void
     */
    public function render() {
        $this->Output();
    }

	/**
     * Transmite o PDF para o navegador com um nome de arquivo específico
     *
     * Gera e transmite o PDF gerado para o navegador, permitindo que o usuário faça o download
     * ou visualize o arquivo PDF com o nome de arquivo fornecido.
     * 
     * @param  string $filename Nome do arquivo PDF para transmissão
     * @return void
     */
    public function stream($filename) {
        $this->Output('I', $filename);
    }
}
