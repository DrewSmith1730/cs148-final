<?php
include 'top.php';

$listingId = (isset($_GET['lid'])) ? (int) htmlspecialchars($_GET['lid']) : 0;

$sql = 'SELECT pmkListingId, fpkAgentID, fldStreetAddress, fldCity, fldState, ';
$sql .='fldZipCode, fldDescription, fldBedrooms, fldBathrooms, fldDateListed, fldPrice, fldSqft, fldBought, fldMainImage, fldFirstName, fldLastName, fldAgentEmail ';
$sql .= 'FROM tblListings ';
$sql .= 'JOIN tblAgents ON pmkAgentId = fpkAgentID ';
$sql .= 'ORDER BY pmkListingId';

$data = '';
$listings = $thisDatabaseReader->select($sql, $data);


?>
<main class = "house">
    <h2>All Listings in Database</h2>
    <?php
    if(is_array($listings)){
        foreach($listings as $listing){
            print '<a href="displayHouse.php?lid=' . $listing['pmkListingId'] . '">';
            print '<figure class="listing">';
            print '<img class="listing" alt="' . $listing['fldStreetAddress'] . '" src="../images/' . $listing['fldMainImage'] . '">';
            print '<figcaption>' . $listing['fldStreetAddress'] . ', ' . $listing['fldCity'] . ', ' . $listing['fldState'] . '</figcaption>';
            print '</figure>';
            print '</a>';
            print '<section>';
            print $listing['fldDescription'];
            print '<table>';
            print '<tr><th>Listing price</th><td>$' . $listing['fldPrice'] . '</td></tr>';
            print '<tr><th>Square Footage</th><td>' . $listing['fldSqft'] . 'sq feet</td></tr>';
            print '<tr><th>Number of Bedrooms</th><td>' . $listing['fldBedrooms'] . '</td></tr>';
            print '<tr><th>Number of Bathrooms</th><td>' . $listing['fldBathrooms'] . '</td></tr>';
            print '<tr><th>Agents Name</th><td>' . $listing['fldFirstName'] . ' ' . $listing['fldLastName'] . '</td></tr>';
            print '<tr><th>AgentEmail</th><td>' . $listing['fldAgentEmail'] . '</td></tr>';
            print '</table>';
            print '</section>';

        }
    }
     ?>
</main>

<?php
include 'footer.php';
?>
