<?php
session_start();
    include("../fpdf/fpdf.php");
    $pdf = new FPDF();

    $data =  $_SESSION['result-data'];
    $cliente =  $_SESSION['result-compra-nome'];
    $produto = $_SESSION['result-compra-produto'];
    $descricao = $_SESSION['result-compra-descricao'];
    $preco = $_SESSION['result-compra-preco'];
    $qtd = $_SESSION['result-compra-qtd'];
    $total = $_SESSION['result-compra-total'];

    $pdf->AddPage("PORTRAIT", 'A5');
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(125, 10, utf8_decode('SHOPDDN'),0,0.5,'C');
    $pdf->SetFont('Times', '', 16);
    $pdf->Cell(125, 10, utf8_decode('Recibo'),0,1,'C');
    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 14);
    $pdf->Write(3,"Data & Hora : ". $data);
    $pdf->Ln(7);
    $pdf->SetLeftMargin(14);
    $pdf->SetFont('Times', '', 12);
    $pdf->Write(3, "Cliente : ". $cliente);
    $pdf->Ln(6);
    $pdf->Write(3, "Produto : ". $produto);
    $pdf->Ln(6);
    $pdf->Write(3, "Descricao : ". $descricao);
    $pdf->Ln(6);
    $pdf->Write(3, "Preco : ". $preco ." ". "MT");
    $pdf->Ln(6);
    $pdf->Write(3, "Quantidade : ". $qtd);
    $pdf->Ln(6);
    $pdf->Write(3, "TOTAL: ". $total. "MT");
    $pdf->Ln(9);
    $pdf->SetLeftMargin(3);
    $pdf->SetTextColor(60, 133, 0);
    $pdf->SetFont('Times', '', 13);
    $pdf->Write(3,"Compra Efectuada com Sucesso!");
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(5);
    $pdf->SetLeftMargin(10);
    $pdf->Write(3,"O seu produto sera entregue dentro de 2 dias! Obrigado.");
    $pdf->Ln(5);
    $pdf->Write(3,"Continue desfrutando dos nossos produtos.");
    $pdf->Ln(5);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(125, 10, utf8_decode('Contactos (+258) : 846387041 & 872876066'),0,0.1,'C');
    $pdf->Cell(125, 10, utf8_decode('Loja Online Disponivel : http://shoproductsddn.rf.gd'),0,0,'C');

    $pdf->Output();
?>