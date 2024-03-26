<?php

include 'config.php';
include 'simple_html_dom.php';
include 'util.php';

// $base_url = 'https://www.freshfields.com';
// $spider_name = 'freshfields_spider';

// $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page=1';
// $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));

$url = 'https://www.fasfken.com/en/wjoseph-abboud-dager';
// $response = file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url));
$html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));file_get_contents($url);

if($html == false){
    echo "fwef";
}
// echo $response;


//Get the page count in total
// $page_count = $html->find('a:contains("Last")', 0);

// for($page_index = 1; $page_index <= $page_count; $page_index++){
//     if($page_count > 1) {
//         $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page='.$page_index;
//         $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));
//     }

//     //Get profile url
//     foreach($html->find('.mix') as $item){
//         $profile_url = $item->find('a', 0)->href;
//         $profile_url = $base_url.$profile_url;
//         // $lawyers[] = getProfile($profile_url);
//         // echo 'count:'.$count++;
//         echo $profile_url;
//     }

    //Save data in json format
    // if($page_index % 2 == 0){
    //     // Convert the array to JSON format
    //     $json = json_encode($lawyers);

    //     // Specify the file path
    //     $file_path = 'data'.($page_index / 2).'.json';

    //     // Open the file for writing (create it if it doesn't exist)
    //     $file_handle = fopen($file_path, 'w');

    //     // Check if the file was opened successfully
    //     if ($file_handle !== false) {
    //         // Write the JSON string to the file
    //         fwrite($file_handle, $json);

    //         // Close the file handle
    //         fclose($file_handle);
    //         $lawyers = array();
    //     } else {
    //         // Output an error message if the file could not be opened
    //         echo "Failed to open $file_path for writing.";
    //     }
    // }
// }
// $data = getProfile('https://www.freshfields.com/en-gb/contacts/find-a-lawyer/b/bruce-eric/');
// echo json_encode($data);
// function getProfile( $url ){
//     $html = str_get_html(file_get_contents( $url ));

//     $profile_detail = getElementText($html->find('#qualifications', 0));
//     $ai_response = fetchOpenAIReponse($profile_detail);

//     // Get Name
//     try{
//         $name = $html->find('.hero-profile-inner', 0)->find('h1', 0)->plaintext;
//     } catch(Exception $e){
//         $name = '';
//     }
//     // Get Email
//     try{
//         $email = $html->find('.contact-info', 0)->find('a', 0)->plaintext;
//     } catch(Exception $e){
//         $email = '';
//     }
//     //Get VCard
//     $vcard = '';

//     // Get Full Address
//     $full_address = '';
//     try{
//         $full_address = trim($html->find('.us-info-footer-profile', 0)->find('address', 0)->plainttext);
//     } catch(Exception $e){

//     }

//     //Get Primary Address
//     $primary_address = '';
//     try{
//         $primary_address = trim($html->find('.us-info-footer-profile', 0)->find('h4', 0)->plainttext);
//     } catch(Exception $e){
//     }

//     // Linkedin URL
//     $linkedin = '';

//     //Get Phone Numbers
//     $phone_numbers = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Phone"]') as $item){
//             $phone_numbers[] = explode(":", $item->parent()->href)[1];
//             break;
//         }
//     } catch(Exception $e){
//     }
//     //Get Fax
//     $fax = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Fax"]') as $item){
//             $fax[] = explode(":", $item->parent()->href)[1];
//         }
//     } catch(Exception $e){
//     }

//     // Get Educations
//     $education = array();
//     try{
//         $education = $ai_response["Education"];
//     } catch(Exception $e){
//     }

//     //Get Bar Admissions
//     $bar_admissions = array();
//     try{
//         $bar_admissions = $ai_response["Bar Admissions"];
//     } catch(Exception $e){
//     }

//     //Get Court Admissions
//     $court_admissions = array();
//     try{
//         $court_admissions = $ai_response["Court Admissions"];
//     } catch(Exception $e){}

//     // Get Practice Areas
//     $practice_areas = array();
//     try{
//         foreach($html->getElementById('collapseListGroup1')->find('li') as $element){
//             $practice_areas[] = trim($element->find('a', 0)->plaintext);
//         }
//     } catch(Exception $e){
//     }

