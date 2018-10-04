var config = {
    map: {
        '*': {
            'Codilar/note': 'Codilar_Bannerslider/js/jquery/slider/jquery-ads-note',
        },
    },
    paths: {
        'Codilar/flexslider': 'Codilar_Bannerslider/js/jquery/slider/jquery-flexslider-min',
        'Codilar/evolutionslider': 'Codilar_Bannerslider/js/jquery/slider/jquery-slider-min',
        'Codilar/zebra-tooltips': 'Codilar_Bannerslider/js/jquery/ui/zebra-tooltips',
    },
    shim: {
        'Codilar/flexslider': {
            deps: ['jquery']
        },
        'Codilar/evolutionslider': {
            deps: ['jquery']
        },
        'Codilar/zebra-tooltips': {
            deps: ['jquery']
        },
    }
};
