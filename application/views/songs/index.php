<form action="<?php echo site_url('/music/insert_song'); ?>" method="POST">
  <table class="table table-striped">
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Producer</th>
      <th>Year</th>
      <th>CCLI</th>
      <th>Key</th>
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
    <tr>

      <td>
        <input type="text" name="title" placeholder="Title" class="input-medium" />
      </td>
      <td>
        <input type="text" name="author" placeholder="Author" class="input-medium" />
      </td>
      <td>
        <input type="text" name="producer" placeholder="Producer" class="input-medium" />
      </td>
      <td>
        <input type="text" name="year" placeholder="Year" class="input-mini" />
      </td>
      <td>
        <input type="text" name="ccli" placeholder="CCLI" class="input-mini" />
      </td>
      <td>
        <input type="text" name="standard_key" placeholder="Key" class="input-mini" />
      </td>
    </tr>
  </table>
  <div class="control-group">
    <!-- <input type="submit" value="New Song" /> -->
    <button type="submit" class="btn">New Song</button>
  </div>
</form>
