<?php
  require ("../sql_connect.php");
?>
<html>
<body>
  <form method="POST" action="insertAdvocacy.php" enctype="multipart/form-data">
    Organization Name: <input type="text" name="advName" required><br>
    Icon <input type="file" name="advIcon" required><br>
    <input type="submit" name="submit" value="SUBMIT">
  </form>
</body>
</html>
