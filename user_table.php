<!DOCTYPE html>
<html class="bg-gray-200">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="m-8">
	<h1 class="text-center underline text-xl">User Table</h1>
	<br>
	<div class="overflow-x-auto">
		<table class="mx-auto max-w-3xl bg-white rounded-lg shadow-md">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">username</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">firstName</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">lastName</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">email</th>
				</tr>
			</thead>
			<tbody class="divide-y divide-gray-200">
				<?php
				include 'connection.php';

				//retrieve data from user table
				$sql = "SELECT * FROM user";
				$result = $link->query($sql);
				if (!$result) {
					die("Invalid query: " . $db_error);
				}
				if (mysqli_num_rows($result) > 0) {
					while ($row = $result->fetch_assoc()){	
						echo "<tr class='hover:bg-gray-50'>
						<td class='px-6 py-4 whitespace-nowrap'>" . $row["username"] . "</td>
						<td class='px-6 py-4 whitespace-nowrap'>" . $row["firstName"] . "</td>
						<td class='px-6 py-4 whitespace-nowrap'>" . $row["lastName"] . "</td>
						<td class='px-6 py-4 whitespace-nowrap'>" . $row["email"] . "</td>
						</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>

	<!--return button-->
	<div class="mt-8 text-center">
		<form method="post" action="init_db.php">			
			<button type="submit" class="py-2 px-4 font-semibold rounded-lg shadow-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">Return</button>
		</form>
	</div>
</body>
</html>
