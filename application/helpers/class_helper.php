<?php

function get_grade_name($grade_id){
    return ordinal($grade_id) . " " . "Grade";
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

function get_class_teacher_name($teacher_id){
    $ci =& get_instance();
    $ci->load->model('teacher_model');
    
    $teacher = $ci->teacher_model->get_teacher_name($teacher_id);
    if(!$teacher){
        return "-- Not Assigned --";
    } else {
        return $teacher->name_with_initials;
    }
}