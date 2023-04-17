<!-- <!DOCTYPE html>
<html>
<head>
	<title>Movie List</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.movie-container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}
		
		.movie-list {
			display: flex;
			flex-wrap: wrap;
		}
		.movie {
			width: 300px;
			margin: 20px;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
		}
		.movie img {
			width: 100%;
			height: 400px;
			object-fit: cover;
			border-radius: 5px;
		}
		.movie h2 {
			font-size: 24px;
			margin-top: 10px;
			margin-bottom: 5px;
		}
		.movie p {
			font-size: 16px;
			margin-top: 5px;
			margin-bottom: 10px;
		}
		.movie button {
			display: block;
			width: 100%;
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #0077ff;
			color: #fff;
			font-size: 16px;
			cursor: pointer;
		}
		.movie button:hover {
			background-color: #0055cc;
		}
	</style>
</head>
<body>
	<div class="movie-container">
		
		<div class="movie-list">
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+1" alt="Movie 1">
				<h2>Movie 1</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+2" alt="Movie 2">
				<h2>Movie 2</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+3" alt="Movie 3">
				<h2>Movie 3</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+4" alt="Movie 4">
				<h2>Movie 4 </h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+5" alt="Movie 5">
				<h2>Movie 5</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
			<div class="movie">
				<img src="https://via.placeholder.com/300x400.png?text=Movie+6" alt="Movie 6">
				<h2>Movie 6</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
				<button>Book Now</button>
			</div>
		</div>
	</div>
</body>
</html> -->
<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <style>
    /* General styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 16px;
    }
    
    /* Header styles */
    header {
      background-color: black;
      color: white;
      padding: 20px;
    }
    
    h1 {
      margin: 0;
      font-size: 36px;
    }
    
    /* Profile styles */
    .profile {
      max-width: 600px;
      margin: auto;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }
    
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      vertical-align: top;
    }
    
    th {
      background-color: #eee;
      font-weight: bold;
    }
    
    /* Footer styles */
    footer {
      background-color: black;
      color: white;
      padding: 20px;
      text-align: center;
    }
    
    footer p {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>
<body>
<?php
  // Assume we have fetched the user's profile data from a database
  $user = array(
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'johndoe@example.com',
    'date_of_birth' => '1990-01-01',
    'phone' => '123-456-7890'
  );
  ?>
  <header>
    <h1>User Profile</h1>
  </header>
  
  <div class="profile">
    <table>
      <tr>
        <th>First Name</th>
        <td><?php echo $user['first_name']; ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo $user['last_name']; ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $user['email']; ?></td>
      </tr>
      <tr>
        <th>Date of Birth</th>
        <td><?php echo date('d/m/Y', strtotime($user['date_of_birth'])); ?></td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td><?php echo $user['phone']; ?></td>
      </tr>
    </table>
  </div>
  
  <footer>
    <p>&copy; 2023 My Company, Inc. All rights reserved.</p>
  </footer>
</body>
</html>

