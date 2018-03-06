// Dom7
var $ = Dom7;

// Theme
var theme = 'ios';
if (document.location.search.indexOf('theme=') >= 0) {
  theme = document.location.search.split('theme=')[1].split('&')[0];
}

// Init App
var app = new Framework7({
  id: 'io.framework7.testapp',
  root: '#app',
  name: 'Booked',
  version: '1.0',
  theme: theme,
  dialog: {
    title: 'Booked',
  },
  statusbar: {
    iosOverlaysWebview: true,
	overlay:true
  },
  data: function () {
    return {
      user: {
        firstName: 'John',
        lastName: 'Doe',
      },
    };
  },
  methods: {
    helloWorld: function () {
      app.dialog.alert('Hello World!');
    },
  },
  routes: routes,
  vi: {
    placementId: 'pltd4o7ibb9rc653x14',
  },
});


var swiper = app.swiper.create('.swiper-container', {
    // allowSlideNext: false,
    // noSwiping: false,
    // noSwipingClass: 'swiper-slide',
    // effect: 'fade'
});
