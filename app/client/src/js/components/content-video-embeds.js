// /*
// In conjunction with .ss-htmleditorfield-file.embed styling in /app/scss/global/_layout.scss
// */
//
// $(document).ready(function () {
//
//     if ($('.ss-htmleditorfield-file.embed').length > 0) {
//         setDataAttributes();
//         setInitialSizing();
//         resizeEmbeds();
//
//         $(window).on('resize', function () {
//             resizeEmbeds();
//         });
//     }
// });
//
// // calculate the aspect ratio by grabbing the inner iframe's original width and height and set ratio as a data attribute
// // if a custom overwritten width has been set use this otherwise use the original width, set width as a data attribute
// function setDataAttributes() {
//     $('.ss-htmleditorfield-file.embed').each(function () {
//         $(this).css('max-width', 'auto'); // this is set in place to not overwrite the custom set width
//
//         const originalWidth = $(this).children('iframe').css('width');
//         const originalHeight = $(this).children('iframe').css('height');
//
//         const aspectRatio = parseInt(originalHeight) / parseInt(originalWidth);
//         $(this).attr({'data-ratio': aspectRatio});
//
//         const overWrittenWidth = $(this).css('width');
//
//         if (parseInt(overWrittenWidth)) {
//             $(this).attr({'data-width': overWrittenWidth});
//         } else {
//             $(this).attr({'data-width': originalWidth});
//         }
//     });
// }
//
// // get the width and calculate the height from the width and aspect ratio data attributes set in the previous function
// // set the width and height of the embed, replace the inner iframe width and height with a full 100%
// // apply a clear: both to the trailing element if video is set by itself
// function setInitialSizing() {
//     $('.ss-htmleditorfield-file.embed').each(function () {
//         const trueAspectRatio = $(this).data('ratio');
//         const trueWidth = (parseInt($(this).data('width')));
//         const trueHeight = Math.floor(trueWidth * trueAspectRatio);
//
//         $(this).css('width', trueWidth + 'px');
//         $(this).css('height', trueHeight + 'px');
//         $(this).children('iframe').css('width', '100%');
//         $(this).children('iframe').css('height', '100%');
//
//         $(this).css('max-width', '100%');
//
//         if ($(this).hasClass('leftAlone') || $(this).hasClass('center') || $(this).hasClass('rightAlone')) {
//             $(this).next().css('clear', 'both');
//         }
//     });
// }
//
// // grab the original width as seen in the data atrribute
// // grab the current width
// // grab the aspect ratio from the data attribute
// // if the current is smaller than the original width, adjust the height by setting it based on the aspect ratio
// // add/adjust padding to the bottom if a caption is present
// function resizeEmbeds() {
//     $('.ss-htmleditorfield-file.embed').each(function () {
//
//         const attributeAspectRatio = $(this).data('ratio');
//         const currentWidth = (parseInt($(this).css('width')));
//         const attributeWidth = (parseInt($(this).data('width')));
//
//         if (currentWidth < attributeWidth) {
//             const newHeight = Math.floor(currentWidth * attributeAspectRatio);
//             $(this).css('height', newHeight + 'px');
//         }
//
//         if ($(this).find('.caption').length > 0) {
//             const captionHeight = $(this).find('.caption').height();
//             $(this).css('padding-bottom', captionHeight + 17 + 'px');
//         }
//     });
// }
