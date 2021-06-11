
// Compile our scss
// This 'includes' the SCSS index file which webpack then reads and
// compiles into the necessary css files
import style from '../scss/index.scss';

// Inject our components
require('./components/responsive-images.js');
require('./components/content-video-embeds.js');
