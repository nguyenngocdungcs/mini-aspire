<?php

function callAPI($method, $url, $data = false, $header = false)
{
    $curl = curl_init();

    if ($header) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
}

function getAcronym($string) {
    $words = explode(" ", $string);
    $acronym = "";

    foreach ($words as $w) {
        $acronym .= strtoupper($w[0]);
    }
    return $acronym;
}

function expectsJson()
{
    return request()->expectsJson();
}
