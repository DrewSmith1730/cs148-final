<?php
include 'top.php';

$listingId = (isset($_GET['lid'])) ? (int) htmlspecialchars($_GET['lid']) : 0;



?>

<main>
    <h2> Delete listing: </h2>
    <?php
    $sql2 = 'SELECT fldStreetAddress, fldCity, fldState, fldMainImage ';
    $sql2 .= 'FROM tblListings ';
    $sql2 .= 'WHERE pmkListingId = ? ';
    $sql2 .= 'ORDER BY pmkListingId';

    $data2 = array($listingId);

    $listings = $thisDatabaseReader->select($sql2, $data2);

      foreach ($listings as $listing) {
        print '<p>';
        print '<figure class="listing">';
        print '<img class="listing" alt="' . $listing['fldStreetAddress'] . '" src="../images/' . $listing['fldMainImage'] . '">';
        print '<figcaption>' . $listing['fldStreetAddress'] . ', ' . $listing['fldCity'] . ', ' . $listing['fldState'] . '</figcaption>';
        print '</figure>';
        print '<p>';
      }
     ?>

    <form action="<?php print 'delete.php?lid=' . $listingId;?>" id = "frmListing" method="post">
      <?php
          if(isset($_POST['btnSubmit'])){
            $sql = 'DELETE FROM tblListings WHERE ';
            $sql .= 'pmkListingId = ?';

            $data = array($listingId);
            // $data[] = $listingId;

            if($thisDatabaseWriter->delete($sql, $data)){
                print '<p>Record successfully deleted!</p>';
            }
            else {
                print '<p>Record deletion failed. Something went wrong and your record was not deleted</p>';
            }
          }
      ?>
        <fieldset>
            <p><input type="submit" value="Delete" tabindex="999" name="btnSubmit">  </p>
        </fieldset>
    </form>
</main>

<?php
include 'footer.php';
?>
