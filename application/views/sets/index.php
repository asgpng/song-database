<form action="<?php echo site_url('sets/new_set'); ?>" class="form-inline" method="POST">
  <table class="table table-striped">
    <tr>
      <th>Date</th>
      <th>Event</th>
      <th>Theme</th>
    </tr>
    <?php foreach ($query->result() as $row): ?>
    <tr>
      <td>
        <?php echo anchor('sets/choose_songs/' . $row->id, $row->date); ?>
      </td>
      <td>
        <?php echo $row->event; ?>
      </td>
      <td>
        <?php echo $row->theme; ?>
      </td>
      <?php endforeach; ?>
    </tr>
    <tr>
      <td>
        <input type="text" name="date" placeholder="Date" />
      </td>
      <td>
        <input type="text" name="event" placeholder="Event" />
      </td>
      <td>
        <input type="text" name="theme" placeholder="Theme" />
    </tr>
  </table>
  <input type="submit" value="New Set">
</form>
