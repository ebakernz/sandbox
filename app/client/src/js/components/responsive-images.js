import objectFitImages from "object-fit-images";

$(document).ready(function (evt) {
    CheckImageSizes();
    objectFitImages();
});

$(window).on("resize", function (evt) {
    //look to add a timeout
    CheckImageSizes();
});

function CheckImageSizes() {
    $(document).find('.responsive').each(function () {
		const image = $(this);
		if (image.attr('data-sizes')) {

			let sizes = image.attr('data-sizes');
			let url = null;

			try {
                sizes = JSON.parse(sizes);
            } catch (error) {
                console.error(error);
                return false;
            }

            for (let i = 0; i < sizes.length; i++) {
                if (sizes[i].max === undefined || image.outerWidth() <= sizes[i].max) {
                    url = sizes[i].url;
                    break;
                }
            }

            if (url) {
                if (image.is('img')) {
                    image.attr('src', url);
                } else {
                    image.css('background-image', 'url(' + url + ')');
                }
            }
        }
    });
}
