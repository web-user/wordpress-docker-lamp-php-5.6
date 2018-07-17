;
(function($, window, document, undefined) {
  'use strict';

  $.reloadPlugins = function() {

    $('.icon-select').chosen({
      template: function(text, value, templateData) {
        return ['<i class="' + templateData.icon + '"></i> ' + text].join('');
      }
    });
    $('.wpb_chosen').chosen();
    $('.chzn-drop').css({ "width": "300px" });

    $('.vc_image_select').each(function() {
      var _el = $(this),
        _elems = _el.find('li');
      _elems.each(function() {
        var _this = $(this),
          _data = _this.data('value');

        _this.click(function() {
          if (_this.is('.selected')) {
            _this.removeClass('selected');
            _el.next().val('').trigger('keyup');
          } else {
            _this.addClass('selected').siblings().removeClass('selected');
            _el.next().val(_data).trigger('keyup');
          }
        });

      });

    });

  };

  var Shortcodes = vc.shortcodes;

  if (window.VcColumnView) {

    // VC Tab View Fix
    // for Syntax error, unrecognized expression #
    window.VcTabViewFix = window.VcTabView.extend({
      changeShortcodeParams: function(model) {

        var params;
        window.VcTabView.__super__.changeShortcodeParams.call(this, model),
          params = model.get("params");

        if (_.isObject(params) && _.isString(params.title) && _.isString(params.tab_id)) {
          $(".ui-tabs-nav [href='#tab-" + params.tab_id + "']").text(params.title);
        }

      },
      deleteShortcode: function(e) {

        _.isObject(e) && e.preventDefault();

        var answer = confirm(window.i18nLocale.press_ok_to_delete_section),
          parent_id = this.model.get("parent_id");

        if (!0 !== answer) return !1;

        if (this.model.destroy(), !vc.shortcodes.where({ parent_id: parent_id }).length) {
          var parent = vc.shortcodes.get(parent_id);
          return parent.destroy(), !1
        }

        var params = this.model.get("params"),
          current_tab_index = $("[href='#tab-" + params.tab_id + "']", this.$tabs).parent().index();

        $("[href='#tab-" + params.tab_id + "']").parent().remove();

        var tab_length = this.$tabs.find(".ui-tabs-nav li:not(.add_tab_block)").length;

        tab_length > 0 && this.$tabs.tabs("refresh"), tab_length > current_tab_index ? this.$tabs.tabs("option", "active", current_tab_index) : tab_length > 0 && this.$tabs.tabs("option", "active", tab_length - 1)

      }
    });
    //
    // Carousel
    // -------------------------------------------------------------------------
    window.RSSliderView = window.VcColumnView.extend({
      events: {
        'click > .vc_controls .vc_control.column_delete': 'deleteShortcode',
        'click > .vc_controls .vc_control.column_edit': 'editElement',
        'click > .vc_controls .vc_control.column_clone': 'clone',
        'click > .vc_controls .vc_control.column_add': 'addDirectlyElement',
        'click > .wpb_element_wrapper > .vc_empty-container': 'addDirectlyElement'
      },
      addDirectlyElement: function(e) {
        e.preventDefault();
        var slider = Shortcodes.create({ shortcode: 'rs_slider_item', parent_id: this.model.id });
        return slider;
      },
      setDropable: function() {},
      dropButton: function(event, ui) {},
    });

  }

  _.extend(vc.atts, {
    vc_efa_chosen: {
      parse: function(param) {
        var value = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']').val();
        return (value) ? value.join(',') : '';
      }
    },

    vc_icon: {
      parse: function(param) {
        var value = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']').val();
        return (value) ? value : '';
      }
    },
  });

  vc.TemplateWindowUIPanelBackendEditor = vc.TemplatesPanelViewBackend.vcExtendUI(vc.HelperPanelViewHeaderFooter).vcExtendUI(vc.HelperTemplatesPanelViewSearch).extend({
    panelName: "template_window",
    showMessageDisabled: !1,
    initialize: function() {
      vc.TemplateWindowUIPanelBackendEditor.__super__.initialize.call(this), this.trigger("show", this.initTemplatesTabs, this)
    },
    show: function() {

      this.clearSearch(), vc.TemplateWindowUIPanelBackendEditor.__super__.show.call(this), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates ul > li').each(function() {
          "all" == $(this).attr("data-sort") ? $(this).find(".count").html($('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template').length) : $(this).find(".count").html($('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template.' + $(this).attr("data-sort")).length)
        }), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li[data-sort="all"]').addClass("active").trigger("click"), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li').click(function() {
          $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li').removeClass("active"), $(this).addClass("active");
          var t = $(this).attr("data-sort");
          $('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template').removeClass("hidden"), "all" != t && $('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template:not(.' + t + ")").addClass("hidden")
        }),
        $('.vc_ui-template', $(this.el)).removeClass('is-loading').find('.vc-composer-icon').removeClass('vc-c-icon-sync').addClass('vc-c-icon-add');
      $('.vc_ui-control-button i', $(this.el)).removeClass('rotating');
      $(this.el).on('click', '.vc_ui-template [data-template-handler]', function() {

        $(this).closest('.vc_ui-template').addClass('is-loading')
        if ($(this).is('.vc_ui-control-button')) {
          $(this).find('.vc-composer-icon').removeClass('vc-c-icon-add').addClass('vc-c-icon-sync rotating');
        } else {
          $(this).next('.vc_ui-list-bar-item-actions').find('.vc-composer-icon').removeClass('vc-c-icon-add').addClass('vc-c-icon-sync rotating');
        }

      })
    },
    initTemplatesTabs: function() {

      this.$el.find('[data-vc-ui-element="panel-tabs-controls"]').vcTabsLine("moveTabs")

    },
    showMessage: function(text, type) {

      var wrapperCssClasses;
      if (this.showMessageDisabled) return !1;
      wrapperCssClasses = "vc_col-xs-12 wpb_element_wrapper", this.message_box_timeout && this.$el.find("[data-vc-panel-message]").remove() && window.clearTimeout(this.message_box_timeout), this.message_box_timeout = !1;
      var $messageBox, messageBoxTemplate = vc.template('<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-<%- color %>"><div class="vc_message_box-icon"><i class="fa fa fa-<%- icon %>"></i></div><p><%- text %></p></div>');
      switch (type) {
        case "error":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "danger",
            icon: "times",
            text: text
          }));
          break;
        case "warning":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "warning",
            icon: "exclamation-triangle",
            text: text
          }));
          break;
        case "success":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "success",
            icon: "check",
            text: text
          }))
      }
      $messageBox.prependTo(this.$el.find('[data-vc-ui-element="panel-edit-element-tab"].vc_row.vc_active')), $messageBox.fadeIn(), this.message_box_timeout = window.setTimeout(function() {
        $messageBox.remove()
      }, 6e3)
    },
    changeTab: function(e) {
      e.preventDefault(), e && !e.isClearSearch && this.clearSearch();
      var $tab = $(e.currentTarget);
      $tab.parent().hasClass("vc_active") || (this.$el.find('[data-vc-ui-element="panel-tabs-controls"] .vc_active:not([data-vc-ui-element="panel-tabs-line-dropdown"])').removeClass("vc_active"), $tab.parent().addClass("vc_active"), this.$el.find('[data-vc-ui-element="panel-edit-element-tab"].vc_active').removeClass("vc_active"), this.$el.find($tab.data("vcUiElementTarget")).addClass("vc_active"), this.$tabsMenu && this.$tabsMenu.vcTabsLine("checkDropdownContainerActive"))
    },
    setPreviewFrameHeight: function(templateID, height) {
      parseInt(height) < 100 && (height = 100), $('data-vc-template-preview-frame="' + templateID + '"').height(height)
    }
  }), vc.TemplateWindowUIPanelBackendEditor.prototype.events = $.extend(!0, vc.TemplateWindowUIPanelBackendEditor.prototype.events, {
    'click [data-vc-ui-element="button-save"]': "save",
    'click [data-vc-ui-element="button-close"]': "hide",
    'click [data-vc-ui-element="button-minimize"]': "toggleOpacity",
    "keyup [data-vc-templates-name-filter]": "searchTemplate",
    "search [data-vc-templates-name-filter]": "searchTemplate",
    "click .vc_template-save-btn": "saveTemplate",
    "click [data-template_id] [data-template-handler]": "loadTemplate",
    'click [data-vc-container=".vc_ui-list-bar"][data-vc-preview-handler]': "buildTemplatePreview",
    'click [data-vc-ui-delete="template-title"]': "removeTemplate",
    'click [data-vc-ui-element="panel-tab-control"]': "changeTab"
  }), vc.TemplateWindowUIPanelFrontendEditor = vc.TemplatesPanelViewFrontend.vcExtendUI(vc.HelperPanelViewHeaderFooter).vcExtendUI(vc.HelperTemplatesPanelViewSearch).extend({
    panelName: "template_window",
    showMessageDisabled: !1,
    show: function() {
      this.clearSearch(), vc.TemplateWindowUIPanelFrontendEditor.__super__.show.call(this), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates ul > li').each(function() {
          "all" == $(this).attr("data-sort") ? $(this).find(".count").html($('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template').length) : $(this).find(".count").html($('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template.' + $(this).attr("data-sort")).length)
        }), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li[data-sort="all"]').addClass("active").trigger("click"), $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li').click(function() {
          $('.vc_edit-form-tab[data-tab="rs_templates"] .sortable_templates li').removeClass("active"), $(this).addClass("active");
          var t = $(this).attr("data-sort");
          $('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template').removeClass("hidden"), "all" != t && $('.vc_edit-form-tab[data-tab="rs_templates"] .vc_ui-template-list > .vc_ui-template:not(.' + t + ")").addClass("hidden")
        }),
        $('.vc_ui-template', $(this.el)).removeClass('is-loading').find('.vc-composer-icon').removeClass('vc-c-icon-sync').addClass('vc-c-icon-add');
      $('.vc_ui-control-button i', $(this.el)).removeClass('rotating');
      $(this.el).on('click', '.vc_ui-template [data-template-handler]', function() {

        $(this).closest('.vc_ui-template').addClass('is-loading')
        if ($(this).is('.vc_ui-control-button')) {
          $(this).find('.vc-composer-icon').removeClass('vc-c-icon-add').addClass('vc-c-icon-sync rotating');
        } else {
          $(this).next('.vc_ui-list-bar-item-actions').find('.vc-composer-icon').removeClass('vc-c-icon-add').addClass('vc-c-icon-sync rotating');
        }

      })
    },
    showMessage: function(text, type) {
      if (this.showMessageDisabled) return !1;
      this.message_box_timeout && this.$el.find("[data-vc-panel-message]").remove() && window.clearTimeout(this.message_box_timeout), this.message_box_timeout = !1;
      var $messageBox, wrapperCssClasses, messageBoxTemplate = vc.template('<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-<%- color %>"><div class="vc_message_box-icon"><i class="fa fa fa-<%- icon %>"></i></div><p><%- text %></p></div>');
      switch (wrapperCssClasses = "vc_col-xs-12 wpb_element_wrapper", type) {
        case "error":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "danger",
            icon: "times",
            text: text
          }));
          break;
        case "warning":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "warning",
            icon: "exclamation-triangle",
            text: text
          }));
          break;
        case "success":
          $messageBox = $('<div class="' + wrapperCssClasses + '" data-vc-panel-message>').html(messageBoxTemplate({
            color: "success",
            icon: "check",
            text: text
          }))
      }
      $messageBox.prependTo(this.$el.find('[data-vc-ui-element="panel-edit-element-tab"].vc_row.vc_active')), $messageBox.fadeIn(), this.message_box_timeout = window.setTimeout(function() {
        $messageBox.remove()
      }, 6e3)
    },
    changeTab: function(e) {
      e.preventDefault(), e && !e.isClearSearch && this.clearSearch();
      var $tab = $(e.currentTarget);
      $tab.parent().hasClass("vc_active") || (this.$el.find('[data-vc-ui-element="panel-tabs-controls"] .vc_active:not([data-vc-ui-element="panel-tabs-line-dropdown"])').removeClass("vc_active"), $tab.parent().addClass("vc_active"), this.$el.find('[data-vc-ui-element="panel-edit-element-tab"].vc_active').removeClass("vc_active"), this.$el.find($tab.data("vcUiElementTarget")).addClass("vc_active"), this.$tabsMenu && this.$tabsMenu.vcTabsLine("checkDropdownContainerActive"))
    }
  }), $.fn.vcAccordion.Constructor.prototype.collapseTemplate = function(showCallback) {
    var $allTriggers, $activeTriggers, $this, $triggers;
    $this = this.$element;
    var i;
    if (i = 0, $allTriggers = this.getContainer().find("[data-vc-preview-handler]").each(function() {
        var accordion, $this;
        $this = $(this), accordion = $this.data("vc.accordion"), void 0 === accordion && ($this.vcAccordion(), accordion = $this.data("vc.accordion")), accordion && accordion.setIndex && accordion.setIndex(i++)
      }), $activeTriggers = $allTriggers.filter(function() {
        var $this, accordion;
        return $this = $(this), accordion = $this.data("vc.accordion"), accordion.getTarget().hasClass(accordion.activeClass)
      }), $triggers = $activeTriggers.filter(function() {
        return $this[0] !== this
      }), $triggers.length && $.fn.vcAccordion.call($triggers, "hide"), this.isActive()) $.fn.vcAccordion.call($this, "hide");
    else {
      $.fn.vcAccordion.call($this, "show");
      var $triggerPanel = $this.closest(".vc_ui-list-bar-item"),
        $wrapper = $this.closest("[data-template_id]"),
        $panel = $wrapper.closest("[data-vc-ui-element=panel-content]").parent();
      setTimeout(function() {
        if (Math.round($wrapper.offset().top - $panel.offset().top) < 0) {
          var posit = Math.round($wrapper.offset().top - $panel.offset().top + $panel.scrollTop() - $triggerPanel.height());
          $panel.animate({
            scrollTop: posit
          }, 400)
        }
        "function" == typeof showCallback && showCallback($wrapper, $panel)
      }, 400)
    }
  }

})(jQuery, window, document);
