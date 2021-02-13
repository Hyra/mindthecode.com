require('./bootstrap');

import mediumZoom from 'medium-zoom';

mediumZoom(document.querySelectorAll('.prose img'), {
    margin: 24,
    background: 'rgb(33, 37, 48)',
})
