(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && typeof module.exports === 'object') {
    factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function (jQuery) {
  // Indonesian
  jQuery.timeago.settings.strings = {
    prefixAgo: null,
    prefixFromNow: null,
    suffixAgo: "",
    suffixFromNow: "dari sekarang",
    seconds: "Kurang dari 1 menit",
    minute: "Sekitar 1 menit",
    minutes: "%d menit",
    hour: "Sekitar 1 jam",
    hours: "Sekitar %d jam",
    day: "1 hari",
    days: "%d hari",
    month: "Sekitar 1 bulan",
    months: "%d bulan",
    year: "Sekitar 1 tahun",
    years: "%d tahun"
  };
}));