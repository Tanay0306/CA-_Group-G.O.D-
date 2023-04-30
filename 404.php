<!DOCTYPE html>
<html>
<head>
	<title>Error 404 - Page Not Found</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {
			font-family: 'Montserrat', sans-serif;
			background-color: #f9f9f9;
			color: #333;
			line-height: 1.5;
			margin: 0;
			padding: 0;
		}
		
		h1 {
			font-size: 4rem;
			font-weight: 700;
			margin-top: 3rem;
			text-align: center;
		}
		
		p {
			font-size: 1.6rem;
			margin-top: 2rem;
			text-align: center;
		}
		
		img {
			display: block;
			margin: 4rem auto;
			max-width: 25%;
			height: auto;
			border-radius: 50%;
			box-shadow: 0 0 20px rgba(0,0,0,0.3);
		}
		
		.button {
			display: inline-block;
			padding: 1rem 2rem;
			background-color: #333;
			color: #fff;
			text-decoration: none;
			font-size: 1.6rem;
			border-radius: 2rem;
			transition: all 0.2s ease;
			margin-top: 2rem;
			margin-bottom: 4rem;
		}
		
		.button:hover {
			background-color: #555;
		}
		
		@media (max-width: 768px) {
			h1 {
				font-size: 3rem;
				margin-top: 2rem;
			}
			
			p {
				font-size: 1.4rem;
				margin-top: 1rem;
			}
			
			img {
				margin: 2rem auto;
			}
			
			.button {
				margin-top: 1rem;
				margin-bottom: 2rem;
			}
		}
	</style>
	<script>
		setTimeout(function(){
			window.location.href = 'index.php';

		}, 3000);
	</script>
</head>
<body>
	<h1>Error 404 - Page Not Found</h1>
	<img src="https://www.hostinger.com/tutorials/wp-content/uploads/sites/2/2018/06/Error-404-on-Opera.webp" alt="404 Error Image">
	<p>Oops! Looks like the page you are looking for doesn't exist. Please check the URL or try searching for the page using the search bar above. In 3 seconds you will be redirected to home page</p>
	
</body>
</html>
