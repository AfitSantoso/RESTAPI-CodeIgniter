<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'controllers/Token.php';

class Mahasiswa extends Token
{
    // buat konstruktor
    public function __construct()
    {
        parent::__construct();

        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa", "model", TRUE);

    }

    // buat fungsi "GET"
    function service_get()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil paramater token "(npm)"
            $token = $this->get("npm");

            // panggil fungsi "get_data"
            $hasil = $this->model->get_data(base64_encode($token));

            $this->response(array("mahasiswa" => $hasil, "result" => 1, "error" => ""), 200);
        }
    }


    //buat fungsi "POST"
    function service_post()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {

            // ambil parameter data yang akan diisi
            $data = array(
                "npm" => $this->post("npm"),
                "nama" => $this->post("nama"),
                "telepon" => $this->post("telepon"),
                "jurusan" => $this->post("jurusan"),
                "token" => base64_encode($this->post("npm")),
            );

            // panggil method "save_data"
            $hasil = $this->model->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
            // jika hasil = 0
            if ($hasil == 0) {
                $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan", "result" => 1, "error" => ""), 200);
            }
            // jika hasil != 0
            else {
                $this->response(array("status" => "Data Mahasiswa Gagal Disimpan !", "result" => 1, "error" => ""), 200);
            }
        }
    }
    //buat fungsi "PUT"
    function service_put()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil parameter data yang akan diisi
            $data = array(
                "npm" => $this->put("npm"),
                "nama" => $this->put("nama"),
                "telepon" => $this->put("telepon"),
                "jurusan" => $this->put("jurusan"),
                "token" => base64_encode($this->put("token")),
            );

            // panggil method "update_data"
            $hasil = $this->model->update_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);

            // jika hasil = 0
            if ($hasil == 0) {
                $this->response(array("status" => "Data Mahasiswa Berhasil Diubah", "result" => 1, "error" => ""), 200);
            }
            // jika hasil != 0
            else {
                $this->response(array("status" => "Data Mahasiswa Gagal Diubah !", "result" => 1, "error" => ""), 200);
            }
        }
    }
    //buat fungsi "DELETE"
    function service_delete()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil paramater token "(npm)"
            $token = $this->delete("npm");
            // panggil fungsi "delete_data"
            $hasil = $this->model->delete_data(base64_encode($token));
            // jika proses delete berhasil
            if ($hasil == 1) {
                $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus", "result" => 1, "error" => ""), 200);
            }
            // jika proses delete gagal
            else {
                $this->response(array("status" => "Data Mahasiswa Gagal Dihapus !", "result" => 1, "error" => ""), 200);
            }
        }
    }
}
