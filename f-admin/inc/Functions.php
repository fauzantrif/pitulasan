<?php 

    require_once(__DIR__ . "/Database.php");

    class Functions {
        function sanitize($dataType, $data){
            switch($dataType){
                case "number":
                    $data = preg_replace("/[^0-9]/", "", $data);
                    break;
                case "alphabet":
                    $data = preg_replace("/[^A-Za-z]/", "", $data);
                    break;
                case "alphanum":
                    $data = preg_replace("/[^0-9A-Za-z]/", "", $data);
                    break;
                case "id":
                    $data = preg_replace("/[^0-9A-Za-z\-_\.]/", "", $data);
                    break;
                case "name":
                    $data = preg_replace("/[^0-9A-Za-z\-_\.'\s]/", "", $data);
                    break;
                case "code":
                    $data = htmlspecialchars($data);
                    break;
                case "strip-tags":
                    $data = strip_tags($data);
                    break;
                case "nophp":
                    $data = preg_replace("/<?php/", "&lt;?php", $data);
                    $data = preg_replace("/?>/", "?&gt;", $data);
                    break;
                case "whitespace":
                    $data = trim($data);
                    break;
            }
            return $data;
        }

        function get_pagination_links($current_page, $total_pages, $url = false){
            $current_page = intval($current_page);
            $total_pages = intval($total_pages);
            $links = "";
            $links_array = [];
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                array_push($links_array, 1); //array_mode
                $links .= "<a href=\"{$url}?page=1\">1</a>";
                if($total_pages > 1){
                    $i = max(2, $current_page - 2);
                    if ($i > 2){
                        $links .= " ... ";
                        array_push($links_array, " ... "); //array_mode
                    }
                    for (; $i < min($current_page + 3, $total_pages); $i++) {
                        $links .= "<a href=\"{$url}?page={$i}\">{$i}</a>";
                        array_push($links_array, $i); //array_mode
                    }
                    if ($i != $total_pages){
                        $links .= " ... ";
                        array_push($links_array, " ... "); //array_mode
                    }
                    $links .= "<a href=\"{$url}?page={$total_pages}\">{$total_pages}</a>";
                    array_push($links_array, $total_pages); //array_mode
                }
            }
            if($url === false)
                return $links_array;
                else return $links;
        }

        function getAdmin($userid = false){
            if(!$userid) return false;
            $userid = intval($userid);
            $database = new Database();
            $admin = $database->query("SELECT * FROM `admins` WHERE id = {$userid}");
            if($admin['total'] === 1){
                return $admin['data'][0];
            } else {
                return false;
            }
        }

        function getDateTime($timestamp){
            $datetime = strtotime($timestamp);
            $theHari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
            $theBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $harinya = $theHari[date("w", $datetime)];
            $lebihseminggu = $harinya.", ".date("j", $datetime)." ".$theBulan[date("n", $datetime)-1]." ".date("Y", $datetime);
            return $lebihseminggu." pukul ".date("H:i", $datetime);
        }

        function getTimestamp(){
            return date("Y-m-d H:i:s");
        }
    }
?>