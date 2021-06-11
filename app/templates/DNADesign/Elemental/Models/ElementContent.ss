<% cached $ElementCacheKey %>
  <div class="el-content <% if $Style %> $StyleVariant<% end_if %>">
    <div class="u-container">
      <% if $Title && $ShowTitle %>
          <h2 class="el-content__title">$Title</h2>
      <% end_if %>
      <div class="u-content">
        $HTML
      </div>
    </div>
  </div>
<% end_cached %>