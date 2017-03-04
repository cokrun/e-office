
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li class="active">Surat Masuk</li>
    </ol>
</div><!--/.row--><br />

<div class="row" id="inbox-div">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Surat Masuk</div>
            <div class="panel-body">
                <table data-toggle="table" data-url="<?php //echo base_url("panel/json_inbox");?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="id_pesan"  data-sortable="true">Star</></th>
                        <th data-field="subjek"  data-sortable="true">Subjek</th>
                        <th data-field="isi_pesan"  data-sortable="true">Isi Pesan</th>
                        <th data-field="pengirim" data-sortable="true">Pengirim</th>
                        <th data-field="waktu" data-sortable="true">Waktu</th>
                        <th>Pilihan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($surat as $sr): ?>
                        <tr class="<?php echo ($sr->dibaca == 0) ? "warning" : ""; ?>">
                            <td><i class="fa fa-star fa-lg star <?php echo ($sr->starred == 1) ? "star-active" : ""; ?>" data-starred="<?php echo $sr->starred; ?>" data-id="<?php echo $sr->id_relasi_pesan; ?>"></i><span style="display: none;"><?php echo ($sr->starred == 1) ? $sr->id_relasi_pesan : 0; ?></span></td>
                            <td><?php echo $sr->subjek; ?></td>
                            <td><?php echo strip_tags(character_limiter($sr->isi_pesan,20)); ?></td>
                            <td><?php echo $sr->pengirim; ?></td>
                            <td><?php echo $sr->waktu_kirim; ?></td>
                            <td>
                                <a href="<?php echo base_url("panel/baca/" . $sr->id_pesan); ?>" class="btn btn-success">Baca</a>
<!--                                <a href="#" class="btn btn-warning">Hapus</a>-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/.row-->

</div><!--/.main-->

<script>
    $(document).ready(function(){

        $("#inbox-div").on("click",".star.fa-star",function(){
            var curStar = $(this);
            update_star(curStar);
            curStar.removeClass("fa-star").addClass("fa-spin fa-spinner");
        });

    });


    function update_star(curStar) {
        $.ajax({
            url: BASE_URL + "/ajax/update_star/",
            method: "POST",
            data: {
                id_relasi_pesan: curStar.data().id,
                starred: (curStar.data().starred == 1) ? 0 : 1
            },
            success: function(response){
                console.log(response);
                if(curStar.data().starred == 0) {
                    curStar.data("starred",1);
                    curStar.addClass("star-active");
                    curStar.parent().children("span").html(1)
                } else {
                    curStar.data("starred",0);
                    curStar.removeClass("star-active");
                    curStar.parent().children('span').html(0);
                }
                curStar.removeClass('fa-spin fa-spinner');
                curStar.addClass("fa-star");
            }
        })
    }

</script>