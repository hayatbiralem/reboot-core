<?php

if(isset($disable_autop) && $disable_autop) {
    $p = get_post( get_the_ID() );
    if($p) {
        echo $p->post_content;
    } else {
        the_content();
    }
} else {
    the_content();
}
