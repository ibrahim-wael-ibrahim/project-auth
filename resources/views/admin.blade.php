{{-- resources/views/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    {{-- Register User Form --}}
    <h2>Register User</h2>
    <form action="{{ url('/auth/register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="role" placeholder="Role" required>
        <button type="submit">Register</button>
    </form>

    {{-- List of Employees --}}
    <h2>Employees</h2>
    <ul id="employee-list">
        <!-- Employee list will be rendered here -->
    </ul>

    {{-- JavaScript to interact with the routes --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch employees data
            fetch('/admin', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('sanctum_token') // Sanctum token stored in localStorage
                }
            })
            .then(response => response.json())
            .then(data => {
                const employeeList = document.getElementById('employee-list');
                data.forEach(employee => {
                    const li = document.createElement('li');
                    li.textContent = `${employee.name} (${employee.email})`;
                    employeeList.appendChild(li);
                });
            })
            .catch(error => console.error('Error fetching employees:', error));
        });
    </script>
</body>
</html>
