<?php

class Fungsi
{

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

    // function PdfGenerator($html, $filename, $papper, $orientation)
    // {
    //     $dompdf = new  Dompdf\Dompdf();
    //     $dompdf->loadHtml($html);

    //     // (Optional) Setup the paper size and orientation
    //     $dompdf->setPaper($papper, $orientation);

    //     // Render the HTML as PDF
    //     $dompdf->render();

    //     ob_end_clean();
    //     // Output the generated PDF to Browser
    //     $dompdf->stream($filename, ['Attachment' => 0]);
    // }
    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        $options = new Dompdf\Options();
        $options->setDefaultFont('courier');
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf\Dompdf();
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function count_item()
    {
        $this->ci->load->model('item_m');
        return $this->ci->item_m->get()->num_rows();
    }
    public function count_supplier()
    {
        $this->ci->load->model('supplier_m');
        return $this->ci->supplier_m->get()->num_rows();
    }
    // public function count_sale()
    // {
    //     $this->ci->load->model('laporan_m');
    //     return $this->ci->sale_m->get()->num_rows();
    // }
    public function count_user()
    {
        $this->ci->load->model('user_m');
        return $this->ci->user_m->get()->num_rows();
    }
}