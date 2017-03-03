
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Buat Surat</li>
        </ol>
    </div><!--/.row-->

    <hr/>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php if(isset($_GET["err"])): ?>
                <div class="alert bg-danger" role="alert">
                    <svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Gagal mengirim surat! Coba lagi nanti <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <?php elseif(isset($_GET["succ"])):?>
                <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Surat berhasil dikirim ke tujuan! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <?php endif; ?>
                <div class="panel-heading">Isi detail surat</div>
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <p>Subjek : </p>
                            <input type="text" name="subjek" class="form-control" value="<?php echo (isset($_GET["sub"])) ? $_GET["sub"] : ""; ?>" autofocus required/><br />
                        </div>
                        <div class="col-md-6">
                            <p>Penerima : </p>
                            <select name="penerima[]" id="penerima" class="form-control" multiple required>
                                <?php foreach($daftar_pengguna as $daftar_dinas => $daftar_pengguna): ?>
                                    <optgroup label="<?php echo $daftar_dinas ?>">
                                        <?php foreach($daftar_pengguna as $pengguna):?>
                                            <option value="<?php echo $pengguna->id_pengguna; ?>" <?php echo (isset($_GET["pn"]) && $_GET["pn"] == $pengguna->id_pengguna) ? "selected" : ""; ?>><?php echo $pengguna->nama_lengkap . ", " . $pengguna->nama_jabatan . " - " . $daftar_dinas; ?></option>
                                        <?php endforeach;?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="checkbox" id="external" name="external">
                            <label for="external" style="text-decoration: none;">&raquo;&nbsp;Surat Eksternal (Centang bila benar)</label>
                            <div class="panel panel-blue" id="external_wrap">
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <p>Surat dari : </p>
                                        <input type="text" name="surat_dari" class="form-control" disabled required/><br />
                                    </div>
                                    <div class="col-md-6">
                                        <p>Tanggal Surat : </p>
                                        <input type="text" name="tanggal_surat" class="form-control tanggal" disabled required/><br />
                                    </div>
                                    <div class="col-md-6">
                                        <p>Tanggal Terima : </p>
                                        <input type="text" name="tanggal_terima" class="form-control tanggal" disabled required/><br />
                                    </div>
                                    <div class="col-md-6">
                                        <p>Nomor Surat : </p>
                                        <input type="text" name="nomor_surat" class="form-control" disabled required/><br />
                                    </div>
                                    <div class="col-md-6">
                                        <p>Nomor Agenda : </p>
                                        <input type="text" name="nomor_agenda" class="form-control" disabled required/><br />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <textarea name="isi_pesan" id="msg" required></textarea><br />
                            <p>Lampiran</p>
                            <input type="file" multiple id="attach" name="attach[]" class="form-control"><br />
                            <input type="submit" name="btnSubmit" class="btn btn-success" value="Kirim">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->

</div>	<!--/.main-->

<script>
    $(document).ready(function(){
        $("#external_wrap").hide();
        $("#msg").froalaEditor({
            height: 300
        });
        $("#penerima").select2();
        $("#attach").fileinput({'showUpload':false, 'previewFileType':'any'});

        $("#external").on("change",function(){
            if(this.checked){
                $("#external_wrap").slideDown();
                $("#external_wrap input").val("").prop("disabled",false);
            } else {
                $("#external_wrap").slideUp();
                $("#external_wrap input").val("").prop("disabled",true);
            }
        });

        $(".tanggal").datepicker({
            format: "yyyy-mm-dd"
        });
    })
</script>
