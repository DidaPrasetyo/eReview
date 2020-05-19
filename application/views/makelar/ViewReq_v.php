<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Payment List</h2>
      <table border="1" width="75%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Nama User</th>
          <th width="10%">Jumlah</th>
          <th width="10%">Nomer Rekening</th>
          <th width="10%">Status</th>
          <th width="15%">Bukti Transfer</th>
        </tr>
        <?php $i = 0; foreach ($list as $row) { $i++;?>
          <tr>
            <td style="text-align: center;">
              <?php echo $i; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->nama; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->amount ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->no_rek; ?>
            </td>
            <td style="text-align: center;">
              <?php if ($row->status == 1) {
              	echo "Menunggu Upload Bukti Penarikan";
              } else {
              	echo "Proses Transfer Selesai";
              } ?>
            </td>
            <td style="text-align: center;">
              <?php if ($row->status == 1) {?>
              	<form id="form" action="<?php echo base_url().'MakelarCtl/fundAcc/'.$row->id_penarikan; ?>" method="post" enctype="multipart/form-data">
                  <input type="file" name="<?php echo 'buktitf'.$row->id_penarikan; ?>" id="<?php echo 'buktitf'.$row->id_penarikan; ?>">
                  <input class="btn" id="submit" style="float: right;" type="submit" name="submit" value="Submit">
                </form>
              <?php } else {
              	echo "-----";
              } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>