<!DOCTYPE html>
<html>
<head>
    <title>Breweries</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        #pagination {
            text-align: center;
            margin-top: 20px;
        }

        #pagination button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        #pagination button:hover {
            background-color: #45a049;
        }

        #pagination button.active {
            background-color: #45a049;
        }

        #logoutButton {
            display: block;
            margin: 20px auto;
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        #logoutButton:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<h1 id="title" style="display: none;">Breweries</h1>
<button id="logoutButton">Logout</button>

<div id="brewery-section" style="display: none;">
    <table id="breweries-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>City</th>
            <th>State</th>
            <th>Street</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Website</th>
        </tr>
        </thead>
        <tbody id="breweries-body">
        <!-- Le righe della tabella verranno inserite qui -->
        </tbody>
    </table>
    <div id="pagination">
        <!-- La paginazione verrà inserita qui -->
    </div>
</div>
<div id="error-message"></div>

<!-- JavaScript -->
<script>
    let allBreweries = [];
    const itemsPerPage = 10;

    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('access_token');

        if (!token) {
            window.location.href = '/login';
            return;
        }

        // Verifica token
        axios.get('/api/validate-token', {
            headers: { 'Authorization': 'Bearer ' + token }
        })
            .then(() => {
                loadAllBreweries();
            })
            .catch(error => {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('access_token');
                    window.location.href = '/login';
                } else {
                    console.error('Error validating token:', error);
                    alert('An error occurred while validating the token.');
                }
            });

        // Logout
        document.getElementById('logoutButton').addEventListener('click', function() {
            axios.post('/api/logout', {}, {
                headers: { 'Authorization': 'Bearer ' + token }
            })
                .then(() => {
                    localStorage.removeItem('access_token');
                    window.location.href = '/login';
                })
                .catch(error => {
                    console.error('Error logging out:', error);
                    alert('An error occurred while logging out.');
                });
        });
    });

    // Carica tutte le birrerie
    function loadAllBreweries() {
        const token = localStorage.getItem('access_token');

        axios.get('/api/breweries', {
            headers: { 'Authorization': 'Bearer ' + token }
        })
            .then(response => {
                allBreweries = response.data;
                renderBreweries(1);
                renderPagination();
            })
            .catch(error => {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('access_token');
                    window.location.href = '/login';
                } else {
                    console.error('Error fetching breweries:', error);
                    alert('An error occurred while fetching breweries.');
                }
            });
    }

    // Mostra birrerie
    function renderBreweries(page) {
        const tbody = document.getElementById('breweries-body');
        tbody.innerHTML = '';

        const startIndex = (page - 1) * itemsPerPage;
        const breweriesToDisplay = allBreweries.slice(startIndex, startIndex + itemsPerPage);

        breweriesToDisplay.forEach(brewery => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${brewery.name}</td>
                <td>${brewery.brewery_type}</td>
                <td>${brewery.city}</td>
                <td>${brewery.state}</td>
                <td>${brewery.street}</td>
                <td>${brewery.postal_code}</td>
                <td>${brewery.phone}</td>
                <td><a href="${brewery.website_url || '#'}" target="_blank">${brewery.website_url ? 'Website' : 'N/A'}</a></td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById('brewery-section').style.display = 'block';
        document.getElementById('title').style.display = 'block';
    }

    // Gestione paginazione
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const totalPages = Math.ceil(allBreweries.length / itemsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.onclick = () => renderBreweries(i);

            if (i === 1) pageButton.classList.add('active');
            pagination.appendChild(pageButton);
        }
    }
</script>
</body>
</html>