//     //Get Acknowledgements
//     $acknowlegements = array();
//     try{
//         $acknowlegements[] = $ai_response["Acknowledgements"];
//     } catch(Exception $e){}
//     //Get memeberships
//     $memberships = array();

//     // Get Positions
//     $positions = array();
//     try{
//         $positions[] = $html->find('.hero-profile-inner', 0)->find('p', 0)->plaintext;
//     } catch(Exception $e){}

//     //Get Languages
//     $languages = array();
//     try{
//         $languages = $ai_response["Languages"];
//     } catch(Exception $e){
//     }

//     //Get Source
//     $source = $url;

//     //Get Description
//     $description = '';
//     try{
//         foreach($html->getElementById('about')->find('p') as $item){
//             $description .= trim($item->plaintext);
//         }
//     } catch(Exception $e){}

//     //Get Photo
//     $photo = $html->find('.hero-profile-inner', 0)->find('img', 0)->src;
//     $photo = 'https://www.freshfields.com'.$photo;

//     //Get Photo HeadShot
//     $photo_headshot = $photo;

//     //Get Firm Name
//     $firm_name = 'fresh_fields';

//     //Get law school
//     $law_school = array();
//     try{
//         $law_school = $ai_response["School of Law"];
//     }catch(Exception $e){}

//     //Get JD year
//     $jd_year = "";
//     try{
//         $jd_year = $ai_response["JD year"];
//     }catch(Exception $e){}

//     $data = array("name"=>$name, "email"=>$email, "fullAddress"=>$full_address,
//         "primaryAddress"=>$primary_address, "linkedin"=>$linkedin, "phoneNumbers"=>$phone_numbers,
//         "fax"=>$fax, "education"=>$education, "barAdmissions"=>$bar_admissions, "courtAdmissions"=>$court_admissions,
//         "practiceAreas"=>$practice_areas, "acknowledgements"=>$acknowlegements, "memberships"=>$memberships,
//         "positions"=>$positions, "languages"=>$languages, "source"=>$source, "description"=>$description,
//         "photo"=>$photo, "firmName"=>$firm_name, "lawSchool"=>$law_school, "JD Year"=> $jd_year);

//     return $data;
// }


<?php

include 'config.php';
include 'simple_html_dom.php';
include 'util.php';

// $base_url = 'https://www.freshfields.com';
// $spider_name = 'freshfields_spider';

// $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page=1';
// $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));

$url = 'https://www.fasfken.com/en/wjoseph-abboud-dager';
// $response = file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url));
$html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));file_get_contents($url);

if($html == false){
    echo "fwef";
}
// echo $response;


//Get the page count in total
// $page_count = $html->find('a:contains("Last")', 0);

// for($page_index = 1; $page_index <= $page_count; $page_index++){
//     if($page_count > 1) {
//         $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page='.$page_index;
//         $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));
//     }

//     //Get profile url
//     foreach($html->find('.mix') as $item){
//         $profile_url = $item->find('a', 0)->href;
//         $profile_url = $base_url.$profile_url;
//         // $lawyers[] = getProfile($profile_url);
//         // echo 'count:'.$count++;
//         echo $profile_url;
//     }

    //Save data in json format
    // if($page_index % 2 == 0){
    //     // Convert the array to JSON format
    //     $json = json_encode($lawyers);

    //     // Specify the file path
    //     $file_path = 'data'.($page_index / 2).'.json';

    //     // Open the file for writing (create it if it doesn't exist)
    //     $file_handle = fopen($file_path, 'w');

    //     // Check if the file was opened successfully
    //     if ($file_handle !== false) {
    //         // Write the JSON string to the file
    //         fwrite($file_handle, $json);

    //         // Close the file handle
    //         fclose($file_handle);
    //         $lawyers = array();
    //     } else {
    //         // Output an error message if the file could not be opened
    //         echo "Failed to open $file_path for writing.";
    //     }
    // }
// }
// $data = getProfile('https://www.freshfields.com/en-gb/contacts/find-a-lawyer/b/bruce-eric/');
// echo json_encode($data);
// function getProfile( $url ){
//     $html = str_get_html(file_get_contents( $url ));

//     $profile_detail = getElementText($html->find('#qualifications', 0));
//     $ai_response = fetchOpenAIReponse($profile_detail);

