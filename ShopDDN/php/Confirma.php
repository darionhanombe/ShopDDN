<?php session_start();
    require_once("Conexao.php");
    include("../fpdf/fpdf.php");
    $pdf = new FPDF();

    $data = $_SESSION['datacompra'];
    $tabel = $_SESSION['tabela'];

    
    $pdf->AddPage("PORTRAIT", 'A5');
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(125, 10, utf8_decode('SHOPDDN'),0,0.5,'C');
    $pdf->SetFont('Times', '', 14);
    $pdf->Cell(125, 10, utf8_decode('Confirmacao'),0,1,'C');
    $pdf->Ln(6);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Write(3, "INFORMACOES DO CLIENTE");
    $pdf->SetFont('Times', '', 12);
    $pdf->SetLeftMargin(14);
    $pdf->Ln(6);

    
    foreach($conexao->query("SELECT $tabel.Produto, $tabel.Descricao, $tabel.Preco, Compra.Compra_ID, Compra.Nome, Compra.Contacto, Compra.Pagamento, Compra.NRConta, Compra.Email, Compra.Endereco, Compra.Quantidade, Compra.Data,  Compra.{$tabel}_FK FROM Compra JOIN $tabel WHERE {$tabel}.{$tabel}_ID = Compra.{$tabel}_FK AND Compra.Data LIKE  ('%".$data."%')") as $line){
        $pdf->Write(3, "Cliente : ". $line['Nome']);
        $pdf->Ln(6);
        $pdf->Write(3, "Contacto : ". $line['Contacto']);
        $pdf->Ln(6);
        $pdf->Write(3, "Pagamento : ". $line['Pagamento']);
        $pdf->Ln(6);
        $pdf->Write(3, "Nr da Conta : ". $line['NRConta']);
        $pdf->Ln(6);
        $pdf->Write(3, "Email : ". $line['Email']);
        $pdf->Ln(6);
        $pdf->Write(3, "Endereco : ". $line['Endereco']);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(47,5, utf8_decode('PRODUTO REQUISITADO'),0,0.1,'C');
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(2);
        $pdf->Write(3, "Produto: ". $line['Produto']);
        $pdf->Ln(6);
        $pdf->Write(3, "Descricao : ". $line['Descricao']);
        $pdf->Ln(6);
        $pdf->Write(3, "Quantidade : ". $line['Quantidade'] . "Units");
        $pdf->Ln(6);
        $pdf->Write(3, "Preco : ". $line['Preco'] . "MT");
        $pdf->Ln(6);
        $pdf->Write(3, "TOTAL PAGAMENTO : ". $line['Quantidade'] * $line['Preco'] . "MT");
        $pdf->Ln(6);
        $pdf->Write(3, "Data da Requisicao : ". $line['Data']);
        $pdf->Ln(20);

        $scl = $conexao->prepare("UPDATE Compra SET Status = 1 WHERE Compra_ID = $line[Compra_ID]");
        $scl->execute();
    
        
    }
    $pdf->Write(3, "Entregador");
    $pdf->Ln(5);
    $pdf->Write(3, "_______________________");
    $pdf->Ln(12);
    $pdf->Write(3, "Cliente");
    $pdf->Ln(5);
    $pdf->Write(3, "_______________________");
    $pdf->Ln(10);


    $pdf->Cell(125, 10, utf8_decode("Matola, ".date("Y-m-d H:i:s")),0,0.5,'C');

    $pdf->Output();

    unset($_SESSION['datacompra']);
    unset($_SESSION['tabela']);

?>