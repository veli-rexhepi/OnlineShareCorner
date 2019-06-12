<!-- Pagination for library files and folders -->
<div class='pagination noselect'>

    <!-- If $pages (needed pages number) is > than 2 create the button First and display the records on page index.php?screen=0 -->
<?php 
    if (($pages >= 2) && ($screen > 0)) { // Initial cycle 
?>   
        <button id='pN_First' class='w3-btn w3-white w3-border paginationBtn' 
            onclick='listAllDocuments(0, "<?php echo $sessionName; ?>")'>
            <!--<i class='fas fa-angle-left'></i>&nbsp;&nbsp;-->
            Frist
        </button>
<?php        
    }
    else {
?>
        <button id='pN_First' class='w3-btn w3-white w3-border paginationBtn' disabled>
            <!--<i class='fas fa-angle-left'></i>&nbsp;&nbsp;-->
            Frist
        </button>
<?php
    }
    /* If $screen is > 0 create the button Previous and display records on the page index.php?screen= where the $screen is decreased for 1 */
    if ($screen > 0) { // Decrease cycle
?>
        <button id='pN_Prior' class='w3-btn w3-white w3-border paginationBtn'
            onclick='listAllDocuments((<?php echo $screen; ?> - 1), "<?php echo $sessionName; ?>")'>
            <!--<i class='fas fa-angle-double-left'></i>&nbsp;&nbsp;-->
            Previous
        </button>
<?php
    }
    else {	
?>
        <button id='pN_Prior' class='w3-btn w3-white w3-border paginationBtn' disabled>
            <!--<i class='fas fa-angle-double-left'></i>&nbsp;&nbsp;-->
            Previous
        </button>
<?php
    }
    /* For all pages display the records and store them in a form of pages with index $i */
    for ($i = 0; $i < $pages; $i++) { // Creates the page numbering and marks the current page number with red color	
            $y = $i+1;                   

            if($pages > 1) { // If there is only one page it opens the same page when clicked over the page number
                if ($y == $screen + 1) {    
?>
                    <button id='pN<?php echo $i; ?>' class='w3-btn w3-white w3-border paginationBtn paginationNo'
                            onclick='listAllDocuments(
                                        <?php echo $i; ?>, 
                                        "<?php echo $sessionName; ?>"
                            )'>                            
                        <?php echo $y; ?>
                    </button>
            <?php
                }                                       
            }  
            else {
        ?>
                <button id='pN<?php echo $i; ?>' class='w3-btn w3-white w3-border paginationBtn paginationNo'
                            onclick='listAllDocuments(
                                        <?php echo $i; ?>, 
                                        "<?php echo $sessionName; ?>"
                            )'>                            
                        <?php echo $y; ?>
                    </button>
<?php
            }             
    }
    /* If $screen is < $pages -1 create the button Next and display the records in the index.php?screen= where $sreen is increased for 1 */
    if ($screen < $pages - 1) { // Increase cycle	
?>
        <button id='pN_Next' class='w3-btn w3-white w3-border paginationBtn'
            onclick='listAllDocuments((<?php echo $screen; ?> + 1), "<?php echo $sessionName; ?>")'>
            Next
            <!--&nbsp;&nbsp;<i class='fas fa-angle-double-right'></i>-->
        </button>
<?php
    }
    else {
?>
        <button id='pN_Next' class='w3-btn w3-white w3-border paginationBtn' disabled>
            Next
            <!--&nbsp;&nbsp;<i class='fas fa-angle-double-right'></i>-->
        </button>
<?php
    }
    /* If $pages (number of the needed pages) is > 2 create buton Last and display the records in index.php?screen=($pages - 1) */
    if (($pages >= 2) && ($screen < ($pages - 1))) { // End cycle	
?>
        <button id='pN_Last' class='w3-btn w3-white w3-border paginationBtn'
            onclick='listAllDocuments((<?php echo $pages; ?> - 1), "<?php echo $sessionName; ?>")'>
            Last
            <!--&nbsp;&nbsp;<i class='fas fa-angle-right'></i>-->
        </button>
<?php
    }
    else {
?>
        <button id='pN_Last' class='w3-btn w3-white w3-border paginationBtn' disabled>
            Last
            <!--&nbsp;&nbsp;<i class='fas fa-angle-right'></i>-->
        </button>
<?php
    }   
?>        
</div>