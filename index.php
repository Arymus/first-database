<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Arymus Reyes">
        <meta charset="UTF-8">
        <title>Ary's SQLite Database</title>
    </head>
    <body>
        <header>
            <h1>Database</h1>
        </header>
        <main>
            <form method="POST">
            <input placeholder="Username" id="username" required aria-required>

            <input placeholder="Password" id="password" required aria-required>

            <input type="submit" value="Submit"
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $database = new SQLite3("first.db");
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    function postToDatabase($database, $username, $password) {
                        $query = $database->prepare("INSERT INTO user_data (user, password) VALUES(:user, :password);");
                        $query->bindParam(":user", $username);
                        $query->bindParam(":password", password_hash($password, PASSWORD_BCRYPT));
                        $query->execute();
                    }

                    if (strlen($password) < 255) {
                        postToDatabase($database, $username, $password);
                    } else {
                        echo "<p>Password too long!</p>";
                    }

                    if (empty($password) || empty($username)) {
                        echo "<p>Please enter a username AND password.</p>";
                    }
                }
            ?>
            >
            </form>
        </main>
    </body>
</html>