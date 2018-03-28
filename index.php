<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="assets/stylesheet.css">
        <style>
            *    {
                font-family: 'King';
                   font-weight: 500;
                font-style: italic;
            }
            textarea {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                
                background-color: white;
                border: 1px dotted #000000;
                
                margin: 0px 0px 0px 0px;    
                
                width: 100%;    
                height:100%;

                resize: none;
                
            }
        </style>
    </head>
    <body style="background-color: rgb(225,225,225)">
        <!-- SAVE TXT FILE -->
        <form name="savefile" method="post" action="">
            <input type="text" name="filename" value="" placeholder="Filename"><br/><br/>
            <textarea rows="16" cols="100" name="textdata" placeholder="Write your text here"></textarea><br/>
            <input type="submit" name="submitsave" value="Save Text">
        </form>
        
        
        <br/>

        <!-- OPEN TXT FILE -->
        <hr style="background-color: rgb(150,150,150); color: rgb(150,150,150); width: 100%; height: 4px;"><br/>
        <form name="openfile" method="post" action="">
            <input type="text" name="filename" value="" placeholder="Filename to open">
            <input type="submit" name="submitopen" value="Open File">
        </form>
        <br/>
        <br/> File Contents:<br/>

        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        if (isset($_POST)){
            if ($_POST['submitsave'] == "Save Text"  && !empty($_POST['filename'])) {
                if(!file_exists($_POST['filename'] . ".txt")){
                    $file = tmpfile();
                }
                $file = fopen($_POST['filename'] . ".txt","a+");
                while(!feof($file)){
                    $old = $old . fgets($file). "";
                }
                $text = $_POST["textdata"];
                file_put_contents($_POST['filename'] . ".txt", $old . $text);
                fclose($file);
            }

            if ($_POST['submitopen'] == "Open File") {
                if(!file_exists($_POST['filename'] . ".txt")){
                    exit("Error: File does not exist.");
                }
                $file = fopen($_POST['filename'] . ".txt", "r");
                while(!feof($file)){
                    echo fgets($file). "<br />";
                }
                fclose($file);
            }
        }
        ?>
    </body>

</html>