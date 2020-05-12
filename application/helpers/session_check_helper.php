<?php

if(!function_exists('ci_instance')) {
    function ci_instance() {
        return get_instance();
    }
}

if(!function_exists('check_sessions')) {
    function check_sessions($session_name,$session_value) {
        if($session_value==ci_instance()->session->userdata($session_name)){
            return true;
        } else {
            return false;
        }
    }
}

