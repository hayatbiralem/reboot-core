<?php
if(isset($format) && !empty($format)) {
    echo date_i18n($format);
} else {
    echo date_i18n('Y');
}
