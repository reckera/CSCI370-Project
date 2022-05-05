<hr>
    <form method='GET'>
    <label>Choose a service to view availability.</label>
    <select name="service">
    <?php
      $sql = 'SELECT servNo, service FROM service '.
	  'WHERE servNo IN (SELECT MAX(servNo) FROM service GROUP BY service);';
      $statement = $pdo->query($sql);
      $services = array();
      while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $services[$row['servNo']] = $row['service'];
      }
      
      foreach($services as $servNo => $service){
        echo '    <option value="' . $servNo . '">' . $service . '</option><br>';
        echo "\n";
      }
    ?>
    
	</select>
    <input type="submit" value="View" />
    </form>

<?php
    if(!isset($_GET['shopNo'])){
      echo '<h2>No shop selected.</h2>';
    }else{
      $sql = 'SELECT startD, startT, endD, endT, shopName '.
          'FROM reservation r '.
          'INNER JOIN shop s on s.shopNo = r.shopNo '.
          'WHERE r.shopNo = ?;';
      $statement = $pdo->prepare($sql);
      $statement->bindValue(1, $_GET['shopNo']);
    
      try{
        $ret = $statement->execute();
      }catch(Exception $e){
        echo "Lookup error: ", $e->getMessage();
      }
  
      $occupied = array_fill(0,25,0); // 1-24, ignore position 0
      $shopName = "Invalid";
      while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        for($i = $row['startT']; $i <= $row['endT']; $i++){
          $occupied[$i] = 1;
        }
        $shopName = $row['shopName'];
      }
      echo "<br>Chosen shop: $shopName";
      echo '<table class="occupied">';
      echo '<tr>';
      echo '<th>midnight</th><th>1 am</th><th>2 am</th><th>3 am</th><th>4 am</th>';
      echo '<th>5 am</th><th>6 am</th><th>7 am</th><th>8 am</th><th>9 am</th>';
	  echo '<th>10 am</th><th>11 am</th><th>noon</th><th>1 pm</th><th>2 pm</th>';
	  echo '<th>3 pm</th><th>4 pm</th><th>5 pm</th><th>6 pm</th><th>7 pm</th>';
	  echo '<th>8 pm</th><th>9 pm</th><th>10 pm</th><th>11 pm</th></tr><tr>';
      for($i = 1; $i <= 25; $i++){
        if($occupied[$i] == 1){
          echo '<td class="taken">-' . $i .'-</td>';
        else{
          echo '<td>' . $i .'</td>';
        }
      }
      echo '</tr></table>';
    }