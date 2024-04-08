<?php
//requiring the dependencies using the autoloader
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;


class PDFGenerator{
    //function that takes in parameters the html content and the pdf file name and 
    public static function generatePDF($html, $pdfName){
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("$pdfName.pdf");
    }
}