//     // Get Name
//     try{
//         $name = $html->find('.hero-profile-inner', 0)->find('h1', 0)->plaintext;
//     } catch(Exception $e){
//         $name = '';
//     }
//     // Get Email
//     try{
//         $email = $html->find('.contact-info', 0)->find('a', 0)->plaintext;
//     } catch(Exception $e){
//         $email = '';
//     }
//     //Get VCard
//     $vcard = '';

//     // Get Full Address
//     $full_address = '';
//     try{
//         $full_address = trim($html->find('.us-info-footer-profile', 0)->find('address', 0)->plainttext);
//     } catch(Exception $e){

//     }

//     //Get Primary Address
//     $primary_address = '';
//     try{
//         $primary_address = trim($html->find('.us-info-footer-profile', 0)->find('h4', 0)->plainttext);
//     } catch(Exception $e){
//     }

//     // Linkedin URL
//     $linkedin = '';

//     //Get Phone Numbers
//     $phone_numbers = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Phone"]') as $item){
//             $phone_numbers[] = explode(":", $item->parent()->href)[1];
//             break;
//         }
//     } catch(Exception $e){
//     }
//     //Get Fax
//     $fax = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Fax"]') as $item){
//             $fax[] = explode(":", $item->parent()->href)[1];
//         }
//     } catch(Exception $e){
//     }

//     // Get Educations
//     $education = array();
//     try{
//         $education = $ai_response["Education"];
//     } catch(Exception $e){
//     }

//     //Get Bar Admissions
//     $bar_admissions = array();
//     try{
//         $bar_admissions = $ai_response["Bar Admissions"];
//     } catch(Exception $e){
//     }

//     //Get Court Admissions
//     $court_admissions = array();
//     try{
//         $court_admissions = $ai_response["Court Admissions"];
//     } catch(Exception $e){}

//     // Get Practice Areas
//     $practice_areas = array();
//     try{
//         foreach($html->getElementById('collapseListGroup1')->find('li') as $element){
//             $practice_areas[] = trim($element->find('a', 0)->plaintext);
//         }
//     } catch(Exception $e){
//     }

//     //Get Acknowledgements
//     $acknowlegements = array();
//     try{
//         $acknowlegements[] = $ai_response["Acknowledgements"];
//     } catch(Exception $e){}
//     //Get memeberships
//     $memberships = array();

//     // Get Positions
//     $positions = array();
//     try{
//         $positions[] = $html->find('.hero-profile-inner', 0)->find('p', 0)->plaintext;
//     } catch(Exception $e){}

//     //Get Languages
//     $languages = array();
//     try{
//         $languages = $ai_response["Languages"];
//     } catch(Exception $e){
//     }

//     //Get Source
//     $source = $url;

//     //Get Description
//     $description = '';
//     try{
//         foreach($html->getElementById('about')->find('p') as $item){
//             $description .= trim($item->plaintext);
//         }
//     } catch(Exception $e){}

//     //Get Photo
//     $photo = $html->find('.hero-profile-inner', 0)->find('img', 0)->src;
//     $photo = 'https://www.freshfields.com'.$photo;

//     //Get Photo HeadShot
//     $photo_headshot = $photo;

//     //Get Firm Name
//     $firm_name = 'fresh_fields';

//     //Get law school
//     $law_school = array();
//     try{
//         $law_school = $ai_response["School of Law"];
//     }catch(Exception $e){}

//     //Get JD year
//     $jd_year = "";
//     try{
//         $jd_year = $ai_response["JD year"];
//     }catch(Exception $e){}

//     $data = array("name"=>$name, "email"=>$email, "fullAddress"=>$full_address,
//         "primaryAddress"=>$primary_address, "linkedin"=>$linkedin, "phoneNumbers"=>$phone_numbers,
//         "fax"=>$fax, "education"=>$education, "barAdmissions"=>$bar_admissions, "courtAdmissions"=>$court_admissions,
//         "practiceAreas"=>$practice_areas, "acknowledgements"=>$acknowlegements, "memberships"=>$memberships,
//         "positions"=>$positions, "languages"=>$languages, "source"=>$source, "description"=>$description,
//         "photo"=>$photo, "firmName"=>$firm_name, "lawSchool"=>$law_school, "JD Year"=> $jd_year);

//     return $data;
// }


<?php

include 'config.php';
include 'simple_html_dom.php';
include 'util.php';

