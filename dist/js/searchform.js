'use strict';

App.View.SearchForm = App.View.extend({
  initialize: function initialize(options) {
    App.View.prototype.initialize.apply(this, [options]);
  },
  className: 'SearchForm',
  element: '#search-form-container',
  template: '#AppViewSearchForm',
  wait: false,
  events: {
    'submit .search-form': function submitSearchForm(e) {
      var form = this.$el.find(e.currentTarget),
          HomaPage = $('.HomePage').data('view'),
          data = form.serialize();
      Backbone.history.navigate("?".concat(data), {
        trigger: true
      });
    },
    'change select': function changeSelect() {
      this.$el.find('.search-form').trigger('submit');
    }
  }
});