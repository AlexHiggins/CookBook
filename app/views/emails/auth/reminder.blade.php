<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 14px;
      line-height: 1.42857;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
			border-radius: 4px;
			background-color: #fff;
			padding: 15px;
		}

		.page-title {
			margin-top: 0;
			margin-bottom: 15px;
			color: #FB503B;
			font-weight: 300;
			font-size: 25px;
    }
  </style>
</head>
<body>

<div>
	<h2 class="page-title">Password Reset</h2>
	<div>
		<p>To reset your password, complete this form: {{ url('password/reset', [$token]) }} </p>

		<p>This link will expire in {{ config::get('auth.reminder.expire', 60) }} minutes. </p>
	</div>
</div>

</body>
</html>
