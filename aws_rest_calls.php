<?php

// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "";

// The region you are interested in
$endpoint = "webservices.amazon.com";

$uri = "/onca/xml";

$handle = fopen("arxiuRamon_titols_anys.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $line = trim(preg_replace('/\s\s+/', '', $line));

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAJ7236BNNRQ3JSLIQ",
            "AssociateTag" => "jordisthought-21",
            "SearchIndex" => "Movies",
            "Keywords" => "$line",
            "ResponseGroup" => "Images,ItemAttributes,Offers",
            "Sort" => "relevancerank"
        );


        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        // echo join(" ", $params) . "\n";

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

        // Generate the signed URL
        $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

        echo "curl \"".$request_url."\"\n";

    }

    fclose($handle);
} else {
    // error opening the file.
} 


?>