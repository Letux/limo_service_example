<?php
/**
 * Прогресс заказа
 */

//// Админка
//if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
//    if ($this->params['action'] == 'admin_confirmation')  {
//        $step = 5;
//    }
//    else {
//        $step = substr($this->params['action'], 10);
//    }
//}
//else {
//    if ($this->params['action'] == 'confirmation')  {
//        $step = 5;
//    }
//    else {
//        $step = substr($this->params['action'], 4);
//    }
//}
//
//echo '<div class="order_progress">';
//
//if ($step == 2 && !empty($step1Link)) {
//    echo '<span class="label first"><a href="'. $step1Link .'">Step 1</a></span>';
//} else {
//    echo '<span class="label '. ($step == 1 ? 'first_active' : 'first') .'">Step 1</span>';
//}
//
//echo '<span class="label '. ($step == 2 ? 'active' : '') . ($step > 2 ? 'passed' : '') .'">Step 2</span>';
//echo '<span class="label '. ($step == 3 ? 'active' : '') . ($step > 3 ? 'passed' : '') .'">Step 3</span>';
//echo '<span class="label '. ($step == 4 ? 'active' : '') . ($step > 4 ? 'passed' : '') .'">Step 4</span>';
//echo '<span class="label '. ($step == 5 ? 'last_active' : 'last') .'">Confirmation</span>';
//
//echo '</div>';
