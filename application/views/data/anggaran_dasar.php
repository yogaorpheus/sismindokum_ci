<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anggaran Dasar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data</li>
        <li class="active">Anggaran Dasar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Anggaran Dasar</h3>
              <a href="<?php echo base_url('data/anggaran_dasar/download');?>">
                <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Tanggal RUPS Sirkuler</th>
                  <th>No. Akta</th>
                  <th>Tanggal Akta</th>
                  <th>No. Penerimaan Kemenkumham</th>
                  <th>PIC</th>
                  <th>Status Akta</th>
                  <th>Lampiran</th>
                  <th>Pengaturan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_anggaran_dasar as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tahun_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_rups_sirkuler']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_akta_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_akta_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_penerimaan_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['jabatan_pic']; ?></td>
                  <td style="vertical-align: middle;"><h4><span class="label label-success"><?php echo $onedata['nama_status']; ?></span></h4></td>
                  <td style="vertical-align: middle;" width="60px;">
                    <div class="col-md-6">
                      <?php 
                      if (!is_null($onedata['file_anggaran_1']) && !empty($onedata['file_anggaran_1']))
                      { 
                        echo "<button class='btn btn-primary btn-xs review' title='lampiran 1' href='".$onedata['file_anggaran_1']."'><i class='glyphicon glyphicon-zoom-in'></i></button>";
                      }
                      ?>
                    </div>
                    <div class="col-md-6">
                      <?php 
                      if (!is_null($onedata['file_anggaran_2']) && !empty($onedata['file_anggaran_2']))
                      {
                        echo "<button class='btn btn-primary btn-xs review' title='lampiran 2' href='".$onedata['file_anggaran_2']."'><i class='glyphicon glyphicon-zoom-in'></i></button>";
                      }
                      ?>
                    </div>
                  </td>
                  <td style="vertical-align: middle;" width="120px;">
                    <?php
                    foreach ($menu_tampil as $key => $one_menu) {

                      if ($this->uri->segment(1) == $menu_utama[$key]['nama_controller']) {
                        foreach ($one_menu as $key1 => $one_sub_menu) {
                          
                          if ($this->uri->segment(2) == $sub_menu[$key1]['nama_method']) {
                            foreach ($one_sub_menu as $key2 => $one_crud) {
                              
                              if ($one_crud['berhak'] && $menu_crud[$key2]['is_crud'] && ($menu_crud[$key2]['nama_menu_crud'] != "Review"))
                              {
                                echo "<a href='".base_url($menu_utama[$key]['nama_controller']."/".$sub_menu[$key1]['nama_method'].$menu_crud[$key2]['nama_concat_method']."/".$onedata['id_anggaran'])."' class='".$menu_crud[$key2]['nama_menu_crud']."' id='".$menu_crud[$key2]['nama_menu_crud'].$onedata['id_anggaran']."'>";
                                echo $menu_crud[$key2]['html'];
                                echo "</a>";
                              }
                            }
                          }
                        }
                      }
                    }
                    ?>
                  </td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Tanggal RUPS Sirkuler</th>
                  <th>No. Akta</th>
                  <th>Tanggal Akta</th>
                  <th>No. Penerimaan Kemenkumham</th>
                  <th>PIC</th>
                  <th>Status Akta</th>
                  <th>Lampiran</th>
                  <th>Pengaturan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="modal fade" id="modal_delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">HAPUS DATA</h4>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
              </div>
              <div class="modal-footer">
                <a id="delete_yes"><button type="button" class="btn btn-danger pull-left">Iya, Hapus</button></a>
                <button type="button" class="btn btn-success pull-right" data-dismiss="modal" id="delete_no">Tidak</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->
    <script>
      var delete_href = "";
      var delete_id = "";

    <?php
    if (!is_null($this->session->flashdata('error_msg')))
    {
      ?>alert("<?php echo $this->session->flashdata('error_msg'); ?>");<?php
    }
    ?>
      
      $(function () {
        
        $('#tabel1').DataTable()

        $(document).on("click", ".Delete", function() {
          delete_href = $(this).attr('href');
          delete_id = $(this).attr('id');
          $(this).attr('href', "#");
          $("#delete_yes").attr('href', delete_href);
        })

        $("#delete_no").click(function() {
          delete_id = "#" + delete_id;
          $(delete_id).attr('href', delete_href);
        })

        $(document).on("click", ".review", function() {
          var href = $(this).attr('href');
          return window.open(href);
        })

      })
    </script>