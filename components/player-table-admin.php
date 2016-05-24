<?php
  $pid = $_GET['pid'];

  $sql = "SELECT *
          FROM players";

  $players = array();
  if (!$result = $mysqli->query($sql)) {
    console('Players: '.$mysqli->connect_errno, 'error');
    console('Players: '.$mysqli->connect_error, 'error');
  } else {
    while ($row = $result->fetch_assoc()) {
      array_push($players, $row);
    }
  }
?>

<table id="players-table" class="display responsive nowrap table table-compact table-striped">
  <thead>
    <tr>
      <th>
        <span>Bib#</span>
      </th>
      <th>
        <span>Name</span>
      </th>
      <th>
        <span>Age</span>
      </th>
      <th>
        <span>Weight</span>
      </th>
      <th>
        <span>Height</span>
      <th>
        Speed
      </th>
      <th>
        Jump
      </th>
      <th>
        Leap
      </th>
      <th>
        Push Ups
      </th>
      <th>
        Stn 5
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($players as $person) { ?>
        <a>
          <tr onclick="window.document.location='?pid=<?php echo $person['id'] ?>'"
              class="clickable <?php echo ($pid === $person['id']) ? 'warning':''?>">
            <td><?php echo tripleDigit($person['bib']) ?></td>
            <td><?php echo $person['lastname'].', '.$person['firstname'] ?></td>
            <td><?php echo $person['age'] ?: '' ?></td>
            <td><?php echo round($person['weight']) ?: '' ?></td>
            <td><?php echo round($person['height']) ?: '' ?></td>
            <td><?php echo round($person['speed'],1) ?: '' ?></td>
            <td><?php echo round($person['jump'],1) ?: '' ?></td>
            <td><?php echo round($person['leap'],1) ?: '' ?></td>
            <td><?php echo round($person['pu']) ?: '' ?></td>
            <td><?php echo round($person['stn']) ?: '' ?></td>
          </tr>
        </a>
    <?php } ?>
  </tbody>
</table>

<script>
  $(document).ready(function() {
    $datatable = $('#players-table').DataTable({
      dom: '<f<t>>',
      responsive: true,
      paging: false,
      scrollY: "240px",
      scrollCollapse: true,
      tabIndex: -1,
      colReorder: true,
      order: [[0, 'asc']],
      columns: [
        {
          name: 'bib',
          searchable: true
        },
        {
          name: 'full-name',
          searchable: true
        },
        {
          name: 'age',
          searchable: true
        },
        {
          name: 'weight',
          searchable: false
        },
        {
          name: 'height',
          searchable: false
        },
        {
          name: 'speed',
          searchable: false
        },
        {
          name: 'jump',
          searchable: false
        },
        {
          name: 'leap',
          searchable: false
        },
        {
          name: 'pushups',
          searchable: false
        },
        {
          name: 'stn-5',
          searchable: false
        },
      ]
    });
  });
</script>