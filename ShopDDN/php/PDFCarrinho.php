<?php
session_start();
include("../fpdf/fpdf.php");
require_once("Conexao.php");
$pdf = new FPDF();

$chave = $_SESSION['chave'];
$nome = $_SESSION['nome'];
$data = $_SESSION['dta'];
$nr = rand(1, 1000);
$sql = $conexao->query("SELECT Produtos, Descricao, Preco, Quantidade, Subtotal FROM Carrinho WHERE Chave = $chave");
$total = $conexao->query("SELECT Total FROM Carrinho WHERE Chave = $chave LIMIT 1");
$cont = $conexao->query("SELECT COUNT(*) FROM Carrinho WHERE Chave = $chave");

    $pdf->SetLeftMargin(7);
    $pdf->AddPage("PORTRAIT", 'A5');
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(135, 10, utf8_decode('SHOPDDN'),0,0.3,'C');
    $pdf->SetFont('Times', 'I', 16);
    $pdf->Cell(135, 10, utf8_decode('Recibo'),0,1,'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(5);
    $pdf->Write(3,"Data & Hora : ". $data);
    $pdf->Ln(7);
    $pdf->Write(3,"Cliente : ". $nome);
    $pdf->Ln(5);
    $pdf->SetTextColor(60, 133, 0);
    $pdf->SetFont('Times', '', 12.5);
    $pdf->Cell(135, 10, utf8_decode('Compra Efectuada com Sucesso!'),0,1,'C');
    $pdf->Ln(1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 11.5);
    
foreach($cont as $c){
    $pdf->Write(5, "Pagou por " . $c[0]. " produtos, respectivamente : ");
}


    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, "Produto",1,0, "C");
    $pdf->Cell(40, 7, "Descricao",1,0, "C");
    $pdf->Cell(20, 7, "Preco",1,0, "C");
    $pdf->Cell(15, 7, "Qtd",1,0, "C");
    $pdf->Cell(20, 7, "Sub-Total",1,0, "C");
    $pdf->Ln();

foreach($sql as $bbs){
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(40, 7, utf8_decode($bbs['Produtos']),1,0, "C");
    $pdf->Cell(40, 7, utf8_decode($bbs['Descricao']),1,0, "C");
    $pdf->Cell(20, 7, $bbs['Preco'] . "MT",1,0, "C");
    $pdf->Cell(15, 7, $bbs['Quantidade'],1,0, "C");
    $pdf->Cell(20, 7, $bbs['Subtotal']. "MT",1,0, "C");
    $pdf->Ln();
}

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(115, 7, "Total",1,0, "C");
foreach($total as $t){
    $pdf->Cell(20, 7, $t['Total']. "MT",1,0, "C");
}

    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(10);
    $pdf->Write(3,"Os seus produtos serao entregues dentro de 5 dias! Obrigado.");
    $pdf->Ln(5);
    $pdf->Write(3,"Continue desfrutando dos nossos produtos.");
    $pdf->Ln(5);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(125, 10, utf8_decode('Contactos (+258) : 846387041 & 872876066'),0,0.1,'C');
    $pdf->Cell(125, 10, utf8_decode('Loja Online Disponivel : http://shoproductsddn.rf.gd'),0,0,'C');

$pdf->Output();

unset($_SESSION['chave']);
unset($_SESSION['nome']);
unset($_SESSION['dta']);
unset($_SESSION['carrinho']);



?>