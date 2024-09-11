<?php
include 'top.php';

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["imgUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



function getData($field){
    if(!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}
$agent = '';
$firstName = '';
$lastName = '';
$listerEmail = '';
$agent = '';
$streetAddress = '';
$city = '';
$state = '';
$zip = '';
$date = '';
$bedrooms = '';
$bathrooms = '';
$price = '';
$sqft = '';
$description = '';
$mainImage = '';
$bought = 0;

?>

<main>
    <h2> House listing form: </h2>
    <?php
        if(isset($_POST['btnSubmit'])){
            $saveData = true;
            if(DEBUG){
                print '<p>POST array: </p><pre>';
                print_r($_POST);
                print '</pre>';
            }

            // sanitization
            $firstName = filter_var($_POST['txtFirstName'], FILTER_SANITIZE_STRING);
            $lastName = filter_var($_POST['txtLastName'], FILTER_SANITIZE_STRING);
            $listerEmail = filter_var($_POST['txtListerEmail'], FILTER_SANITIZE_EMAIL);
            $streetAddress = filter_var($_POST['txtStreetAddress'], FILTER_SANITIZE_STRING);
            $agent = filter_var($_POST['radAgent'], FILTER_SANITIZE_NUMBER_INT);
            $city = filter_var($_POST['txtCity'], FILTER_SANITIZE_STRING);
            $state = filter_var($_POST['lstState'], FILTER_SANITIZE_STRING);
            $zip = filter_var($_POST['txtZipCode'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['datListing'], FILTER_SANITIZE_STRING);
            $price = filter_var($_POST['txtPrice'], FILTER_SANITIZE_STRING);
            $sqft = filter_var($_POST['txtSqft'], FILTER_SANITIZE_NUMBER_INT);
            $description = filter_var($_POST['txtaDescription'], FILTER_SANITIZE_STRING);
            $bedrooms = filter_var($_POST['txtBedrooms'], FILTER_SANITIZE_NUMBER_INT);
            $bathrooms = filter_var($_POST['txtBathrooms'], FILTER_SANITIZE_NUMBER_INT);
            $mainImage = filter_var($_POST['imgUpload'], FILTER_SANITIZE_STRING);


            // validation
            if(!filter_var($firstName, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid first name.</p>';
                $saveData = false;
            }
            if(!filter_var($lastName, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid last name.</p>';
                $saveData = false;
            }
            if(!filter_var($listerEmail, FILTER_SANITIZE_EMAIL)){
                print '<p class="mistake">Please enter a valid email.</p>';
                $saveData = false;
            }
            if($agent != '0' && $agent != '1' && $agent != '2'){
                print '<p class="mistake">Please enter a valid agent.</p>';
                $saveData = false;
            }
            if(!filter_var($streetAddress, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid address.</p>';
                $saveData = false;
            }
            if(!filter_var($city, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid city.</p>';
                $saveData = false;
            }
            if($state != 'vermont' && $state != 'massachusetts' && $state != 'new hampshire'){
                print '<p class="mistake">Please enter a valid state.</p>';
                $saveData = false;
            }
            if(!filter_var($zip, FILTER_SANITIZE_NUMBER_INT)){
                print '<p class="mistake">Please enter a valid zip cde.</p>';
                $saveData = false;
            }
            if(!filter_var($sqft, FILTER_SANITIZE_NUMBER_INT)){
                print '<p class="mistake">Please enter a valid sqft.</p>';
                $saveData = false;
            }
            if(!filter_var($description, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid description.</p>';
                $saveData = false;
            }
            if(!filter_var($bedrooms, FILTER_SANITIZE_NUMBER_INT)){
                print '<p class="mistake">Please enter a valid bedrooms.</p>';
                $saveData = false;
            }
            if(!filter_var($bathrooms, FILTER_SANITIZE_NUMBER_INT)){
                print '<p class="mistake">Please enter a valid bathrooms.</p>';
                $saveData = false;
            }
            if(!filter_var($mainImage, FILTER_SANITIZE_STRING)){
                print '<p class="mistake">Please enter a valid file.</p>';
                $saveData = false;
            }

            if($saveData){
                $sql  = 'INSERT INTO tblListings SET ';
                $sql .= 'fpkAgentID = ?, ';
                $sql .= 'fldListerEmail = ?, ';
                $sql .= 'fldStreetAddress = ?, ';
                $sql .= 'fldCity = ?, ';
                $sql .= 'fldState = ?, ';
                $sql .= 'fldZipCode = ?, ';
                $sql .= 'fldDescription = ?, ';
                $sql .= 'fldBedrooms = ?, ';
                $sql .= 'fldBathrooms = ?, ';
                $sql .= 'fldDateListed = ?, ';
                $sql .= 'fldPrice = ?, ';
                $sql .= 'fldSqft = ?, ';
                $sql .= 'fldMainImage = ?, ';
                $sql .= 'fldBought = ?';

                $data = array();
                $data[] = $agent;
                $data[] = $listerEmail;
                $data[] = $streetAddress;
                $data[] = $city;
                $data[] = $state;
                $data[] = $zip;
                $data[] = $description;
                $data[] = $bedrooms;
                $data[] = $bathrooms;
                $data[] = $date;
                $data[] = $price;
                $data[] = $sqft;
                $data[] = $mainImage;
                $data[] = $bought;



                if(DEBUG){
                    print $thisDatabaseReader->displayQuery($sql, $data);
                }

                if($thisDatabaseWriter->insert($sql, $data)){
                  $sql3 = 'SELECT pmkListingId FROM tblListings WHERE fldListerEmail = ? ';
                  $data3 = array();
                  $data3[] = $listerEmail;
                  $getIds = $thisDatabaseReader->select($sql3, $data3);

                  print '<p>' . $getId . '</p>';
                  foreach ($getIds as $Id) {
                    $getId = $Id['pmkListingId'];
                  }

                  $sql2  = 'INSERT INTO tblListers SET ';
                  $sql2 .= 'pmkListerEmail = ?, ';
                  $sql2 .= 'fpkListingId = ?, ';
                  $sql2 .= 'fpkAgentID = ?, ';
                  $sql2 .= 'fldFirstName = ?, ';
                  $sql2 .= 'fldLastName = ? ';

                  $data2 = array();
                  $data2[] = $listerEmail;
                  $data2[] = $getId;
                  $data2[] = $agent;
                  $data2[] = $firstName;
                  $data2[] = $lastName;

                  print $thisDatabaseReader->displayQuery($sql2, $data2);
                  if($thisDatabaseWriter->insert($sql2, $data2)){
                    print '<p> The listing has been created </p>';
                  }

                }else{
                  print '<p>Listing could not be created</p>';
                }

            }

        }
    ?>

    <form action="<?php print 'createListing.php'?>" id = "frmListing" method="post">
        <fieldset class="textbox">
            <lable for="txtFirstName">First Name</lable>
            <input type="text" id="txtFirstName" name="txtFirstName" value="<?php print $firstName ?>" tabindex="100">
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtLastName">Last Name</lable>
                <input type="text" id="txtLastName" name="txtLastName" value="<?php print $lastName ?>" tabindex="200">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtListerEmail">Email Address</label>
                <input type="email" id="txtListerEmail" name="txtListerEmail" value="<?php print $listerEmail ?>" tabindex="300">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <input type="radio" id="drew" name="radAgent" value="2">
                <label for="drew">Drew</label>
                <input type="radio" id="matt" name="radAgent" value="1">
                <label for="matt">Matt</label>
                <input type="radio" id="aiden" name="radAgent" value="3">
                <label for="aiden">Aiden</label>
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtStreetAddress">Street Address</lable>
                <input type="text" id="txtStreetAddress" name="txtStreetAddress" value="<?php print $streetAddress ?>" tabindex="400">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtCity">City</lable>
                <input type="text" id="txtCity" name="txtCity" value="<?php print $city ?>" tabindex="500">
            </p>
        </fieldset>

        <label for="lstState" tabindex="600">Choose your state: </label>

        <select name="lstState" id="lstState">
            <option value="vermont">Vermont</option>
            <option value="massachusetts">Massachusetts</option>
            <option value="new hampshire">New Hampshire</option>
        </select>

        <fieldset class="textbox">
            <p>
                <lable for="txtZipCode">Zip Code: </lable>
                <input type="text" id="txtZipCode" name="txtZipCode" value="<?php print $zip ?>" tabindex="700">
            </p>
        </fieldset>

        <fieldset class="textbox">
          <p>
              <label for="datListings">Date of Listing:</label>
              <input type="text" id="datListing" name="datListing" value="<?php print $date ?>">
          </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtPrice">Sale Price: </lable>
                <input type="text" id="txtPrice" name="txtPrice" value="<?php print $price ?>" tabindex="800">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtSqft">Building Square Footage: </lable>
                <input type="text" id="txtSqft" name="txtSqft" value="<?php print $sqft ?>" tabindex="900">
            </p>
        </fieldset>

        <fieldset class="textarea">
            <p>
                <lable for="txtaDescription">Description</lable>
                <textarea id="txtaDescription" name="txtaDescription" rows="4" cols="50" tabindex="300"><?php print $description ?></textarea>
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtBedrooms">Number of Bedrooms: </lable>
                <input type="text" id="txtBedrooms" name="txtBedrooms" value="<?php print $bedrooms?>" tabindex="700">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <lable for="txtBathrooms">Number of Bathrooms </lable>
                <input type="text" id="txtBathrooms" name="txtBathrooms" value="<?php print $bathrooms ?>" tabindex="700">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <input type="file" name="imgUpload" id="imgUpload"><?php print $mainImage ?>
            </p>
        </fieldset>

        <fieldset>
            <p><input type="submit" value="Submit" tabindex="999" name="btnSubmit">  </p>
        </fieldset>
    </form>
</main>

<?php
include 'footer.php';
?>
