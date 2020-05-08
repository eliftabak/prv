// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import hakkimizda from './routes/hakkimizda';
import singleProduct from './routes/singleProduct';
import iletisim from './routes/iletisim';
import search from './routes/search';
import akilliTahtaUygulamalari from './routes/akilliTahtaUygulamari';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  hakkimizda,
   // Single Product page
  singleProduct,

  iletisim,

  search,

  akilliTahtaUygulamalari,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
