<div class="e-single-image">
  <% if $Title && $ShowTitle %><div class="u-container"><h2 class="e-single-image__title">$Title</h2></div><% end_if %>
  <div class="u-container <% if DisplayPageFullWidth %> u-container--full-width u-container--no-padding<% end_if %>">
    <div class="e-single-image__wrapper">
      <div class="e-single-image__image-wrapper">
        <% if $Image %>
          <% with $Image %>
            <img style="object-position: $Image.PercentageX% $Image.PercentageY%;" class="e-single-image__image responsive" alt="$Image.Title.ATT"
              src="$FocusFill(100,45).URL"
              data-sizes='[
                {
                  "max": 500,
                  "url": "{$FocusFill(500,225).URL}"
                },
                {
                  "max": 800,
                  "url": "{$FocusFill(800,360).URL}"
                },
                {
                  "max": 1200,
                  "url": "{$FocusFill(1200,540).URL}"
                },
                {
                  "url": "{$FocusFill(1900,855).URL}"
                }
              ]'
            />
          <% end_with %>
        <% end_if %> %>
      </div>
    </div>
  </div>
</div>