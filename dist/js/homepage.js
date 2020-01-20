'use strict';

App.View.HomePage = App.View.extend({
  initialize: function initialize(options) {
    App.View.prototype.initialize.apply(this, [options]);
    var self = this;
    this.collection.fetch({
      data: this.options.fetchData,
      success: function success(collection, xhr) {
        self.renderPagination(xhr);
        $('#pagination').slideDown();

        if (self.collection.toJSON()[0].data.hasOwnProperty('movies')) {
          var number = Math.floor(Math.random() * self.collection.toJSON()[0].data.movies.length),
              background;

          _.forEach(self.collection.toJSON()[0].data.movies, function (movie, key) {
            if (key === number) {
              background = movie.large_cover_image;
            }
          });

          $('#search-form-container').css({
            'background': "url(".concat(background, ")"),
            'background-size': 'cover',
            'background-repeat': 'no-repeat',
            'background-position': 'center center'
          });
        } else {
          App.Render404();
        }
      }
    });
  },
  waitFunction: function waitFunction(collection) {
    var response = collection.toJSON()[0];
    response.movie_word = response.movie_count === 1 ? 'Movie' : 'Movies';
    this.data = response;
  },
  className: 'HomePage',
  element: '#main',
  template: '#AppViewHomePage',
  events: {
    'click .show-movie-details': function clickShowMovieDetails(e) {
      e.preventDefault();
      Backbone.history.navigate("movie/".concat(this.$el.find(e.currentTarget).data('id')), {
        trigger: true
      });
    }
  },
  renderPagination: function renderPagination(xhr) {
    var fetchData = this.options.fetchData,
        pages = Math.floor(xhr.data.movie_count / 20),
        currentPage = xhr.data.page_number,
        html = '<div class="col-md-8"><nav aria-label="..." id="pagination"><ul class="pagination justify-content-center">';

    if (pages > 10) {
      fetchData.page = 1;
      html += "<li class=\"page-item\"><a class=\"page-link\" href=\"#?".concat($.param(fetchData), "\">first</a></li>");
      var n = currentPage > 10 ? currentPage - 5 : 1,
          target = n + 10;

      for (var i = n; i <= target; i++) {
        if (i < pages) {
          fetchData.page = i;
          html += ["<li class=\"page-item".concat(currentPage === i ? ' active' : '', "\">"), "<a class=\"page-link\" href=\"#?".concat($.param(fetchData), "\">"), i, "</a>", "</li>"].join('\n');
        }
      }

      fetchData.page = pages;
      html += "<li class=\"page-item\"><a class=\"page-link\" href=\"#?".concat($.param(fetchData), "\">last</a></li>");
      html += "</nav></div>";
    }

    html += '</ul>';
    $('#pagination').html(html);
  },
  preRender: function preRender() {
    var el = $('.SearchForm');

    _.forEach(this.options.fetchData, function (val, key) {
      el.find("[name=\"".concat(key, "\"]")).val(val);
    });
  },
  postRender: function postRender() {
    App.View.prototype.postRender.apply(this);
    sessionStorage.setItem('goBackURL', window.location.hash);
  }
});
App.Router.HomePage = Backbone.Router.extend({
  routes: {
    '?*': function (_2) {
      function _(_x) {
        return _2.apply(this, arguments);
      }

      _.toString = function () {
        return _2.toString();
      };

      return _;
    }(function (params) {
      var filterParams = params || {};

      if (_.size(params) > 0) {
        filterParams = $.deparam(params);
      }

      filterParams.with_rt_ratings = true;
      var collection = new App.Collection.Movies(),
          view = new App.View.HomePage({
        collection: collection,
        fetchData: filterParams
      });
      App.Render(view);
    })
  },
  initialize: function initialize() {
    Backbone.Router.prototype.initialize.call(this);
  }
});
var HomePage = new App.Router.HomePage();