<form action="<?php echo site_url('sets/update_set'); ?>" class="form-inline" method="POST">
  <label for="date" class="control-label">Date</label>
  <input type="text" name="date" value="<?php echo $set->date; ?>" />
  <label for="event" class="control-label">Event</label>
  <input type="text" name="event" value="<?php echo $set->event; ?>" />
  <label for="theme" class="control-label">Theme</label>
  <input type="text" name="theme" value="<?php echo $set->theme; ?>" />
  <input type="hidden" name="id" value="<?php echo $set->id; ?>" >
  <input type="submit" value="Update Set">
</form>
<div id="current_set">
  <table class="table table-condensed">
    <tr>
      <th>Current Set:</th>
    </tr>
  <?php foreach ($current_songs as $song): ?>
    <tr>
      <td><?php echo $song->title; ?></td>
    </tr>
  <?php endforeach; ?>
  </table>
</div>
<div id="songs">
  <form>
    <table class="table table-condensed">
      <tr>
        <th></th>
        <th>Title</th>
        <th>Author</th>
        <th>Producer</th>
        <th>Key</th>
      </tr>
      <?php foreach ($songs->result() as $song): ?>
      <tr>
        <td>
          <button type="submit" formmethod="post" formaction="<?php echo site_url('/sets/add_to_set/' . $song->id . '/' . $set->id); ?>">
            <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_back_previous_icon -->
            <img src="<?php echo base_url('application/static/img/left_arrow.png')?>" width="10" height="10">
          </button>
          <!-- <i class="icon-arrow-left"></i> -->
        </td>
        <td>
          <?php echo anchor('music/codemirror/'.$song->id, $song->title); ?>
        </td>
        <td>
          <?php echo $song->author; ?>
        </td>
        <td>
          <?php echo $song->producer; ?>
        </td>
        <td>
          <?php echo $song->standard_key; ?>
        </td>

      </tr>
      <?php endforeach; ?>
    </table>
  </form>
</div>
