# reverse-string
# Secure PHP Authentication System with Custom String Reversal Dashboard

A secure, lightweight User Authentication (Login/Register) system built using native PHP, MySQL, JavaScript (Fetch API/FormData), and HTML5/CSS3. The project includes a unique custom algorithm implemented on the user dashboard that calculates string length and reverses the logged-in user's name manually, bypassing all built-in PHP string manipulation functions.

## 🚀 Features

- **Asynchronous Authentication Engine**: Implements JavaScript `Fetch API` and `FormData` payloads to process user registration and login securely without full-page reloads.
- **Password Hashing Security**: Utilizes PHP's native `password_hash()` with `PASSWORD_DEFAULT` (bcrypt) for robust cryptography and `password_verify()` during credentials validation.
- **Prepared Database Statements**: Uses MySQLi parameterized prepared statements to eliminate the risk of SQL Injection attacks.
- **Custom-Built String Reversal Engine**: Features a unique dashboard component that manually parses string elements to discover boundaries and display the session user's name in reverse without using `strlen()` or `strrev()`.
- **Session Management Protection**: Secures dashboard rendering via server-side session checks (`session_start()`), redirecting unauthenticated traffic back to the landing gate.

## 🔍 Code Deep Dive: Custom Reversal Logic

To demonstrate low-level string manipulation, the user's name is read character-by-character from the session array directly, dynamically tracking string size and indexing backward:

```php
// 1. Manually calculate string length without strlen()
$length = 0;
while (isset($original_name[$length])) {
    $length++;
}

// 2. Manually reverse the string structure without strrev()
$reversed_name = "";
for ($i = $length - 1; $i >= 0; $i--) {
    $reversed_name .= $original_name[$i];
}
