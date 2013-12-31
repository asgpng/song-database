Showing <?php echo $query->num_rows() ?> of <?php echo $number_songs ?> songs in the database.<br>
<form id="form_tag_editor_big" action="<?php echo site_url('/music/update_tags'); ?>" method="POST">
  <table class="table table-striped">
    <tr>
      <th style="width: 30%"><?php echo anchor('music?order_by=title', 'Title') ?></th>
      <th style="width: 30%"><?php echo anchor('music?order_by=author', 'Author') ?></th>
      <th style="width: 10%"><?php echo anchor('music?order_by=year', 'Year') ?></th>
      <th style="width: 10%"><?php echo anchor('music?order_by=standard_key', 'Key') ?></th>
      <th style="width: 20%">Tags</th>
    </tr>
    <?php foreach ($query->result() as $song): ?>
    <tr>
      <td>
        <?php echo anchor('music/edit_song/'.$song->id, $song->title); ?>
      </td>
      <td>
        <?php echo $song->author; ?>
      </td>
      <td>
        <?php echo $song->year; ?>
      </td>
      <td>
        <?php echo $song->standard_key; ?>
      </td>
      <td>
        <input type="text" name="tag" placeholder="<?php echo $this->song_tag->string_tags_of_song($song->id); ?>" alt="<?php echo $song->id; ?>">
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
        <input type="text" name="year" placeholder="Year" class="input-mini" />
      </td>
    </tr>
  </table>
  <div class="control-group">
    <!-- <input type="submit" value="New Song" /> -->
    <button type="submit" class="btn">New Song</button>
  </div>
</form>
