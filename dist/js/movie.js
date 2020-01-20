'use strict';

App.View.Movie = App.View.extend({
  initialize: function initialize(options) {
    App.View.prototype.initialize.apply(this, [options]);
  },
  className: 'Movie',
  element: '#main',
  template: '#AppViewMovie',
  waitFunction: function waitFunction(model) {
    this.data = model.toJSON().data.movie;

    if (this.data.id) {
      this.data.goBackURL = sessionStorage.getItem('goBackURL');
      this.generateMagnet();
      this.generateYouMayLike();
      $('#search-form-container').css({
        'background': "url(".concat(this.data.background_image_original, ")"),
        'background-size': 'cover',
        'background-repeat': 'no-repeat',
        'background-position': 'center center'
      });
      $('#pagination').slideUp();
    }
  },
  listen: 'model',
  generateMagnet: function generateMagnet() {
    var self = this;
    var trackers = 'tr=' + ['udp://open.demonii.com:1337/announce', 'udp://tracker.openbittorrent.com:80', 'udp://tracker.coppersurfer.tk:6969', 'udp://glotorrents.pw:6969/announce', 'udp://tracker.opentrackr.org:1337/announce', 'udp://torrent.gresille.org:80/announce', 'udp://p4p.arenabg.com:1337', 'udp://tracker.leechers-paradise.org:6969'].join('&tr='),
        torrents = [];

    _.forEach(this.data.torrents, function (torrent) {
      torrent.magnet = "magnet:?xt=urn:btih:".concat(torrent.hash, "&dn=").concat(encodeURI(self.data.title), "&").concat(trackers);
      torrents.push(torrent);
    });

    this.data.torrents = torrents;
  },
  generateYouMayLike: function generateYouMayLike() {
    var self = this;
    var YouMayLike = [],
        RandomPage = Math.floor(Math.random() * 11),
        number = Math.floor(Math.random() * this.data.genres.length),
        RandomGenre;

    _.forEach(this.data.genres, function (genre, key) {
      if (key === number) {
        RandomGenre = genre;
      }
    });

    var Recommendations = new App.Collection.Movies();
    Recommendations.fetch({
      data: {
        genre: RandomGenre,
        limit: 4,
        page: RandomPage > 0 ? RandomPage : 1
      },
      success: function success(collection) {
        _.forEach(collection.toJSON()[0].data.movies, function (movie) {
          self.$el.find('#movie-recommendation').append("<div class=\"col\">\n\t\t\t\t\t\t<a href=\"#movie/".concat(movie.id, "\">\n\t\t\t\t\t\t\t<img src=\"").concat(movie.large_cover_image, "\" class=\"img-fluid\">\n\t\t\t\t\t\t\t<div>").concat(movie.title, "</div>\n\t\t\t\t\t\t</a>\n\t\t\t\t\t</div>"));
        });
      }
    });
  },
  postRender: function postRender() {
    App.View.prototype.postRender.apply(this);

    if (this.data.id === 0) {
      App.Render404();
    }
  }
});
App.Router.Movies = Backbone.Router.extend({
  routes: {
    'movie/:id': function movieId(id) {
      var model = new App.Model.Movie();
      model.set('id', id);
      var view = new App.View.Movie({
        model: model
      });
      App.Render(view);
      model.fetch();
    }
  },
  initialize: function initialize() {
    Backbone.Router.prototype.initialize.call(this);
  }
});
var Movie = new App.Router.Movies();