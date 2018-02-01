<?php

  require ("sql_connect.php");
  include ("Header.php");

  $page=$_REQUEST['page'];

  if ($page < 1)
  {
  $page = 1;
  }
  $resultsPerPage =5;
  $startResults = ($page - 1) * $resultsPerPage;
  $numberOfRows = mysql_num_rows(mysql_query('SELECT * FROM user WHERE user_type ='organization'));
  
  $totalPages = ceil($numberOfRows / $resultsPerPage);
  echo"<center><table border='1' bordercolor='blue' height='90%' width='90%'> <tr><th     bgcolor='silver'>Name</th><th bgcolor='silver'>Password</th><th      bgcolor='silver'>Question</th><th bgcolor='silver'> Answer</th><th        bgcolor='silver'>Image</th> </tr>";
$i=1;
$result= mysql_query("SELECT * FROM password LIMIT   $startResults,        $resultsPerPage");

 while($row=mysql_fetch_array($result))
       {

   }

   echo"</tr></table></center>";

      echo '<center><a href="?page=1">First</a>&nbsp';

  if($page > 1)
  echo '<a href="?page='.($page - 1).'">Back</a>&nbsp';

  for($i = 1; $i <= $totalPages; $i++)
      {
if($i == $page)
  echo '<strong>'.$i.'</strong>&nbsp';
 else
   echo '<a href="?page='.$i.'">'.$i.'</a>&nbsp';
     }

  if ($page < $totalPages)
  echo '<a href="?page='.($page + 1).'">Next</a>&nbsp;';

   echo '<a href="?page='.$totalPages.'">Last</a></center>';
 ?>