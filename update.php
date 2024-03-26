<?php
include 'config.php';
include 'simple_html_dom.php';

$url = 'https://c9s9o2ofpv-1.algolianet.com/1/indexes/*/queries?x-algolia-api-key=7ff1c4d30eee83d68ff7961455930a8f&x-algolia-application-id=C9S9O2OFPV';
$spider_name = 'Simmons Simmon';

$headers = [
    'Content-Type: application/json',
];

$profiles = [];
$count = 0;

for ($i = 0; $i < 18; $i++) {
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headers),
            'content' => json_encode(array(
                'requests' => [
                    array(
                        "indexName" => "production_public_CvInfoFields",
                        "params" => "filters=locale%3Aen-gb&hitsPerPage=10&distinct=true0&analytics=false&maxValuesPerFacet=100&query=&highlightPreTag=__ais-highlight__&highlightPostTag=__%2Fais-highlight__&page=" . $i . "&facets=%5B%22sectors.fields.title%22%2C%22services.fields.title%22%2C%22contact.fields.offices.fields.title%22%5D&tagFilters=&attributesToRetrieve=%5B%22parent%22%2C%22slug%22%5D"
                    )
                ]
            ))
        ],
    ]);
    $response = file_get_contents($url, false, $context);
    
    $data = json_decode($response, true)['results'][0]['hits'];
    foreach($data as $item) {
        echo ++$count . "\n";
        $profiles[] = getProfile($item);
    }

    //Save data per 30 profiles
    if(count($profiles) == 30){
        // Convert the array to JSON format
        $json = json_encode($profiles);

        // Specify the file path
        $file_path = 'simon-data/batch'.(($i + 1) / 3).'.json';

        // Open the file for writing (create it if it doesn't exist)
        $file_handle = fopen($file_path, 'w');

        // Check if the file was opened successfully
        if ($file_handle !== false) {
            // Write the JSON string to the file
            fwrite($file_handle, $json);

            // Close the file handle
            fclose($file_handle);
            $profiles = [];
        } else {
            // Output an error message if the file could not be opened
            echo "Failed to open $file_path for writing.";
        }
    }
}

