<?php
    header('Content-type: text/html; charset=utf-8');
    session_start();  
    
    $rootDirectory = "/Library/";
    $setSessionname = 'testSession';
    $setpageTitle = 'Share Corner Conntent';    
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require "headContent.php"; ?>             
    </head>
    
    <body onload="checkWebBrowserType(); setBodyHeight()">
        
        <?php
            require 'header.php';
            require 'navigation.php';
        ?>
        
        <!-- setBodyHeight() calculates correct height only if wrapper vertical margin is 0! Keep it always 0. -->
        <section id="wrapper" class="wrapper">
            
            <article id="pageHolder">               
                <a class="mainTtile" href="subPageGenerator.php?sessionName=<?php echo $setSessionname; ?>&pageTitle=<?php echo $setpageTitle; ?>&ftpFolder=<?php echo $rootDirectory; ?>/Library" target="_parent">
                    <div class="firstArticleTitle-holder">                        
                        <h5 class="firstArticleTitle">
                            <i class="fas fa-list"></i>
                            Display Library Files and Folders
                        </h5>                          
                    </div>
                </a>
                
                <p class='description'>
                    The Online Share Corner is a website that loads folders and files in their original 
                    structure from the targeted network share drive and publishes them on the website 
                    automatically. Also, all the changes made with the folders and files on network share 
                    drive are reflected automatically to the website. For instance, if a new file or folder 
                    is added or deleted on the network share drive, this change will be published automatically 
                    on website in the same structure as they are on network share drive. Commonly used file 
                    types in corporate environments are supported. Documentation published on this website 
                    can be viewed and downloaded by the visitors.
                </p>
            </article>
            
        </section>
        
        <?php require 'footer.php'; ?>      
               
    </body>
</html>
