<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Reviewer List</h2>
      <br>
      <h5>Task Info :</h5>
      <h6>
        <?php foreach ($task as $row) { ?>
        <table>
          <tr>
            <td>Judul</td>
            <td>:</td>
            <td><?php echo $row['judul'];?></td>
          </tr>
          <tr>
            <td>Autors</td>
            <td>:</td>
            <td><?php echo $row['authors'];?></td>
          </tr>
          <tr>
            <td>Kata Kunci</td>
            <td>:</td>
            <td><?php echo $row['keywords'];?></td>
          </tr>
        </table>
      <?php } ?>
      </h6>
      <table border="1" align="center" width="50%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Nama Reviewer</th>
          <th width="10%">Status</th>
        </tr>
        <?php $i = 0; foreach ($list as $item) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo $item->nama; ?></td>
            <td style="text-align: center;">
              <?php if ($item->status == 0) {
                echo "Waiting Payment Process";
              } elseif ($item->status == 1) {
                echo "Waiting Reviewer Choice";
              } elseif ($item->status == 2) {
                echo "Review Progress by Reviewer";
              } elseif ($item->status == 3) {
                echo "Reviewer Reject Task";
              } elseif ($item->status == 4) {
                echo "Done Upload Reviewed Task";
              } elseif ($item->status == 5) {
                echo "Editor Reject Reviewed Task";
              } elseif ($item->status == 6) {
                echo "Task Completed";
              } ?>
                
              </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>