// $base_url = 'https://www.freshfields.com';
// $spider_name = 'freshfields_spider';

// $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page=1';
// $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));

$url = 'https://www.fasfken.com/en/wjoseph-abboud-dager';
// $response = file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url));
$html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));file_get_contents($url);

if($html == false){
    echo "fwef";
}
// echo $response;


//Get the page count in total
// $page_count = $html->find('a:contains("Last")', 0);

// for($page_index = 1; $page_index <= $page_count; $page_index++){
//     if($page_count > 1) {
//         $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page='.$page_index;
//         $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));
//     }

//     //Get profile url
//     foreach($html->find('.mix') as $item){
//         $profile_url = $item->find('a', 0)->href;
//         $profile_url = $base_url.$profile_url;
//         // $lawyers[] = getProfile($profile_url);
//         // echo 'count:'.$count++;
//         echo $profile_url;
//     }

    //Save data in json format
    // if($page_index % 2 == 0){
    //     // Convert the array to JSON format
    //     $json = json_encode($lawyers);

    //     // Specify the file path
    //     $file_path = 'data'.($page_index / 2).'.json';

    //     // Open the file for writing (create it if it doesn't exist)
    //     $file_handle = fopen($file_path, 'w');

    //     // Check if the file was opened successfully
    //     if ($file_handle !== false) {
    //         // Write the JSON string to the file
    //         fwrite($file_handle, $json);

    //         // Close the file handle
    //         fclose($file_handle);
    //         $lawyers = array();
    //     } else {
    //         // Output an error message if the file could not be opened
    //         echo "Failed to open $file_path for writing.";
    //     }
    // }
// }
// $data = getProfile('https://www.freshfields.com/en-gb/contacts/find-a-lawyer/b/bruce-eric/');
// echo json_encode($data);
// function getProfile( $url ){
//     $html = str_get_html(file_get_contents( $url ));

//     $profile_detail = getElementText($html->find('#qualifications', 0));
//     $ai_response = fetchOpenAIReponse($profile_detail);

//     // Get Name
//     try{
//         $name = $html->find('.hero-profile-inner', 0)->find('h1', 0)->plaintext;
//     } catch(Exception $e){
//         $name = '';
//     }
//     // Get Email
//     try{
//         $email = $html->find('.contact-info', 0)->find('a', 0)->plaintext;
//     } catch(Exception $e){
//         $email = '';
//     }
//     //Get VCard
//     $vcard = '';

//     // Get Full Address
//     $full_address = '';
//     try{
//         $full_address = trim($html->find('.us-info-footer-profile', 0)->find('address', 0)->plainttext);
//     } catch(Exception $e){

//     }

//     //Get Primary Address
//     $primary_address = '';
//     try{
//         $primary_address = trim($html->find('.us-info-footer-profile', 0)->find('h4', 0)->plainttext);
//     } catch(Exception $e){
//     }

//     // Linkedin URL
//     $linkedin = '';

//     //Get Phone Numbers
//     $phone_numbers = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Phone"]') as $item){
//             $phone_numbers[] = explode(":", $item->parent()->href)[1];
//             break;
//         }
//     } catch(Exception $e){
//     }
//     //Get Fax
//     $fax = array();
//     try{
//         foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Fax"]') as $item){
//             $fax[] = explode(":", $item->parent()->href)[1];
//         }
//     } catch(Exception $e){
//     }

//     // Get Educations
//     $education = array();
//     try{
//         $education = $ai_response["Education"];
//     } catch(Exception $e){
//     }

//     //Get Bar Admissions
//     $bar_admissions = array();
//     try{
//         $bar_admissions = $ai_response["Bar Admissions"];
//     } catch(Exception $e){
//     }

//     //Get Court Admissions
//     $court_admissions = array();
//     try{
//         $court_admissions = $ai_response["Court Admissions"];
//     } catch(Exception $e){}

//     // Get Practice Areas
//     $practice_areas = array();
//     try{
//         foreach($html->getElementById('collapseListGroup1')->find('li') as $element){
//             $practice_areas[] = trim($element->find('a', 0)->plaintext);
//         }
//     } catch(Exception $e){
//     }

//     //Get Acknowledgements
//     $acknowlegements = array();
//     try{
//         $acknowlegements[] = $ai_response["Acknowledgements"];
//     } catch(Exception $e){}
//     //Get memeberships
//     $memberships = array();

