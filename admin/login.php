<?php
include 'top.php';

$sql = 'SELECT pmkAdmin ';
$sql .= 'FROM tblAdminLogin';

$data = '';
$admins = $thisDatabaseReader->select($sql, $data);

function getData($field){
    if(!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

?>

<main>
  <form action= "<?php
  if(isset($_POST['btnSubmit'])){
      //print 'admin.php';
      $adminUser = filter_var($_POST['txtLogIn'], FILTER_SANITIZE_STRING);
      foreach ($admins as $admin){
        // print '<p>' .$admin['pmkAdmin'] .'</p>';
        if($admin['pmkAdmin'] == $adminUser){
          print 'adminHome.php';
        }
      }
  }?>" id="frmAdminLogIn" method="post" >
    <fieldset>
      <p>
          <label for="logIn" class="labelLogIn" id ="txtLogIn"> Admin Username:</label>
          <input type="text" id ="txtLogIn" name='txtLogIn'>
      </p>
      <fieldset>
          <p><input type="submit" value="Log In" tabindex="999" name="btnSubmit"></p>
      </fieldset>
    </fieldset>
  </form>
</main>
<?php
include 'footer.php';
?>
