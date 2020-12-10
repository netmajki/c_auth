<?php
namespace api\fetch;

use mysqli_wrapper;
use responses;
use functions;

function fetch_module(mysqli_wrapper $c_con, $program_key, $file_id){
    $m_query = $c_con->query('SELECT * FROM c_program_modules WHERE c_program=? AND c_file_id=? LIMIT 1', [$program_key, $file_id]);

    if($m_query->num_rows === 0)
        return responses::not_valid_module;

    return $m_query->fetch_assoc();
}

function fetch_module_with_name(mysqli_wrapper $c_con, $program_key, $file_name){
    $m_query = $c_con->query('SELECT * FROM c_program_modules WHERE c_program=? AND c_file_name=? LIMIT 1', [$program_key, $file_name]);

    if($m_query->num_rows === 0)
        return responses::not_valid_module;

    return $m_query->fetch_assoc();
}

function fetch_all_modules(mysqli_wrapper $c_con, $program_key){
    $all_modules_query = $c_con->query('SELECT * FROM c_program_modules WHERE c_program=?', [$program_key]);

    return $all_modules_query->fetch_all(1);
}

function fetch_module_rand_data(){
    $file_id = functions::random_string(16);

    $files_folder = __DIR__.'/../modules/';

    return array(
        'file_id' => $file_id,
        'files_folder' => $files_folder,
        'new_location' => $files_folder.$file_id.'.file',
        'enc_key' => functions::random_string()
    );

}