//     // Get Positions
//     $positions = array();
//     try{
//         $positions[] = $html->find('.hero-profile-inner', 0)->find('p', 0)->plaintext;
//     } catch(Exception $e){}

//     //Get Languages
//     $languages = array();
//     try{
//         $languages = $ai_response["Languages"];
//     } catch(Exception $e){
//     }

//     //Get Source
//     $source = $url;

//     //Get Description
//     $description = '';
//     try{
//         foreach($html->getElementById('about')->find('p') as $item){
//             $description .= trim($item->plaintext);
//         }
//     } catch(Exception $e){}

//     //Get Photo
//     $photo = $html->find('.hero-profile-inner', 0)->find('img', 0)->src;
//     $photo = 'https://www.freshfields.com'.$photo;

//     //Get Photo HeadShot
//     $photo_headshot = $photo;

//     //Get Firm Name
//     $firm_name = 'fresh_fields';

//     //Get law school
//     $law_school = array();
//     try{
//         $law_school = $ai_response["School of Law"];
//     }catch(Exception $e){}

//     //Get JD year
//     $jd_year = "";
//     try{
//         $jd_year = $ai_response["JD year"];
//     }catch(Exception $e){}

//     $data = array("name"=>$name, "email"=>$email, "fullAddress"=>$full_address,
//         "primaryAddress"=>$primary_address, "linkedin"=>$linkedin, "phoneNumbers"=>$phone_numbers,
//         "fax"=>$fax, "education"=>$education, "barAdmissions"=>$bar_admissions, "courtAdmissions"=>$court_admissions,
//         "practiceAreas"=>$practice_areas, "acknowledgements"=>$acknowlegements, "memberships"=>$memberships,
//         "positions"=>$positions, "languages"=>$languages, "source"=>$source, "description"=>$description,
//         "photo"=>$photo, "firmName"=>$firm_name, "lawSchool"=>$law_school, "JD Year"=> $jd_year);

//     return $data;
// }


<?php

include 'config.php';
include 'simple_html_dom.php';
include 'util.php';

// $base_url = 'https://www.freshfields.com';
// $spider_name = 'freshfields_spider';

// $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page=1';
// $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));

$url = 'https://www.fasfken.com/en/wjoseph-abboud-dager';
// $response = file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url));
$html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));file_get_contents($url);

if($html == false){
    echo "fwef";
}
// echo $response;


//Get the page count in total
// $page_count = $html->find('a:contains("Last")', 0);

// for($page_index = 1; $page_index <= $page_count; $page_index++){
//     if($page_count > 1) {
//         $url = $base_url.'/en-gb/contacts/find-a-lawyer/?Name=&t=tab&Service=&Role=&Location=&Office=&Industry=&Page='.$page_index;
//         $html = str_get_html(file_get_contents('http://137.184.158.149:3000/?api=getClick&useProxy=1&url='.urlencode($url)));
//     }

//     //Get profile url
//     foreach($html->find('.mix') as $item){
//         $profile_url = $item->find('a', 0)->href;
//         $profile_url = $base_url.$profile_url;
//         // $lawyers[] = getProfile($profile_url);
//         // echo 'count:'.$count++;
//         echo $profile_url;
//     }

    //Save data in json format
    // if($page_index % 2 == 0){
    //     // Convert the array to JSON format
    //     $json = json_encode($lawyers);

    //     // Specify the file path
    //     $file_path = 'data'.($page_index / 2).'.json';

    //     // Open the file for writing (create it if it doesn't exist)
    //     $file_handle = fopen($file_path, 'w');

    //     // Check if the file was opened successfully
    //     if ($file_handle !== false) {
    //         // Write the JSON string to the file
    //         fwrite($file_handle, $json);

    //         // Close the file handle
    //         fclose($file_handle);
    //         $lawyers = array();
    //     } else {
    //         // Output an error message if the file could not be opened
    //         echo "Failed to open $file_path for writing.";
    //     }
    // }
// }
// $data = getProfile('https://www.freshfields.com/en-gb/contacts/find-a-lawyer/b/bruce-eric/');
// echo json_encode($data);
// function getProfile( $url ){
//     $html = str_get_html(file_get_contents( $url ));

