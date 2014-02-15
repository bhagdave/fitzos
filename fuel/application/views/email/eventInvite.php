<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>www.reach-your-peak.com</title>
<meta name="fitness socialized" content="http://www.reach-your-peak.com/">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<html lang="en-US">
<header>
<a href="http://www.reach-your-peak.com/">
<img src="http://www.reach-your-peak.com/assets/images/logo.png" alt="www.reach-your-peak.com" name="reach-your-peak.com" width="178" height="99" id="FitZos" style="display:block;" class="logo"/>
</a>
</header>
<body>
<p>You have been invited to attend an event on <a href="http://www.reach-your-peak.com">Reach Your Peak</a></p>
<p>The event details are detailed below:-</p>
<table>
	<tr>
		<td>Name</td>
		<td><?=isset($event->name) ? $event->name : '' ; ?></td>
	</tr>	
	<tr>
		<td>Content</td>
		<td><?=isset($event->content) ? $event->content : '' ; ?></td>
	</tr>	
	<tr>
		<td>Date</td>
		<td><?=isset($event->date) ? $event->date : '' ; ?></td>
	</tr>	
	<tr>
		<td>Time</td>
		<td><?=isset($event->time) ? $event->time : '' ; ?></td>
	</tr>	
	<tr>
		<td>Location</td>
		<td><?=isset($event->location) ? $event->location : '' ; ?></td>
	</tr>	
</table>
<p>If you wish to attend the event please follow this <a href="http://www.reach-your-peak.com/event/view/<?=$event->id ?>">link</a>.</p>
<div id="footer">
<p>Copyright &copy; PROformance 2014 </p>
</div>
</div>
</body>
</html>