Showing <?php echo $query->num_rows() ?> of <?php echo $number_songs ?> songs in the database.<br>
<form action="<?php echo site_url('/music/insert_song'); ?>" method="POST">
  <table class="table table-striped">
    <tr>
      <th style="width: 20%"><?php echo anchor('music?order_by=title', 'Title') ?></th>
      <th style="width: 30%"><?php echo anchor('music?order_by=author', 'Author') ?></th>
      <th style="width: 20%"><?php echo anchor('music?order_by=producer', 'Producer') ?></th>
      <th style="width: 5%"><?php echo anchor('music?order_by=year', 'Year') ?></th>
      <th style="width: 5%"><?php echo anchor('music?order_by=ccli', 'CCLI') ?></th>
      <th style="width: 5%"><?php echo anchor('music?order_by=standard_key', 'Key') ?></th>
      <th style="width: 5%"><?php echo anchor('music?order_by=count', 'Count') ?></th>
      <th style="width: 10%"><?php echo anchor('music?order_by=last_done', 'Last Done') ?></th>
    </tr>
    <?php foreach ($query->result() as $row): ?>
    <tr>
      <td>
        <?php echo anchor('music/edit_song/'.$row->id, $row->title); ?>
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
      <td>
        <?php echo $this->set_songs->song_count($row->id); ?>
      </td>
      <td>
        <?php echo $this->set_songs->last_done($row->id); ?>
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
