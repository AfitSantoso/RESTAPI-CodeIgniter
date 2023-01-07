<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
	// buat variabel global
	var $key_name = 'KEY-API';
	var $key_value = 'RESTAPI';
	var $key_bearer = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2NzMwNjgzMTR9.3YoGyfEmULOOlr_Nk3DNBB-y7KeOu-_QXy_6FrjDpoM';


	public function index()
	{
		$this->client->http_header($this->key_bearer);

		$data["tampil"] = json_decode($this->client->simple_get(APIMAHASISWA, [$this->key_name => $this->key_value]));

		if ($data["tampil"]->result == 0) {
			//echo $data["tampil"]->error;
			echo "<script>location.href='https://google.com'</script>";
		} else {
			$this->load->view('vw_mahasiswa', $data);
		}
	}

	function setDelete()
	{
		$this->client->http_header($this->key_bearer);

		// buat variabel json
		$json = file_get_contents("php://input");
		$hasil = json_decode($json);


		$delete = json_decode($this->client->simple_delete(APIMAHASISWA, array("npm" => $hasil->npmnya, $this->key_name => $this->key_value)));

		if ($delete->result == 0) {
			echo json_encode(array("statusnya" => $delete->error));
		} else {
			echo json_encode(array("statusnya" => $delete->status));
		}
	}

	function addMahasiswa()
	{
		$this->load->view('en_mahasiswa');
	}

	// buat fungsi untuk simpan data mahasiswa
	function setSave()
	{
		$this->client->http_header($this->key_bearer);

		// baca nilai dari fetch
		$data = array(
			"npm" => $this->input->post("npmnya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponnya"),
			"jurusan" => $this->input->post("jurusannya"),
			"token" => $this->input->post("npmnya"),
			$this->key_name => $this->key_value
		);

		$save = json_decode($this->client->simple_post(APIMAHASISWA, $data));

		if ($save->result == 0) {
			echo json_encode(array("statusnya" => $save->error));
		} else {
			echo json_encode(array("statusnya" => $save->status));
		}
	}

	// fungsi untuk update data
	function updateMahasiswa()
	{
		$this->client->http_header($this->key_bearer);

		// ambil nilai npm
		$token = $this->uri->segment(3);

		$tampil = json_decode($this->client->simple_get(APIMAHASISWA, array("npm" => $token, $this->key_name => $this->key_value)));

		if ($tampil->result == 0) {
			echo $tampil->error;
		} else {

			foreach ($tampil->mahasiswa as $result) {
				// echo $result->nama_mhs."<br>";
				$data = array(
					"npm" => $result->npm_mhs,
					"nama" => $result->nama_mhs,
					"telepon" => $result->telepon_mhs,
					"jurusan" => $result->jurusan_mhs,
					"token" => $token,
				);
			}
			$this->load->view('up_mahasiswa', $data);
		}
	}

	// buat fungsi untuk ubah data mahasiswa
	function setUpdate()
	{
		$this->client->http_header($this->key_bearer);

		// baca nilai dari fetch
		$data = array(
			"npm" => $this->input->post("npmnya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponnya"),
			"jurusan" => $this->input->post("jurusannya"),
			"token" => $this->input->post("tokennya"),
			$this->key_name => $this->key_value
		);

		$update = json_decode($this->client->simple_put(APIMAHASISWA, $data));

		// kirim hasil ke "up_mahasiswa"
		if ($update->result == 0) {
			echo json_encode(array("statusnya" => $update->error));
		} else {
			echo json_encode(array("statusnya" => $update->status));
		}
	}
}
