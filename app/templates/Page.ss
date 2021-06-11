<!doctype html>
<html lang="en">
	<% include DocumentHead %>
	<body class="<% if $URLSegment == 'Security' %>Security<% else %>$ClassName.ShortName<% end_if %>">
		<header class="">
			<div class="u-container">
				<a class="" href="{$BaseURL}">
					<img src="{$ClientAssetsPath}/images/logo.png" alt="{$SiteConfig.Title} logo" />
				</a>
				<% include Menu %>
			</div>
		</header>
		$SidebarElementalArea
		$Layout
		<% include Footer %>
	</body>
</html>
