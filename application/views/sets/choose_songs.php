<form action="<?php echo site_url('sets/update_set'); ?>" class="form-inline" method="POST">
  <label for="date" class="control-label">Date</label>
  <input type="text" name="date" id="datepicker" onchange="this.form.submit()" value="<?php echo $set->date; ?>" />
  <label for="event" class="control-label">Event</label>
  <input type="text" name="event" onchange="this.form.submit()" value="<?php echo $set->event; ?>" />
  <label for="theme" class="control-label">Theme</label>
  <input type="text" name="theme" onchange="this.form.submit()" value="<?php echo $set->theme; ?>" />
  <input type="hidden" name="id" value="<?php echo $set->id; ?>" >
  <!-- <input type="submit" value="Update Set"> -->
</form>
Showing <?php echo $songs->num_rows() ?> of <?php echo $number_songs ?> songs in the database.<br>
<div id="current_set">
  <form>
    <table class="table table-condensed">
      <tr>
        <th style="width: 60%">Current Set:</th>
        <th style="width: 40%"></th>
        <!-- <th></th> -->
        <!-- <th></th> -->
      </tr>
      <?php $i = 0 ?>
      <?php foreach ($current_songs->result() as $song): ?>
      <tr>
        <?php $i += 1 ?>
        <td><?php echo anchor('music/codemirror/'.$song->song_id, $song->title); ?></td>
        <td>
          <div class="btn-group">
            <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/switch_songs/' . $i . '/up/' . $set->id); ?>" >
              <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
              <img src="<?php echo base_url('application/static/img/up_arrow.png')?>" width="10" height="10">
            </button>
            <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/switch_songs/' . $i . '/down/' . $set->id); ?>" >
              <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
              <img src="<?php echo base_url('application/static/img/down_arrow.png')?>" width="10" height="10">
            </button>
            <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/remove_from_set/' . $song->song_id . '/' . $set->id . '/' . $i); ?>" >
              <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
              <img src="<?php echo base_url('application/static/img/right_arrow.png')?>" width="10" height="10">
            </button>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </form>
</div>
<div id="songs">
  <form>
    <table class="table table-condensed">
      <tr>
        <th style="width: 7%"></th>
        <th style="width: 23%"><?php echo anchor('sets/choose_songs/' . $set->id . '?order_by=title', 'Title') ?></th>
        <th style="width: 40%"><?php echo anchor('sets/choose_songs/' . $set->id . '?order_by=author', 'Author') ?></th>
        <th style="width: 25%"><?php echo anchor('sets/choose_songs/' . $set->id . '?order_by=producer', 'Producer') ?></th>
        <th style="width: 5%">Key</th>
      </tr>
      <?php foreach ($songs->result() as $song): ?>
      <tr>
        <td>
          <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/add_to_set/' . $song->id . '/' . $set->id); ?>">
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
