<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 24px;
            color: #333;
        }

        .login-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }

        .login-container .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Login</h1>

    <form id="loginForm">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div class="error-message" id="error-message" style="display: none;"></div>

        <button type="submit">Login</button>
    </form>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        axios.post('/api/login', { username, password })
            .then(response => {
                localStorage.setItem('access_token', response.data.access_token);  // Salva il token in localStorage
                window.location.href = '/breweries';  // Reindirizza alla pagina dei birrifici
            })
            .catch(error => {
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = 'Login failed. Please check your credentials.';
                errorMessage.style.display = 'block';  // Mostra il messaggio di errore
                console.error(error);
            });
    });
</script>

</body>
</html>
