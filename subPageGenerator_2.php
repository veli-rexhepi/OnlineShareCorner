<?php 
    header('Content-type: text/html; charset=utf-8');
    session_start();
    
    $rootDirectory = "/GitHub/Library/";
    
    if(filter_input(INPUT_GET, 'sessionName')) {
        $sessionName = filter_input(INPUT_GET, 'sessionName');
        $_SESSION['sessionName'] = $sessionName;
        
        $pageTitle = filter_input(INPUT_GET, 'pageTitle');
        $_SESSION['pageTitle'] = $pageTitle;
        
        $ftpFolder = filter_input(INPUT_GET, 'ftpFolder');    
        $_SESSION['ftpFolder'] = $ftpFolder;       
    } else {
        $sessionName = $_SESSION['sessionName'];
        $pageTitle = $_SESSION['pageTitle'];
        $ftpFolder = $_SESSION['ftpFolder'];        
    }    

    if ($_REQUEST[$sessionName] == null) {     
        $screen = 0;
    }
    else {    
        $screen = $_REQUEST[$sessionName];
    }  
?>

<section class="subPageGenerator-holder">
    <section class='managementReviews-containerList'>
        <div class="containerList-TitleHolder">
            <h3 class="containerList-Title"><?php echo $pageTitle; ?></h3> 
            <button class="w3-button w3- w3-border w3-round-large containerList-Button"
                onclick="window.history.back()">
                <i class='fas fa-long-arrow-alt-left containerList-GoBack'></i>
                Go Back
            </button>
        </div>                 

        <?php
            // Create an obj variable and fill with document names
            class fileList {
                public $filePath;
                public $fileName;
                public $fileDate;
                public $fileType;
            }
            
            $documents = new fileList;
            $documents->filePath = [];
            $documents->fileName = []; 
            $documents->fileDate = [];
            $documents->fileType = [];
            $i = 0;
            $backgroundColor = '';
            $useIcon = '';
            
            $directory = $_SERVER['DOCUMENT_ROOT'] . $ftpFolder; 
            $directoryList = scandir($directory);              
            
            // Dislplay the Subfolders title box
            foreach ($directoryList as $value) {
                $ext = pathinfo($value, PATHINFO_EXTENSION);
                if (empty($ext) && ($value != ".") && ($value != "..")) {
                    echo "<div class='w3-card-2 w3-theme-l1 suPageGenerator-subTitle'>Subfolders</div>";
                    echo "<article class='containerListHolder-Folders'>";

                    // List the folders
                    foreach($directoryList as $key => $value) {   
                        $ext = pathinfo($value, PATHINFO_EXTENSION); 
                        if (empty($ext) && ($value != ".") && ($value != "..")) {
                            echo '<div class="w3-card-2 containerList-elements-type2 ' . $backgroundColor . '">
                                        <span class="containerList-elements-OrdinalNr-type2"></span>
                                        <a class="conatinnerListLinks-type2" 
                                            href="subPageGenerator.php?sessionName=screenQA_Sub$g&pageTitle=' . $value . '&ftpFolder=' . $ftpFolder . '/' . $value . '" '
                                            . 'target="_parent">' . $useIcon . '</i> ' . $value . '</a>                    
                                    </div>';
                        }                            
                    }
                    echo "</article>";
                    break;
                }
            }
                        
            // Fill the object vector with file names readed from folder. When this is done,
            // the documents object vector will hold all the file names readed from the given folder.
            if ($handle = opendir($directory)) {
                    while (false !== ($documents->filePath[$i] = readdir($handle))) {
                        $ext = pathinfo($documents->filePath[$i], PATHINFO_EXTENSION); 
                        $ext = strtolower($ext);

                        if ($documents->filePath[$i] != "." && $documents->filePath[$i] != ".." && (
                                $ext == 'pdf' || 
                                $ext == 'docx' || 
                                $ext == 'pptx' || 
                                $ext == 'png' || 
                                $ext == 'jpg' || 
                                $ext == 'xlsx' || 
                                $ext == 'xltx' || 
                                $ext == 'xls'
                            )) {
                            $documents->fileName[$i] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $documents->filePath[$i]);                                      
                            $documents->fileDate[$i] = filemtime($directory."/".$documents->filePath[$i]); 
                            $documents->fileType[$i] = $ext;
                            
                            $i++;
                        }
                    }                
                    closedir($handle);
                }  

            // Get the file names from $documents object, push them into the array
            $k = 0;
            $listFilesByOrginalOrder = [];
            
            //Loop through dates array and then echo the list
            foreach ($documents->fileDate as $documents->fileDate){
                // Add velues into an array
                $listFilesByOrginalOrder[$k] = $documents->fileName[$k] . "." . $documents->fileType[$k];;
                            
                $k++;
            }

            // Determining of records number do siplay in a page and pages number to display all records            
            $path = $_SERVER['DOCUMENT_ROOT'] . $rootDirectory . "/configFiles/loadSettings.php";           
            
            require ($path);

            $result_num_rows = $i;

            $total_records = $result_num_rows;                                         
            $pages = ceil($total_records / $rows_per_page);
            $start = $screen * $rows_per_page;
            $endList = $start + $rows_per_page - 1;
            // List the file names from array
            $l = $start;
            $t = 0;
            $backgroundColor = '';
            
            // Dislplay the Files title box
            foreach ($listFilesByOrginalOrder as $key => $val) {
                if ($val) {
                    echo "<div class='w3-card-2 w3-theme-l1 suPageGenerator-subTitle'>Files</div>";
                    echo "<article class='containerListHolder-files'>";

                    // List the files
                    foreach ($listFilesByOrginalOrder as $key => $val) {
                        if ($t == $l) {
                            if(($start <= $l) && ($l <= $endList)) {                                    

                                // Row color background
                                if ($l % 2 == 0) {
                                    $backgroundColor = 'w3-theme-l5';
                                }
                                else {
                                    $backgroundColor = 'w3-theme-l4';
                                }

                                // Get extension of the file
                                $ext = pathinfo($val, PATHINFO_EXTENSION);

                                // Decide the icon type to be shown before hyperlink
                                switch ($ext) {
                                    case 'pdf' : 
                                        $useIcon = '<i class="fas fa-external-link-square-alt">';
                                        break;
                                    case 'jpg' :
                                        $useIcon = '<i class="fas fa-download">';
                                        break;
                                    case 'docx' : 
                                        $useIcon = '<i class="fas fa-download">';
                                        break;
                                    case 'pptx' :
                                        $useIcon = '<i class="fas fa-download">';
                                        break;
                                }

                                echo '<div class="containerList-elements ' . $backgroundColor . '">
                                        <span class="containerList-elements-OrdinalNr">' . ($l+1) . '.</span>
                                        <a class="conatinnerListLinks" href="' . $ftpFolder . '/' . $val . '" '
                                            . 'target="_blank">' . $useIcon . '</i> ' . $val . '</a>                    
                                    </div>';
                                $l ++;
                            }
                        }    
                        $t ++;
                    }
                    echo "</article>";
                    break;
                }
            }      
        ?>
    </section>   
</sectiopn>
    
<?php require "pagination.php";