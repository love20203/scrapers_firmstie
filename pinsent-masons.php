<?php

include 'config.php';
include 'simple_html_dom.php';

$base_url = 'https://www.pinsentmasons.com';
$spider_name = 'Pinsent-Masons';


$headers = [
    'Content-Type: application/json;',
];

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => implode("\r\n", $headers),
        // 'content' => json_encode($request_body)
    ],
]);

$params = [
    "root" => "46b602a96bfc4dc5bd78300be25c445e",
    "pageNumber" => 1,
    "pageSize" => 30,
    "orderBy" => 0,
    "firstLoad" => "true",
    "contentTypes" => "PersonBioPage",
    "contextItem" => "46b602a9-6bfc-4dc5-bd78-300be25c445e",
    "configuration" => "19adf69c-62a5-4129-aa2c-685d7b67ed6c"
];

$page_num = 1;

for( $page_num; ;$page_num++ ){

    $params["pageNumber"] = $page_num;
    $url = "https://www.pinsentmasons.com/webapi/listingapi" . "?" . http_build_query($params);
    $response = file_get_contents($url, false, $context);
    $response = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);
    $data = json_decode($response);

    foreach($data->results as $item) {
        getProfile( $item );
    }
    break;
}

function getProfile( $item ) {

    //name, email, *vcard, *fulladress, *primary address, *linkedin, phonenumbers, **fax, *education,
    //*bar admission, *court admission, *practice areas, *acknowledgements, *memberships, positions,
    //*languages, source, description, photo_headshot, photo, spider_name, firm_name 
    $name = "";
    if(@$item->fields->name) {
        $name = $item->fields->name;
    }

    $email = "";
    if(@$item->fields->email) {
        $email = $item->fields->email;
    }

    $phone_numbers = [];
    if(@$item->fields->tel) {
        $phone_numbers[] = $item->fields->tel;
    }

    $positions = [];
    if( @$item->fields->role) {
        $positions[] = $item->fields->role;
    }

    $source = "";
    if(@$item->fields->profileUrl) {
        $source = $item->fields->profileUrl;
    }

    $description = "";
    if(@$item->fields->description) {
        $description = $item->fields->description;
    }

    $photo_headshot = $photo = "";
    if(@$item->fields->profileImageUrl) {
        global $base_url;
        $photo_headshot = $photo = $base_url . $item->fields->profileImageUrl;
    }

    $firm_name = "Pinsent Masons";

    $profile_url = $base_url . $item->fields->profileUrl;
}

