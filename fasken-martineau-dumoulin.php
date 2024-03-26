<?php

include 'config.php';
include 'simple_html_dom.php';

$base_url = 'https://www.fasken.com';
$url = "https://faskenmartineau.org.coveo.com/rest/search/v2?organizationId=faskenmartineau";
$spider_name = 'fasken-martineau-dumoulin';

$headers = [
    'Content-Type: application/json',
    "Authorization: Bearer xx008a3fce-a0af-4aaf-ad0c-c9372161e8e8"
];

$request_body = array(
    "fieldsToInclude" => [ "author",
        "language",
        "urihash",
        "objecttype",
        "collection",
        "source",
        "permanentid",
        "date",
        "filetype",
        "parents",
        "ec_price",
        "ec_name",
        "ec_description",
        "ec_brand",
        "ec_category",
        "ec_item_group_id",
        "ec_shortdesc",
        "ec_thumbnails",
        "ec_images",
        "ec_promo_price",
        "ec_in_stock",
        "ec_rating",
        "lastname",
        "relatedofficesname",
        "imageurl",
        "fullname",
        "shortbiography",
        "phone1",
        "email",
        "phone2",
        "phone3",
        "fax",
        "tollfree",
        "peoplerole",
        "barjurisdiction",
        "spokenlanguagename",
        "relatedindustriesname",
        "relatedmarketsname",
        "relatedpracticesname",
        "schoolnames",
        "education",
        "z95xtemplate",
        "feminiz122xetitle"],
    "sortCriteria" => "@lastname ascending",
    "numberOfResults" => 30,
    "firstResult" => 0,
    "aq" => "(@z95xlanguage==\"en\")(@source==\"Website-CoveoAtomic-PRD-SC10\")(@z95xpath = \"27d34f3f-f921-4c2c-909a-40c3a40b9eb3\" AND NOT @z95xid == \"27D34F3FF9214C2C909A40C3A40B9EB3\")"
);

$total_count = 30;
$i = 0;
$count = 0;
$lawyers = [];
for ($i = 0; $i < ceil($total_count / 30.0); $i++) {

    if($i > 0) {
        $request_body["firstResult"] = 30 * $i;
    }
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headers),
            'content' => json_encode($request_body)
        ],
    ]);
    $response = json_decode(file_get_contents($url, false, $context));
    
    //check if the data is valid
    if($response != null) {
        //Get Total Number of Lawyers
        if($i == 0) {
            $total_count = $response->totalCount;
        }
        if($response->results) {
            foreach($response->results as $item) {
                //Get Profile
                echo $count . "\n";
                $lawyers[] = getProfile($item);
                $count++;
            }
        }

        //Save data per 30 profiles
        if(count($lawyers) > 0){
            // Convert the array to JSON format
            $json = json_encode($lawyers);

            // Specify the file path
            $file_path = 'fasken-data/batch'. $i . '.json';

            // Open the file for writing (create it if it doesn't exist)
            $file_handle = fopen($file_path, 'w');

            // Check if the file was opened successfully
            if ($file_handle !== false) {
                // Write the JSON string to the file
                fwrite($file_handle, $json);

                // Close the file handle
                fclose($file_handle);
                $lawyers = [];
            } else {
                // Output an error message if the file could not be opened
                echo "Failed to open $file_path for writing.";
            }
        }
        break;
    }
    else {
        //Failed to get data
        break;
    }
}

//linkedin education description
function getProfile( $data ){
    $name = @$data->title; 
    $email = @$data->raw->email;
    $full_address = $primary_address = "";

    $phone_numbers = [];
    if(@$data->raw->phone1) $phone_numbers[] = $data->raw->phone1;
    if(@$data->raw->phone2) $phone_numbers[] = $data->raw->phone2;
    if(@$data->raw->phone3) $phone_numbers[] = $data->raw->phone3;

    $fax = [];
    if(@$data->raw->fax) $phone_numbers[] = $data->raw->fax;

    $bar_admissions = [];
    if(@$data->raw->barjurisdiction) $bar_admissions = $data->raw->barjurisdiction;

    $court_admissions = [];

    $practice_areas = [];
    if(@$data->raw->relatedpracticesname) $practice_areas = $data->raw->relatedpracticesname;

    $acknowledgements = [];

    $memberships = [];

    $positions = [];
    if(@$data->raw->peoplerole) $positions = $data->raw->peoplerole;

    $langauges = [];
    if(@$data->raw->spokenlanguagename) $langauges = $data->raw->spokenlanguagename;

    $source = "";
    if(@$data->clickUri) $source = $data->clickUri;

    $photo_headshot = $photo = "";
    if(@$data->raw->imageurl) $photo_headshot = $photo = $data->raw->imageurl;

    $spider_name = "fasken-martineau-dumoulin";
    $firm_name = "Fasken Martineau Dumoulin";


    //Get data from click profile.
    $url = $source;
    $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));
    
    //Check if we fetched data correctly.
    if($html != false) {
        $linkedin = "";
        try{
            $linkedin = $html->find('.socials.bio-socials', 0)->find('.socials-list', 0)->find('li', 0)->find('a', 0)->href;
            if(strpos($linkedin, "linkedin.com") == false) $linkedin = "";
        } catch(Throwable $e) {}
        
        $vcard = "";
        try{
            global $base_url;
            $vcard = $base_url . $html->find('a.vcard-icon', 0)->href;
        } catch(Throwable $e) {
        }

        $description = "";
        try{
            $description = @$html->find("#overview-content", 0)->plaintext;
            //process description
            $description = trim($description);
            $description = rtrim($description);
            $description = str_replace("\n","", $description);
        } catch(Throwable $e) {}

        $education = [];
        try{
            foreach($html->find(".events.education", 0)->find(".list")->find('li') as $item){
                $university = $$item->find(".name", 0)->plaintext . ", " . $item->find(".description", 0)->plaintext;
                $university = trim($university);
                $university = rtrim($university);
                $education[] = $university;
            }
        } catch(Throwable $e) {}
    }
    else{
        //Failed to get data by clicking.
        return array();
    }
    return array(
        "name" => $name,
        "email" => $email,
        "vcard" => $vcard,
        "fullAddress" => $full_address,
        "primaryAddress" => $primary_address,
        "education" => $education,
        "Linkedin" => $linkedin,
        "phone_numbers" => $phone_numbers,
        "fax" => $fax,
        "bar_admissions" => $bar_admissions,
        "court_admissions" => $court_admissions,
        "practice_areas" => $practice_areas,
        "positions" => $positions,
        "source" => $url,
        "description" => $description,
        "languages" => $langauges,
        "photo" => $photo,
        "photo_headshot" => $photo_headshot,
        "firm_name" => $firm_name,
        "spider_name" => $spider_name
    );
}
