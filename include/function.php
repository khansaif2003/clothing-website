<?php
    // Function to strip zeros from date
    function strip_zeros_from_date($marked_string = "") {
        $no_zeros = str_replace('*0', '', $marked_string);
        $cleaned_string = str_replace('*0', '', $no_zeros);
        return $cleaned_string;
    }

    // Redirect function using PHP headers
    function redirect_to($location = NULL) {
        if ($location != NULL) {
            header("Location: {$location}");
            exit;
        }
    }

    // Redirect function using JavaScript
    function redirect($location = NULL) {
        if ($location != NULL) {
            echo "<script>window.location='{$location}'</script>";
        } else {
            echo 'Error: Invalid location';
        }
    }

    // Function to output messages
    function output_message($message = "") {
        if (!empty($message)) {
            return "<p class=\"message\">{$message}</p>";
        } else {
            return "";
        }
    }

    // Convert datetime to readable format
    function date_to_text($datetime = "") {
        $nicetime = strtotime($datetime);
        return strftime("%B %d, %Y at %I:%M %p", $nicetime);
    }

    // Autoload class files using spl_autoload_register
    function my_autoload($class_name) {
        $class_name = strtolower($class_name);
        $path = LIB_PATH . DS . "{$class_name}.php";
        if (file_exists($path)) {
            require_once($path);
        } else {
            die("The file {$class_name}.php could not be found.");
        }
    }
    spl_autoload_register('my_autoload');

    // Get the current public page
    function currentpage_public() {
        $this_page = $_SERVER['SCRIPT_NAME']; // returns /path/to/file.php
        $bits = explode('/', $this_page);
        return $bits[2]; // returns file.php without parameters
    }

    // Get the current admin page
    function currentpage_admin() {
        $this_page = $_SERVER['SCRIPT_NAME']; // returns /path/to/file.php
        $bits = explode('/', $this_page);
        return $bits[4]; // returns file.php without parameters
    }

    // Get the current page name based on URI
    function curPageName() {
        return substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/') - 24);
    }

    // Display a message box using JavaScript
    function msgBox($msg = "") {
        ?>
        <script type="text/javascript">
            alert('<?php echo $msg; ?>');
        </script>
        <?php
    }
?>
