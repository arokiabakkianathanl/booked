var routes = [
  // Index page
  {
    path: '/',
    url: './index.html',
    name: 'home',
  },
  {
    path: '/slide1/',
    url: './slide1.html',
    name: 'slide1',
  },
  {
    path: '/slide2/',
    url: './slide2.html',
    name: 'slide2',
  },
  {
    path: '/slide3/',
    url: './slide3.html',
    name: 'slide3',
  },
  {
    path: '/slide4/',
    url: './slide4.html',
    name: 'slide4',
  },
  {
    path: '/already-member2/',
    url: './already-member2.html',
    name: 'already-member2',
  },
  {
    path: '/already-member/',
    url: './already-member.html',
    name: 'about',
  },

  // Default route (404 page). MUST BE THE LAST
  {
     path: '(.*)',
    url: './pages/404.html',
  },
];
