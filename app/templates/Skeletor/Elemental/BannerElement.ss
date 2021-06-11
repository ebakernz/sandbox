<div class="el-banner<% if not $BannerImage %> el-banner--no-image<% end_if %> responsive"
    <% if $Image %>
        <% loop $Image %>
        style="background-image: url('{$ScaleWidth(100).Link}');"
        data-sizes='[
            {
                "max": 500,
                "url": "{$ScaleWidth(500).Link}"
            },
            {
                "max": 800,
                "url": "{$ScaleWidth(800).Link}"
            },
            {
                "max": 1200,
                "url": "{$ScaleWidth(1200).Link}"
            },
            {
                "url": "{$ScaleWidth(1900).Link}"
            }
        ]'
        <% end_loop %>
    <% end_if %>
>
    <div class="el-banner__inner">
        <% if $Title && $ShowTitle %><h1 class="el-banner__title">$Title</h1><% end_if %>
        <div class="el-banner__content u-content">$Content</div>
    </div>
</div>
