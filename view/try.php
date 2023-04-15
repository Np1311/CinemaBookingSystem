<!DOCTYPE html>
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
</html>
