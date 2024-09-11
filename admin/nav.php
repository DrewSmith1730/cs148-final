<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print 'activePage';
    }
    ?>" href="../index.php">Home</a>

    <div class="dropdown">
        <a class="dropbtn">Admin
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-content">
            <a class="<?php
            if (PATH_PARTS['filename'] == "delete"){
                print 'activePage';
            }
            ?>" href="selectDelete.php">Delete</a>
            <a class="<?php
            if (PATH_PARTS['filename'] == "insert"){
                print 'activePage';
            }
            ?>" href="insert.php">Insert</a>
            <a class="<?php
            if (PATH_PARTS['filename'] == "update"){
                print 'activePage';
            }
            ?>" href="update.php">Update</a>
        </div>
    </div>
</nav>
