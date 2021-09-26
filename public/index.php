<?php require_once "/database.php"; ?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>PHP SQL</title>

    <style>
      <?php include "/public/css/bootstrap.min.css"; ?>
      <?php include "/public/css/bootstrap.min.css.map"; ?>
      <?php include "/public/css/styles.css"; ?>
    </style>

    <script>
      <?php include "/public/js/main.js"; ?>
    </script>
  </head>
  <body>

    <?php include_once "/requests.php"; ?>
    <?php include_once "/view_contacts.php"; ?>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <?php 
       $image = 'public/img/database.svg';
       $image_data = base64_encode(file_get_contents($image));
       $src = 'data: '.mime_content_type($image).';base64,'.$image_data;
       echo '<img src="',$src,'" width="50" height="80" class="d-inline-black align-text-top">';
       ?>
      <p>CRUD APP</p>
    </a>
  </div>
</nav>

    <div class="container">
      <div class="row">
          <div class="col-4">

            <div class="card">
              <div id="messages" class="card-header">
                <?php 
                 if(!empty($message_success)){
                 echo '<div class="alert alert-success">'.$message_success.'</div>';
                 }
                 
                 if(!empty($message_error)){
                 echo '<div class="alert alert-danger">'.$message_error.'</div>';               }
              ?>
              </div>

              <div class="card-body">
                <form method="post" action="requests.php" onsubmit="validate_form()">

                  <div class="mb3">
                    <input class="form-control" id="fullname" name="fullname" type="text" placeholder="Full name"/>          
                  </div>
                  <div class="mb3">
                    <input class="form-control" id="phone" name="phone" type="text" placeholder="Phone"/>
                  </div>
                  <div class="mb3">
                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"/>
                  </div>
                  <input class="form-control btn btn-primary" type="submit" value="Save"/>
                  <input id="register" name="register" type="number" value="0" style="visibility:hidden"/>
                  <input id="contact_id" name="contact_id" type="number" style="visibility:hidden">
                </form>
              </div>
            </div>

          </div>
          <div class="col-8">

            <div id="show_db">
              <table class="table table-striped table-bordered bg-white table-sm">
                <thead class="table-dark">
                  <tr>
                    <td>Fullname</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Operations</td>
                  </tr>
                </thead>
        
        <tbody>
          <?php
           while($row = pg_fetch_row($data))
          {
          echo "<tr><td>$row[1] </td> <td>$row[2]</td><td>$row[3]</td><td><a class='btn btn-success' href='delete_edit.php?id=$row[0]&flag=0'>Edit</a> <a class='btn btn-danger' href='" . htmlspecialchars('/delete_edit.php?id=' . urlencode($row[0])) . "&flag=1'>Delete</a></td></tr>";
}
           ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>

    <?php include_once "/delete_edit.php"; ?>    

    </div>
  </body>
</html>
