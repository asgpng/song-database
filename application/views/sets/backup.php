    <table class="table table-condensed">
      <tr>
        <th style="width: 60%">Current Set:</th>
        <th style="width: 40%"></th>
      </tr>
      <?php $i = 0 ?>
      <?php foreach ($current_songs->result() as $song): ?>
        <tr>
          <?php $i += 1 ?>
          <td><?php echo anchor('music/edit_song/'.$song->song_id, $song->title); ?></td>
          <td>
            <div class="btn-group">
              <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/switch_songs/' . $i . '/up/' . $set->id); ?>" >
                <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
                <img src="<?php echo base_url('static/img/up_arrow.png')?>" style="height: 10px; width: 10px;">
              </button>
              <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/switch_songs/' . $i . '/down/' . $set->id); ?>" >
                <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
                <img src="<?php echo base_url('static/img/down_arrow.png')?>" style="height: 10px; width: 10px;">
              </button>
              <button type="submit" formmethod="post" class="btn" formaction="<?php echo site_url('/sets/remove_from_set/' . $song->song_id . '/' . $set->id . '/' . $i); ?>" >
                <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_forward_next_icon -->
                <img src="<?php echo base_url('static/img/right_arrow.png')?>" style="height: 10px; width: 10px;">
              </button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
