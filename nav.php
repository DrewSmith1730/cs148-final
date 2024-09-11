<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print 'activePage';
    }
    ?>" href="index.php">Home</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "contact"){
        print 'activePage';
    }
    ?>" href="contact.php">Contact</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "displayListings"){
        print 'activePage';
    }
    ?>" href="displayListings.php">Display Listings</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "createListing"){
        print 'activePage';
    }
    ?>" href="createListing.php">Create a Listing</a>

    <a class="<?php
    if (PATH_PARTS['filename'] == "createListing"){
        print 'activePage';
    }
    ?>" href="admin/login.php">Admin</a>

</nav>
