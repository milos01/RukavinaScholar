<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
		<tr>
			<td>
				<table bgcolor="#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
					<tr>
						<td>
							<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
								<tr>
									<td>
										<table align="left" border="0" cellpadding="0" cellspacing="0" width="400" style="border-collapse: collapse;">
											<!-- Space -->
											<tr><td style="font-size: 0; line-height: 0;" height="3">&nbsp;</td></tr>
											<tr>
												<td width="100%" align="center" style="font-size: 20px; line-height: 34px; font-family:helvetica, Arial, sans-serif; color:#000;">
													Click to reset password.
												</td>
											</tr>
										</table>
										<table align="left" border="0" cellpadding="0" cellspacing="0" width="140" style="border-collapse: collapse;">
											<!-- Space -->
											<tr><td style="font-size: 0; line-height: 0;" height="0">&nbsp;</td></tr>
											<tr>
												<td width="100%" align="center" style="padding:12px 12px 12px 12px; text-align: center;border-radius:4px;" bgcolor="#21bb9d">
													<a href="{{ $link = url('reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" style="color: #fff; font-size: 16px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif">Reset password</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>