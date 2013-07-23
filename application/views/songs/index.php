<table class="table table-striped">
  <tr>
    <th>Title</th>
    <th>Author</th>
    <th>Producer</th>
    <th>Year</th>
    <th>CCLI</th>
    <th>Standard Key</th>
  </tr>
  <?php foreach ($query->result() as $row): ?>
  <tr>
    <td>
      <?php echo anchor('music/codemirror/'.$row->id, $row->title); ?>
    </td>
    <td>
      <?php echo $row->author; ?>
    </td>
    <td>
      <?php echo $row->producer; ?>
    </td>
    <td>
      <?php echo $row->year; ?>
    </td>
    <td>
      <?php echo $row->ccli; ?>
    </td>
    <td>
      <?php echo $row->standard_key; ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
