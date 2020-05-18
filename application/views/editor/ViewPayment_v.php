<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>My Payment List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Nama Task</th>
          <th width="11%">Status</th>
          <th width="10%">Tanggal</th>
          <th width="15%">Total Harga</th>
          <th width="10%">Pembayaran</th>
        </tr>
        <?php $i = 0; foreach ($payment as $row) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo $row->judul; ?></td>
            <td style="text-align: center;">
              <?php
              if ($row->status == 0) {
                echo "Menunggu Upload Bukti Pembayaran";
              } else if($row->status == 1) {
                echo "Menunggu Verifikasi";
              } elseif ($row->status == 2) {
               echo "Lunas<br><a href='". base_url(). "ApplicationCtl/buktiEditor/".$row->id_pembayaran."'>->Download Bukti Pembayaran<-</a>";
               echo "<br><a href='". base_url()."editorCtl/assignStatus/".$row->id_task."''>->Cek Status Reviewer<-</a>";
             } elseif ($row->status == 3) {
               echo "Bukti Pembayaran di tolak, silahkan upload ulang!";
             }
             ?>
           </td>
           <td style="text-align: center;"><?php echo date_format(date_create($row->date_created), "jS F Y");; ?></td>
           <td style="text-align: center;"><?php echo $row->amount; ?></td>
           <td style="text-align: center;">
            <?php if ($row->status == 0 || $row->status == 3) { ?>
              <form id="form" action="<?php echo base_url().'editorCtl/uploadBukti/'.$row->id_pembayaran.'/'.$row->id_task; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="<?php echo 'bukti'.$row->id_pembayaran; ?>" id="<?php echo 'bukti'.$row->id_pembayaran; ?>">
                <input class="btn" id="submit" style="float: right;" type="submit" name="submit" value="Uplaod Bukti Bayar">
              </form>
              <!-- <a class="btn" style="float: right;" href="">Gunakan Saldo Akun</a> -->
            <?php } else if($row->status == 1) { ?>
              <p>Bukti bayar sudah di upload. Sedang menunggu verifikasi.</p>
            <?php } else if($row->status == 2) { ?>
              <p>Pembayaran anda terverifikasi.</p>
            <?php }?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>
</section>