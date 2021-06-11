<% cached $MainMenuCacheKey %>
	<nav class="c-menu">
		<ul class="c-menu__topmenu">
			<% loop Menu(1) %>
				<% include MenuItem %>
			<% end_loop %>
		</ul>
	</nav>
<% end_cached %>