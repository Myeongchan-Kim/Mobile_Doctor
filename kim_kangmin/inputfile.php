<html>
<body>
<form action="Real.php" Method="POST">
      <center><h1>Please input your data <br>(User_id , start timerange, end timerange)</h1><br></center>
      <center><input type="text" name="passdata">
      <select Name="timerange">
          <option value = "selected">Start time</option>
          <?php
          for($i=0;$i<10;$i++){
              $j=$i+1;
              echo "<option value = 2016-0".$i.">2016-".$j."</option>";
          }
          for($i=10;$i<12;$i++){
              $j=$i+1;
              echo "<option value = 2016-".$i.">2016-".$j."</option>";
          }
          ?>
          <?php
          for($i=0;$i<7;$i++){
              $j=$i+1;
              echo "<option value = 2017-0".$i.">2017-".$j."</option>";
          }
          ?>
      </select>
    <select Name="timerange2">
        <option value = "selected">End time</option>
        <?php
        for($i=1;$i<9;$i++){
            $j=$i+1;
            echo "<option value = 2016-0".$j.">2016-".$i."</option>";
        }
        for($i=9;$i<13;$i++){
            $j=$i+1;
            echo "<option value = 2016-".$j.">2016-".$i."</option>";
        }
        ?>
        <?php
        for($i=1;$i<8;$i++){
            $j=$i+1;
            echo "<option value = 2017-0".$j.">2017-".$i."</option>";
        }
        ?>
    </select>
      <input type="submit" value="Submit"></center>
</form>
</body>
</html>
