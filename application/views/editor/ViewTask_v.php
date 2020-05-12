<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>My Task List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Title</th>
          <th width="15%">Keywords</th>
          <th width="25%">Filename</th>
          <th width="10%">Date Submitted</th>
          <th width="11%">Pembayaran</th>
          <th width="10%">Action</th>
        </tr>
        <?php $i = 0; foreach ($tasks as $item) { $i++;?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $item->judul; ?></td>
            <td><?php echo $item->keywords; ?></td>
            <td> <a href="<?php echo base_url() . 'ApplicationCtl/Download/' . $item->id_task; ?>" target="_blank"><?php echo $item->file_loc; ?></a></td>
            <td><?php echo date_format(date_create($item->date_created), "jS F Y"); ?></td>
            <td style="text-align: center;">
              <?php
                echo "<a href='listPayment/".$item->id_task."'>->Cek Status<-</a>";
              ?>
              </td>
            <td> <a href="<?php echo base_url() . 'EditorCtl/SelectReviewer/' . $item->id_task; ?>">Select Reviewer</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>