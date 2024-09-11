
<?php
include 'top.php';

$sql = 'SELECT pmkListingId, fpkAgentID, fldListerEmail, fldStreetAddress, fldCity, fldState, ';
$sql .='fldZipCode, fldDescription, fldBedrooms, fldBathrooms, fldDateListed, fldPrice, fldSqft, fldMainImage, fldBought ';
$sql .= 'FROM tblListings ';
$sql .= 'ORDER BY pmkListingId';

$data = '';


$listings = $thisDatabaseReader->select($sql, $data);
?>

<main>
    <h2>All Listings</h2>
    <h3>Choose a listing to delete</h3>
<?php
print '<section>';
if(is_array($listings)){
    foreach($listings as $listing){
        print '<a href="delete.php?lid=' . $listing['pmkListingId'] . '">';
        print '<figure>';
        print '<img class="listing" alt="' . $listing['fldStreetAddress'] . '" src="../images/' . $listing['fldMainImage'] . '">';
        print '<figcaption>' . $listing['fldStreetAddress'] . '</figcaption>';
        print '</figure>';
        print '</a>';
    }
}
print '</section>';
 ?>
</main>

<?php
include 'footer.php';
?>
