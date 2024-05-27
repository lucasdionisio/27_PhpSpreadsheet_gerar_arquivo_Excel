<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;

public function onExcel($param)
{
    try {
        // Abre uma transação com o banco de dados 'app'
        TTransaction::open('app');
        
        // Define o caminho do arquivo que será gerado
        $arquivo = 'app/output/plano_contas.xls';    
        
        // Cria uma nova planilha
        $plan = new Spreadsheet();
        $sheet = $plan->getActiveSheet();
        
        // Define o cabeçalho da planilha
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'CODIGO');
        $sheet->setCellValue('C1', 'DESCRICAO');
        
        // Obtém os dados da tabela 'plano_contas' onde 'id' > 0
        $planos = PlanoConta::where('id', '>', 0)->load();
        $i = 2; // Inicia a inserção dos dados na segunda linha
        foreach ($planos as $plano) {
            $sheet->setCellValue("A{$i}", $plano->id);
            $sheet->setCellValue("B{$i}", $plano->codigo);
            $sheet->setCellValue("C{$i}", $plano->descricao);
            $i++;
        }
        
        // Fecha a transação com o banco de dados
        TTransaction::close();
        
        // Cria um escritor para salvar a planilha no formato Excel (.xls)
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($plan, 'Xls');
        $writer->save($arquivo); // Salva o arquivo no caminho especificado
        
        // Abre o arquivo gerado
        TPage::openFile($arquivo);
        
        // Exibe uma mensagem de sucesso
        new TMessage('info', 'Arquivo Gerado com Sucesso', new TAction([$this, 'onReload']));
        
    } catch (Exception $e) {
        // Em caso de erro, exibe uma mensagem de erro
        new TMessage('error', $e->getMessage());
    }
}
?>
