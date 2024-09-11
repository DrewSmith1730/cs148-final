<?php
include 'top.php';

$listingId = (isset($_GET['lid'])) ? (int) htmlspecialchars($_GET['lid']) : 0;

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

if($listingId != 0){
  $sql1 = 'SELECT pmkListingId, fpkAgentID, fldListerEmail, fldStreetAddress, fldCity, fldState, ';
  $sql1 .='fldZipCode, fldDescription, fldBedrooms, fldBathrooms, fldDateListed, fldPrice, fldSqft, fldMainImage, fldBought ';
  $sql1 .= 'FROM tblListings ';
  $sql1 .= 'WHERE pmkListingId = ? ';
  $sql1 .= 'ORDER BY pmkListingId';

  $data1 = array($listingId);
  // print displayQuery($sql1, $data1);
  $listings = $thisDatabaseReader->select($sql1, $data1);

  foreach ($listings as $listing) {
    $agent = $listing['fpkAgentID'];
    $listerEmail = $listing['fldListerEmail'];
    $agent = '';
    $streetAddress = $listing['fldStreetAddress'];
    $city = $listing['fldCity'];
    $state = $listing['fldState'];
    $zip = $listing['fldZipCode'];
    $date = $listing['fldDateListed'];
    $bedrooms = $listing['fldBedrooms'];
    $bathrooms = $listing['fldBathrooms'];
    $price = $listing['fldPrice'];
    $sqft = $listing['fldSqft'];
    $description = $listing['fldDescription'];
    $mainImage = $listing['fldMainImage'];
    $bought = $listing['fldBought'];
  }
}

?>

<main>
  <?php
  if($listingId != 0){
    print '<h2> Update a Listing: </h2>';
  }else{
    print '<h2> Insert a Listing: </h2>';
  }

    ?>
    <?php
        if(isset($_POST['btnSubmit'])){
            $saveData = true;
            if(DEBUG){
                print '<p>POST array: </p><pre>';
                print_r($_POST);
                print '</pre>';
            }

            // sanitization
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
                $sql .= 'fldBought = ? ';

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

                $sql2  = 'UPDATE tblListings SET ';
                $sql2 .= 'fpkAgentID = ?, ';
                $sql2 .= 'fldListerEmail = ?, ';
                $sql2 .= 'fldStreetAddress = ?, ';
                $sql2 .= 'fldCity = ?, ';
                $sql2 .= 'fldState = ?, ';
                $sql2 .= 'fldZipCode = ?, ';
                $sql2 .= 'fldDescription = ?, ';
                $sql2 .= 'fldBedrooms = ?, ';
                $sql2 .= 'fldBathrooms = ?, ';
                $sql2 .= 'fldDateListed = ?, ';
                $sql2 .= 'fldPrice = ?, ';
                $sql2 .= 'fldSqft = ?, ';
                $sql2 .= 'fldMainImage = ?, ';
                $sql2 .= 'fldBought = ? ';
                $sql2 .= 'WHERE pmkListingId = ?';

                $data2 = array();
                $data2[] = $agent;
                $data2[] = $listerEmail;
                $data2[] = $streetAddress;
                $data2[] = $city;
                $data2[] = $state;
                $data2[] = $zip;
                $data2[] = $description;
                $data2[] = $bedrooms;
                $data2[] = $bathrooms;
                $data2[] = $date;
                $data2[] = $price;
                $data2[] = $sqft;
                $data2[] = $mainImage;
                $data2[] = $bought;
                $data2[] = $listingId;

                if(DEBUG){
                    print $thisDatabaseReader->displayQuery($sql, $data);
                }

                if($listingId != 0){
                  // update statement
                  if($thisDatabaseWriter->insert($sql2, $data2)){
                    print '<p> The listing has been updated</p>';
                  }else{
                    print '<p>The listing was not updated</p>';
                  }
                }else {
                  if($thisDatabaseWriter->insert($sql, $data)){
                    print '<p> The listing has been created</p>';
                  }else{
                    print '<p>The listing was not created</p>';
                  }
                }

            }

        }
    ?>

    <form action="<?php print 'insert.php?lid=' . $listingId?>" id = "frmListing" method="post">

        <fieldset class="textbox">
            <p>
                <label for="txtListerEmail">Email Address</label>
                <input type="email" id="txtListerEmail" name="txtListerEmail" value="<?php print $listerEmail ?>" tabindex="300">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <input type="radio" id="drew" name="radAgent" value="2">
                <label for="drew">Drew</label><br>
                <input type="radio" id="matt" name="radAgent" value="1">
                <label for="matt">Matt</label><br>
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

        <label for="datListings">Date of Listing:</label>
        <input type="textbox" id="datListing" name="datListing">

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
