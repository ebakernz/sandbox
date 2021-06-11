<div class="e-columns">
  <div class="u-container">
    <% if $Title && $ShowTitle %><h2 class="e-columns__title">$Title</h2><% end_if %>
    <div class="e-columns__container">
      <div class="e-columns__column<% if $Display3Columns %> e-columns__column--of-three<% else %> e-columns__column--of-two<% end_if %>">
        <div class="u-content e-columns__column-content">$Column1HTML</div>
      </div>
      <div class="e-columns__column<% if $Display3Columns %> e-columns__column--of-three<% else %> e-columns__column--of-two<% end_if %>">
        <div class="u-content e-columns__column-content">$Column2HTML</div>
      </div>
      <% if $Display3Columns %>
      <div class="e-columns__column<% if $Display3Columns %> e-columns__column--of-three<% else %> e-columns__column--of-two<% end_if %>">
        <div class="u-content e-columns__column-content">$Column3HTML</div>
      </div>
      <% end_if %>
    </div>
  </div>
</div>