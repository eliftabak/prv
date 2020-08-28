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
import bayiBasvuru from './routes/bayiBasvuru';
import satisNoktalari from './routes/satisNoktalari';
import dijitalKatalog from './routes/dijitalKatalog';
import searchNoResults from './routes/searchNoResults';
import sorularKonusuyor from './routes/sorularKonusuyor';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,

  home,

  hakkimizda,

  singleProduct,

  iletisim,

  search,

  akilliTahtaUygulamalari,

  bayiBasvuru,

  satisNoktalari,

  dijitalKatalog,

  searchNoResults,

  sorularKonusuyor,

});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
