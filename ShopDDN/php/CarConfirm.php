<?php
session_start();
include("../fpdf/fpdf.php");
require_once("Conexao.php");

        $pdf = new FPDF();

        $pdf->AddPage("PORTRAIT", 'A5');
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(125, 10, utf8_decode('SHOPDDN'),0,0.5,'C');
        $pdf->SetFont('Times', '', 14);
        $pdf->Cell(125, 10, utf8_decode('Confirmação'),0,1,'C');
        $pdf->Ln(6);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Write(3, "INFORMAÇÕES DO CLIENTE");
        $pdf->SetFont('Times', '', 12);
        $pdf->SetLeftMargin(14);
        $pdf->Ln(6);

    if(isset($_SESSION["dados"])){
        $sql = $_SESSION["dados"];
    foreach($sql as $line){
        $pdf->SetLeftMargin(14);
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
        $pdf->Write(3, "Endereço : ". $line['Endereco']);
        $pdf->Ln(6);
        $pdf->Write(3, "Data : ". $line['Data']);
        $pdf->Ln(9);

        $scl = $conexao->prepare("UPDATE Carrinho SET Status = 1 WHERE Chave = $line[Chave]");
        $scl->execute();
    }
}
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(47,5, utf8_decode('PRODUTOS REQUISITADOS'),0,0.1,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 7, "Produto",1,0, "C");
        $pdf->Cell(40, 7, "Descrição",1,0, "C");
        $pdf->Cell(20, 7, "Preço",1,0, "C");
        $pdf->Cell(10, 7, "Qtd",1,0, "C");
        $pdf->Cell(20, 7, "Sub-Total",1,1, "C");

        $pdf->SetFont('Times', '', 10);

    if(isset($_SESSION["registo_carrinho"])){
        $prod = $_SESSION["registo_carrinho"];

    foreach($prod as $prods){
        $pdf->Cell(40, 7, $prods['Produto'],1,0, "C");
        $pdf->Cell(40, 7, $prods['Descrição'],1,0, "C");
        $pdf->Cell(20, 7, $prods['Preço'] . "MT",1,0, "C");
        $pdf->Cell(10, 7, $prods['Quantidade'],1,0, "C");
        $pdf->Cell(20, 7, $prods['Subtotal']. "MT",1,0, "C");
        $pdf->Ln();
    }

    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(110, 7, "Total",1,0, "C");

    if(isset($_SESSION["ch"])){ 
        $tot = $_SESSION['ch'];
            $pdf->Cell(20, 7, $tot . "MT",1,0, "C");
    }
}

        $pdf->Ln(15);
        $pdf->SetFont('Times', '', 12);
        $pdf->Write(3, "Entregador");
        $pdf->Ln(5);
        $pdf->Write(3, "_______________________");
        $pdf->Ln(6);
        $pdf->Write(3, "Cliente");
        $pdf->Ln(5);
        $pdf->Write(3, "_______________________");
        $pdf->Ln(8);
        $pdf->Cell(125, 10, utf8_decode("Matola, ".date("Y-m-d H:i:s")),0,0.5,'C');

    $pdf->Output();

    unset($_SESSION['dados']);
    unset($_SESSION['registo_carrinho']);
    unset($_SESSION['ch']);
?>