//     $profile_detail = getElementText($html->find('#qualifications', 0));
//     $ai_response = fetchOpenAIReponse($profile_detail);

//     // Get Name
//     try{
//         $name = $html->find('.hero-profile-inner', 0)->find('h1', 0)->plaintext;
//     } catch(Exception $e){
//         $name = '';
//     }
//     // Get Email
//     try{
//         $email = $html->find('.contact-info', 0)->find('a', 0)->plaintext;
//     } catch(Exception $e){
//         $email = '';
//     }
//     //Get VCard
//     $vcard = '';

//     // Get Full Address
//     $full_address = '';
//     try{
//         $full_address = trim($html->find('.us-info-footer-profile', 0)->find('address', 0)->plainttext);
//     } catch(Exception $e){

//     }

//     //Get Primary Address
//     $primary_address = '';
//     try{
//         $primary_address = trim($html->find('.us-info-footer-profile', 0)->find('h4', 0)->plainttext);
//     } catch(Exception $e){
//     }

    // Linkedin URL
    $linkedin = '';

    //Get Phone Numbers
    $phone_numbers = array();
    try{
        foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Phone"]') as $item){
            $phone_numbers[] = explode(":", $item->parent()->href)[1];
            break;
        }
    } catch(Exception $e){
    }
    //Get Fax
    $fax = array();
    try{
        foreach($html->find('.us-info-footer-profile', 0)->find('*[title="Fax"]') as $item){
            $fax[] = explode(":", $item->parent()->href)[1];
        }
    } catch(Exception $e){
    }

    // Get Educations
    $education = array();
    try{
        $education = $ai_response["Education"];
    } catch(Exception $e){
    }

    //Get Bar Admissions
    $bar_admissions = array();
    try{
        $bar_admissions = $ai_response["Bar Admissions"];
    } catch(Exception $e){
    }

    //Get Court Admissions
    $court_admissions = array();
    try{
        $court_admissions = $ai_response["Court Admissions"];
    } catch(Exception $e){}

    // Get Practice Areas
    $practice_areas = array();
    try{
        foreach($html->getElementById('collapseListGroup1')->find('li') as $element){
            $practice_areas[] = trim($element->find('a', 0)->plaintext);
        }
    } catch(Exception $e){
    }

    //Get Acknowledgements
    $acknowlegements = array();
    try{
        $acknowlegements[] = $ai_response["Acknowledgements"];
    } catch(Exception $e){}
    //Get memeberships
    $memberships = array();

    // Get Positions
    $positions = array();
    try{
        $positions[] = $html->find('.hero-profile-inner', 0)->find('p', 0)->plaintext;
    } catch(Exception $e){}

    //Get Languages
    $languages = array();
    try{
        $languages = $ai_response["Languages"];
    } catch(Exception $e){
    }

    //Get Source
    $source = $url;

    //Get Description
    $description = '';
    try{
        foreach($html->getElementById('about')->find('p') as $item){
            $description .= trim($item->plaintext);
        }
    } catch(Exception $e){}

    //Get Photo
    $photo = $html->find('.hero-profile-inner', 0)->find('img', 0)->src;
    $photo = 'https://www.freshfields.com'.$photo;

    //Get Photo HeadShot
    $photo_headshot = $photo;

    //Get Firm Name
    $firm_name = 'fresh_fields';

    //Get law school
    $law_school = array();
    try{
        $law_school = $ai_response["School of Law"];
    }catch(Exception $e){}

    //Get JD year
    $jd_year = "";
    try{
        $jd_year = $ai_response["JD year"];
    }catch(Exception $e){}

    $data = array("name"=>$name, "email"=>$email, "fullAddress"=>$full_address,
        "primaryAddress"=>$primary_address, "linkedin"=>$linkedin, "phoneNumbers"=>$phone_numbers,
        "fax"=>$fax, "education"=>$education, "barAdmissions"=>$bar_admissions, "courtAdmissions"=>$court_admissions,
        "practiceAreas"=>$practice_areas, "acknowledgements"=>$acknowlegements, "memberships"=>$memberships,
        "positions"=>$positions, "languages"=>$languages, "source"=>$source, "description"=>$description,
        "photo"=>$photo, "firmName"=>$firm_name, "lawSchool"=>$law_school, "JD Year"=> $jd_year);

    return $data;
}