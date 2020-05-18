<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>My Task List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Judul</th>
          <th width="15%">Keywords</th>
          <th width="15%">Authors</th>
          <th width="15%">Nama Editor</th>
          <th width="10%">Date Submitted</th>
          <th width="10%">Download File</th>
          <th width="10%">Action</th>
        </tr>
        <?php $i = 0; foreach ($list as $item) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo $item->judul; ?></td>
            <td style="text-align: center;"><?php echo $item->keywords; ?></td>
            <td style="text-align: center;"><?php echo $item->authors;?></td>
            <td style="text-align: center;"><?php echo $item->nama ?></td>
            <td style="text-align: center;"><?php echo date_format(date_create($item->date_created), "jS F Y"); ?></td>
            <td style="text-align: center;"> <a href="<?php echo base_url() . 'ApplicationCtl/Download/' . $item->id_task; ?>" target="_blank">->Download<-</a></td>
            <td style="text-align: center;"> <a href="<?php echo base_url() . 'MakelarCtl/ViewReviewer/' . $item->id_task; ?>">->List Reviewer<-</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>