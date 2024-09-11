
<?php
include 'top.php';

$sql = 'SELECT pmkListingId, fpkAgentID, fldStreetAddress, fldCity, fldState, ';
$sql .='fldZipCode, fldBedrooms, fldBathrooms, fldDateListed, fldPrice, fldSqft, fldBought, fldMainImage ';
$sql .= 'FROM tblListings ';
$sql .= 'ORDER BY pmkListingId';

$data = '';

$listings = $thisDatabaseReader->select($sql, $data);
?>

<main>
    <h2>Display house</h2>
    <h3>Click on a listing to learn more about it </h3>
<?php
print '<section>';
if(is_array($listings)){
    foreach($listings as $listing){
        print '<a href="displayHouse.php?lid=' . $listing['pmkListingId'] . '">';
        print '<figure>';
        print '<img class="listing" alt="' . $listing['fldStreetAddress'] . '" src="images/' . $listing['fldMainImage'] . '">';
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
