<div class="e-embedded-code">
    <div class="u-container">
        <% if $Title && $ShowTitle %><h2 class="e-embedded-code__title">$Title</h2><% end_if %>
        <% if Code %>
        <div class="e-embedded-code__wrapper">        
            $Code
        </div>
        <% end_if %>
    </div>
</div>