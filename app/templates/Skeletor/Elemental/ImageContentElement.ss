<div class="e-image-content e-image-content--$LayoutOption">
  <% if $Title && $ShowTitle %><div class="u-container"><h2 class="e-image-content__title">$Title</h2></div><% end_if %> 
  <div class="u-container">
    <div class="e-image-content__wrapper">  
      <div class="e-image-content__content-wrapper">
        <div class="e-image-content__image-content u-content">
          $Content
        </div>
      </div>
      <div class="e-image-content__image-wrapper">
        <img src="$Image.URL" style="object-position: $Image.PercentageX% $Image.PercentageY%;" class="e-image-content__image" alt="$Image.Title.ATT">
      </div>
    </div>
  </div>
</div>