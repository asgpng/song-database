<form>
  <table class="table table-striped">
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Producer</th>
      <th>Year</th>
      <th>CCLI</th>
      <th>Delete</th>
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

        <button type="submit" formmethod="post" formaction="<?php echo site_url('/music/delete/' . $row->id); ?>" >
          <img src="<?php echo base_url('application/static/img/glyphicons_free/glyphicons/png/glyphicons_207_remove_2.png')?>" width="10" height="10">
        </button>

      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</form>
