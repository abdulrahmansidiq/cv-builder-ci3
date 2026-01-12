<?php

require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

use Dompdf\Dompdf;

class Pdf
{

    public function create($html, $filename = 'document', $stream = true)
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename . ".pdf", ["Attachment" => 1]);
        } else {
            return $dompdf->output();
        }
    }
}
