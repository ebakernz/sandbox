<div class="e-single-video">
  <div class="u-container">
    <% if $Title && $ShowTitle %><h2 class="e-single-video__title">$Title</h2><% end_if %>
    <% if EmbedHTML %>
      <div class="e-single-video__video-wrapper">        
          $EmbedHTML.RAW
      </div>
      <% end_if %>
  </div>
</div>