function getProfile( $data ){

    $contact_info = $data["_highlightResult"]["contact"]["fields"][0];

    $name = $contact_info["firstName"]["value"] ." ". $contact_info["lastName"]["value"];
    
    $email = $contact_info["emailAddress"]["value"];

    $primary_address = $full_address = $contact_info["offices"][0]["fields"][0]["title"]["value"] . ", " . 
        $contact_info["offices"][0]["fields"][0]["country"]["fields"][0]["title"]["value"];

    $description = $data["_highlightResult"]["overview"]["value"];
     
    $parent_id = $data['parent']['id'];
    $slug = $data['slug'];

    $url = "https://data.simmons-simmons.com/api/public";

    $headers = [
        'Content-Type: application/json',
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headers),
            'content' => json_encode(array(
                array(
                    "operationName" => "Detail",
                    "variables" => array(
                        "id" => $parent_id,
                        "isRoot" => false,
                        "published" => true,
                        "slug" => $slug,
                        "locale" => "en-gb",
                        "locales" => [ "en-gb" ]
                    ),
                    "query" => "query Detail(\$id: String!, \$locale: String!) {\n  Detail: cVInfoFieldses(\n    where: {locale: {equals: \$locale}, cvInfo: {id: {equals: \$id}}}\n  ) {\n    contact {\n      fields(where: {locale: {equals: \$locale}}) {\n        emailAddress\n        firstName\n        id\n        image {\n          fields(where: {locale: {equals: \$locale}}) {\n            alt\n            caption\n            id\n            published\n            __typename\n          }\n          id\n          published\n          url\n          __typename\n        }\n        keywords\n        lastName\n        mobileNumber\n        offices {\n          officeInfoFields {\n            id\n            permissions\n            published\n            slug\n            title\n            __typename\n          }\n          id\n          published\n          __typename\n        }\n        officesOrder\n        phoneNumbers\n        published\n        salutation\n        slug\n        title\n        __typename\n      }\n      id\n      published\n      __typename\n    }\n    id\n    linkedInProfile {\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      url\n      __typename\n    }\n    managementTitle {\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      __typename\n    }\n    overview\n    ctaLink {\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      url\n      __typename\n    }\n    ctaEmailSubject\n    ctaColour\n    permissions\n    position {\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      __typename\n    }\n    published\n    sectors {\n      id\n      parentSectorFields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        sector {\n          id\n          sectorInfoFields(where: {locale: {equals: \$locale}}) {\n            id\n            published\n            slug\n            permissions\n            __typename\n          }\n          parentSectorFields(where: {locale: {equals: \$locale}}) {\n            id\n            published\n            sector {\n              id\n              sectorInfoFields(where: {locale: {equals: \$locale}}) {\n                id\n                published\n                slug\n                permissions\n                __typename\n              }\n              published\n              __typename\n            }\n            __typename\n          }\n          published\n          __typename\n        }\n        __typename\n      }\n      sectorInfoFields(where: {locale: {equals: \$locale}}) {\n        displayTitle\n        id\n        permissions\n        published\n        sectorInfo {\n          id\n          published\n          __typename\n        }\n        slug\n        title\n        __typename\n      }\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      __typename\n    }\n    sectorsOrder\n    services {\n      id\n      parentServiceFields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        service {\n          id\n          serviceInfoFields(where: {locale: {equals: \$locale}}) {\n            id\n            published\n            slug\n            permissions\n            __typename\n          }\n          parentServiceFields(where: {locale: {equals: \$locale}}) {\n            id\n            published\n            service {\n              id\n              serviceInfoFields(where: {locale: {equals: \$locale}}) {\n                id\n                published\n                slug\n                permissions\n                __typename\n              }\n              published\n              __typename\n            }\n            __typename\n          }\n          published\n          __typename\n        }\n        __typename\n      }\n      serviceInfoFields(where: {locale: {equals: \$locale}}) {\n        displayTitle\n        id\n        permissions\n        published\n        serviceInfo {\n          id\n          published\n          __typename\n        }\n        slug\n        title\n        __typename\n      }\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      __typename\n    }\n    servicesOrder\n    tagline\n    title\n    metaDescription\n    twitterProfile {\n      fields(where: {locale: {equals: \$locale}}) {\n        id\n        published\n        title\n        __typename\n      }\n      id\n      published\n      url\n      __typename\n    }\n    __typename\n  }\n  DetailTranslations: cVInfoFieldses(\n    where: {locale: {not: {equals: \$locale}}, cvInfo: {id: {equals: \$id}}, published: {equals: true}}\n  ) {\n    id\n    locale\n    overview\n    permissions\n    published\n    tagline\n    __typename\n  }\n}\n"
                )
            ))
        ],
    ]);

    $response = json_decode(file_get_contents($url, false, $context));
    $response = $response[0]->data;

   
    $phone_numbers = $response->Detail[0]->contact->fields[0]->phoneNumbers;
   
    $fax_numbers = array();

    $linkedin = '';
    if($response->Detail[0]->linkedInProfile != null) 
        $linkedin = $response->Detail[0]->linkedInProfile->url;
    

    $practice_areas = array();
    foreach($response->Detail[0]->sectors as $sector) {
        $practice_areas[] = $sector->sectorInfoFields[0]->displayTitle;
    }

    $positions = array();
    $positions[] = $response->Detail[0]->position->fields[0]->title;

    $firm_name = "Simmons Simmon";

    $photo = $photo_headshot = '';
    if( $response->Detail[0]->contact->fields[0]->image != null ) {
        $photo = $photo_headshot = $response->Detail[0]->contact->fields[0]->image->url;
    }
    return array(
        "name" => $name,
        "email" => $email,
        "fullAddress" => $full_address,
        "primaryAddress" => $primary_address,
        "Linkedin" => $linkedin,
        "phone_numbers" => $phone_numbers,
        "fax" => $fax_numbers,
        "practice_areas" => $practice_areas,
        "positions" => $positions,
        "source" => $url,
        "description" => $description,
        "photo" => $photo,
        "photo_headshot" => $photo_headshot,
        "firm_name" => $firm_name
    );
}