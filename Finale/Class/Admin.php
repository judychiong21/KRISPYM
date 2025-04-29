<?php
include('Connection.php');

class Login extends Connection {
    public function login($username, $password) {
        $stmt = $this->connect()->query("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $users['password'])) {
                $_SESSION['usesrname'] = $users['username'];
                $_SESSION['password'] = $users['password'];
               

                if ($user['role'] === 'admin') {
                    return ['success' => true, 'redirect' => 'Admin.php'];
                } else {
                    return ['success' => true, 'redirect' => 'Users.php'];
                }
            } else {
                return ['success' => false, 'error' => 'Incorrect password.'];
            }
        } else {
            return ['success' => false, 'error' => 'Account not found.'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inittial-scale=1.0">
    <title> Login Admin</title>
</head>
<body>
    <h2> login admin</h2>

    <?php if (!empty ($error)): ?>
        <p style="color: red;"><?php echo $error; ?> </p>
        <?php endif; ?>

        <form method="post action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="username">username:</label>
                <input type="text" id="username" name="username" required>
    </div>
    <br>
    <div>
                <label for="password">password:</label>
                <input type="text" id="password" name="password" required>
    </div>
    <br>
    <div>
        <input type="submit" value ="login admin">
    </div>
    </form>
    </body>
    </html>
