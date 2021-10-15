<?php 

$postfields = array(
    "visitor_id" => "YOUR_VISITOR_ID",
    "context" => array(
        
    ),
    // For the Decision API to trigger a campaign activation hit, use
    "trigger_hit" => true,
    // Optional : see https://developers.flagship.io/docs/decision-api/v2#decision-group for more details
    "decision_group"=> null
);
  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://decision.flagship.io/v2/{{ENV_ID}}/campaigns');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postfields, JSON_FORCE_OBJECT));
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Api-Key: {{API_KEY}}';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);
