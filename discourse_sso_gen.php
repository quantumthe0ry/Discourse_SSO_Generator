<?php

// Replace this with the actual Discourse SSO secret you have
$discourse_sso_secret = '';

// Define the user data (replace with actual values or test values)
$userData = [
    'nonce' => '333666999',  // Replace with the actual nonce from Discourse
    'email' => 'email@email.com',
    'external_id' => '9193',  // Unique identifier for the user in your app
    'name' => 'John Doe',
    'add_groups' => 'trust_level_4,admin'  // Example groups
];

// Step 1: URL encode and Base64 encode the user data
$query = http_build_query($userData);
$base64Query = base64_encode($query);

// Step 2: Generate the HMAC-SHA256 signature using the secret
$signature = hash_hmac('sha256', $base64Query, $discourse_sso_secret);

// Display the constructed payload
echo "SSO Payload:\n";
echo "sso=" . $base64Query . "\n";
echo "sig=" . $signature . "\n";

?>
