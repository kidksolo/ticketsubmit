
        
        <?php
            header('Content-Type: text/plain');
            // array with issue types
            $a[] = "Injection Attack";
            $a[] = "Broken Authentication";
            $a[] = "Security Access Issue";
            $a[] = "Cross-Site Scripting";
            $a[] = "DDOS Attack";
            $a[] = "Phishing Attack";
            
            // Get the q parameter from URL
            $q = isset($_GET["q"]) ? $_GET["q"] : "";
            $hint = "";
            
            // search all hints from array if $q is not empty
            if ($q !== "") {
                $q = strtolower($q);
                $len = strlen($q);
                foreach ($a as $issue) {
                    // checks if the array value strings occur, letter by letter until printing a result
                    if (!empty($q) && stristr($q, substr($issue, 0, $len))) {
                        if ($hint === "") {
                            $hint = $issue;
                        } else {
                            $hint .= ", $issue";
                        }
                    }
                }
            }
            
            // output
            echo $hint === "" ? "no suggestion available" : $hint;
        ?>




