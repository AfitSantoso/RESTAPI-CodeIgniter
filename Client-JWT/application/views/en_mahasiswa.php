<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>

    <!-- import file "style.css" -->
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css")?>" />
</head>
<body>
    <!-- buat area menu -->
    <nav class="area-menu">
        <button id="btn_lihat" class="btn-primary">Lihat Data</button>
        <button id="btn_refresh" class="btn-secondary" onclick="return setRefresh()">Refresh Data</button>
    </nav>

    <!-- buat area untuk entry data mahasiswa -->
    <main class="area-grid">
        <section class="item-label1">
            <label id="lbl_npm" for="txt_npm">
                NPM :
            </label>
        </section>
        <section class="item-input1">
            <input type="text" id="txt_npm" class="text-input" maxlength="9">
        </section>
        <section class="item-error1">
            <p id="err_npm" class="error-info"></p>
        </section>

        <section class="item-label2">
            <label id="lbl_nama" for="txt_nama">
                Nama Mahasiswa :
            </label>
        </section>
        <section class="item-input2">
            <input type="text" id="txt_nama" class="text-input" maxlength="100">
        </section>
        <section class="item-error2">
            <p id="err_nama" class="error-info"></p>
        </section>

        <section class="item-label3">
            <label id="lbl_telepon" for="txt_telepon">
                Telepon Mahasiswa :
            </label>
        </section>
        <section class="item-input3">
            <input type="text" id="txt_telepon" class="text-input" maxlength="15" onkeypress="return setNumber(event)">
        </section>
        <section class="item-error3">
            <p id="err_telepon" class="error-info"></p>
        </section>

        <section class="item-label4">
            <label id="lbl_jurusan" for="cbo_jurusan">
                Jurusan Mahasiswa :
            </label>
        </section>
        <section class="item-input4">
            <select id="cbo_jurusan" class="select-input">
                <option value="-">Pilih Jurusan Mahasiswa</option>
                <option value="IF">Informatika</option>
                <option value="TI">Teknologi Informasi</option>
                <option value="SI">Sistem Informasi</option>
                <option value="TK">Teknik Komputer</option>
                <option value="SIA">Sistem Informasi Akuntansi</option>
            </select>
        </section>
        <section class="item-error4">
            <p id="err_jurusan" class="error-info"></p>
        </section>
    </main>

    <!-- buat area menu -->
    <nav class="area-menu" style="margin-top: 10px;">
        <button id="btn_simpan" class="btn-primary">Simpan Data</button>        
    </nav>
    
    <!-- import file "script.js" -->
    <script src="<?php echo base_url("ext/script.js"); ?>"></script>

    <script>
        // inisialisasi object
        let btn_lihat = document.getElementById("btn_lihat");
        let btn_simpan = document.getElementById("btn_simpan");

        // buat event untuk "btn_lihat"
        btn_lihat.addEventListener('click',function(){
            // alihkan ke halaman view mahasiswa
            location.href='<?php echo base_url(); ?>'
        });

        // buat fungsi untuk refresh
        function setRefresh()
        {
            location.href='<?php echo site_url("Mahasiswa/addMahasiswa"); ?>'

       
        }

        // buat event untuk "btn_simpan"
        btn_simpan.addEventListener('click',function(){
            // inisialisasi object
            let lbl_npm = document.getElementById("lbl_npm");
            let txt_npm = document.getElementById("txt_npm");
            let err_npm = document.getElementById("err_npm");

            let lbl_nama = document.getElementById("lbl_nama");
            let txt_nama = document.getElementById("txt_nama");
            let err_nama = document.getElementById("err_nama");

            let lbl_telepon = document.getElementById("lbl_telepon");
            let txt_telepon = document.getElementById("txt_telepon");
            let err_telepon = document.getElementById("err_telepon");

            let lbl_jurusan = document.getElementById("lbl_jurusan");
            let cbo_jurusan = document.getElementById("cbo_jurusan");
            let err_jurusan = document.getElementById("err_jurusan");
            

            // jika npm tidak diisi
            if(txt_npm.value === "")
            {
                err_npm.style.display = 'unset';
                err_npm.innerHTML = "NPM Harus Diisi !";
                lbl_npm.style.color = "#FF0000";
                txt_npm.style.borderColor = "#FF0000";
            }
            // jika npm diisi
            else
            {
                err_npm.style.display = 'none';
                err_npm.innerHTML = "";
                lbl_npm.style.color = "unset";
                txt_npm.style.borderColor = "unset";
            }
            
            // ternary operator
            const nama = (txt_nama.value === "") ?
            [
                err_nama.style.display = 'unset',
                err_nama.innerHTML = "Nama Mahasiswa Harus Diisi !",
                lbl_nama.style.color = "#FF0000",
                txt_nama.style.borderColor = "#FF0000",            
            ]
            :
            [
                err_nama.style.display = 'none',
                err_nama.innerHTML = "",
                lbl_nama.style.color = "unset",
                txt_nama.style.borderColor = "unset",                
            ]

            const telepon = (txt_telepon.value === "") ?
            [
                err_telepon.style.display = 'unset',
                err_telepon.innerHTML = "Telepon Mahasiswa Harus Diisi !",
                lbl_telepon.style.color = "#FF0000",
                txt_telepon.style.borderColor = "#FF0000",            
            ]
            :
            [
                err_telepon.style.display = 'none',
                err_telepon.innerHTML = "",
                lbl_telepon.style.color = "unset",
                txt_telepon.style.borderColor = "unset",                
            ]

            const jurusan = (cbo_jurusan.selectedIndex === 0) ?
            [
                err_jurusan.style.display = 'unset',
                err_jurusan.innerHTML = "Jurusan Mahasiswa Harus Dipilih !",
                lbl_jurusan.style.color = "#FF0000",
                cbo_jurusan.style.borderColor = "#FF0000",            
            ]
            :
            [
                err_jurusan.style.display = 'none',
                err_jurusan.innerHTML = "",
                lbl_jurusan.style.color = "unset",
                cbo_jurusan.style.borderColor = "unset",                
            ]
            
            // jika semua komponen terisi
            if(err_npm.innerHTML === "" && nama[1] === "" && telepon[1] === "" && jurusan[1] === "")
            {
                // panggil method setSave
                setSave(txt_npm.value,txt_nama.value,txt_telepon.value,cbo_jurusan.value);
            }            
        });

        const setSave = (npm,nama,telepon,jurusan) => {
            // buat variabel untuk form
            let form = new FormData();

            // isi/tambah nilai untuk form
            form.append("npmnya",npm);
            form.append("namanya",nama);
            form.append("teleponnya",telepon);
            form.append("jurusannya",jurusan);

            // proses kirim data ke controller
            fetch('<?php echo site_url("Mahasiswa/setSave"); ?>',{
                method: "POST",
                body: form
            })
    .then((response) => response.json())        
    .then((result) => alert(result.statusnya))    
    .catch((error) => alert("Data Gagal Dikirim !"))
        }        
        
                
    </script>
</body>
</html>