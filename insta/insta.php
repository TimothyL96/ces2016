<!DOCTYPE html>
<html>
	<head>
		<title>Instagram API</title>
	</head>
	<body>
		<table>
			<tbody>
				<tr>
					<td>
						User ID:
					</td>
					<td>
						<?= $userid; ?>
					</td>
				</tr>
				<tr>
					<td>
						Username:
					</td>
					<td>
						<?= $username; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Profile Pic:
					</td>
					<td>
						<img src="<?= $userprofilepic; ?>" alt="User Profile Picture">
					</td>
				</tr>
				<tr>
					<td>
						User Full Name:
					</td>
					<td>
						<?= $userfullname; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Bio:
					</td>
					<td>
						<?= $userbio; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Website:
					</td>
					<td>
						<?= $userwebsite; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Media:
					</td>
					<td>
						<?= $usermedia; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Follows:
					</td>
					<td>
						<?= $userfollows; ?>
					</td>
				</tr>
				<tr>
					<td>
						User Followed by:
					</td>
					<td>
						<?= $userfollower; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<form method="POST" action="">
			<input type="submit" name="finduser" value="Find user Info"">
			<input type="submit" name="recentmedia" value="Recent media"">
			<input type="submit" name="recentmediauser" value="Recent media of user"">
			<input type="submit" name="recentlikes" value="Recent liked Insta"">
			<input type="submit" name="searchuser" value="Search users"">
		</form>
	</body>
</html>