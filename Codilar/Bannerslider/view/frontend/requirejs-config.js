var config = {
	map: {
		'*': {
			'Codilar/note': 'Codilar_Bannerslider/js/jquery/slider/jquery-ads-note',
			'Codilar/impress': 'Codilar_Bannerslider/js/report/impress',
			'Codilar/clickbanner': 'Codilar_Bannerslider/js/report/clickbanner',
		},
	},
	paths: {
		'Codilar/flexslider': 'Codilar_Bannerslider/js/jquery/slider/jquery-flexslider-min',
		'Codilar/evolutionslider': 'Codilar_Bannerslider/js/jquery/slider/jquery-slider-min',
		'Codilar/popup': 'Codilar_Bannerslider/js/jquery.bpopup.min',
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
