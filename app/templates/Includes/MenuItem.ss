<li class="c-menu__item c-menu__item--{$LinkingMode} <% if $Children %> c-menu__item--has-children <% if $LinkingMode == 'section' || $LinkingMode == 'current' %> c-menu__item--expanded<% end_if %><% end_if %>">

	<a class="c-menu__item-link" href="$Link" accesskey="$Pos">
		$MenuTitle.XML
	</a>

	<% if $Children %>
		<ul class="c-menu__submenu">
			<% loop $Children %>
				<% include MenuItem %>
			<% end_loop %>
		</ul>
	<% end_if %>

</li>
