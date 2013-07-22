<table class="table table-striped">
  <tr>
    <th>Title</th>
    <th>Lyrics Author</th>
    <th>Music Author</th>
    <th>Producer</th>
    <th>Year</th>
    <th>CCLI</th>
    <th>Standard Key</th>
  </tr>
  <?php foreach ($query->result() as $row): ?>
  <tr>
    <td>
      <?php echo $row->title; ?>
    </td>
    <td>
      <?php echo $row->author_lyrics; ?>
    </td>
    <td>
      <?php echo $row->author_music; ?>
    </td>
    <td>
      <?php echo $row->copyright_producer; ?>
    </td>
    <td>
      <?php echo $row->copyright_year; ?>
    </td>
    <td>
      <?php echo $row->ccli; ?>
    </td>
    <td>
      <?php echo $row->standard_key; ?>
    </td>
    <?php endforeach; ?>
  </tr>
</table>
