
/**
 * jQuery Interdependencies library
 *
 * http://miohtama.github.com/jquery-interdependencies/
 *
 * Copyright 2012-2013 Mikko Ohtamaa, others
 */

/*global console, window*/

(function($) {

    "use strict";

    /**
     * Microsoft safe helper to spit out our little diagnostics information
     *
     * @ignore
     */
    function log(msg) {
        if(window.console && window.console.log) {
            console.log(msg);
        }
    }


    /**
     * jQuery.find() workaround for IE7
     *
     * If your selector is an pure tag id (#foo) IE7 finds nothing
     * if you do jQuery.find() in a specific jQuery context.
     *
     * This workaround makes a (false) assumptions
     * ids are always unique across the page.
     *
     * @ignore
     *
     * @param  {jQuery} context  jQuery context where we look child elements
     * @param  {String} selector selector as a string
     * @return {jQuery}          context.find() result
     */
    function safeFind(context, selector) {

        if(selector[0] == "#") {

            // Pseudo-check that this is a simple id selector
            // and not a complex jQuery selector
            if(selector.indexOf(" ") < 0) {
                return $(selector);
            }
        }

        return context.find(selector);
    }

    /**
     * Sample configuration object which can be passed to {@link jQuery.deps#enable}
     *
     * @class Configuration
     */
    var configExample = {

        /**
         * @cfg show Callback function show(elem) for showing elements
         * @type {Function}
         */
        show : null,

        /**
         * @cfg hide Callback function hide(elem) for hiding elements
         * @type {Function}
         */
        hide : null,

        /**
         * @cfg log Write console.log() output of rule applying
         * @type {Boolean}
         */
        log : false,


        /**
         * @cfg checkTargets When ruleset is enabled, check that all controllers and controls referred by ruleset exist on the page.
         *
         * @default true
         *
         * @type {Boolean}
         */
        checkTargets : true

    };

    /**
     * Define one field inter-dependency rule.
     *
     * When condition is true then this input and all
     * its children rules' inputs are visible.
     *
     * Possible condition strings:
     *
     *  * **==**  Widget value must be equal to given value
     *
     *  * **any** Widget value must be any of the values in the given value array
     *
     *  * **non-any** Widget value must not be any of the values in the given value array
     *
     *  * **!=** Widget value must not be qual to given value
     *
     *  * **()** Call value as a function(context, controller, ourWidgetValue) and if it's true then the condition is true
     *
     *  * **null** This input does not have any sub-conditions
     *
     *
     *
     */
    function Rule(controller, condition, value) {
        this.init(controller, condition, value);
    }

    $.extend(Rule.prototype, {

        /**
         * @method constructor
         *
         * @param {String} controller     jQuery expression to match the `<input>`   source
         *
         * @param {String} condition What input value must be that {@link Rule the rule takes effective}.
         *
         * @param value Matching value of **controller** when widgets become visible
         *
         */
        init : function(controller, condition, value) {
            this.controller = controller;

            this.condition = condition;

            this.value = value;

            // Child rules
            this.rules = [];

            // Controls shown/hidden by this rule
            this.controls = [];
        },

        /**
         * Evaluation engine
         *
         * @param  {String} condition Any of given conditions in Rule class description
         * @param  {Object} val1      The base value we compare against
         * @param  {Object} val2      Something we got out of input
         * @return {Boolean}          true or false
         */
        evalCondition : function(context, control, condition, val1, val2) {

          /**
           *
           * ShapedPlugin Framework
           * Added new condition for ShapedPlugin Framework
           *
           * @since 1.0.0
           * @version 1.0.0
           *
           */
          if(condition == "==") {
            return this.checkBoolean(val1) == this.checkBoolean(val2);
          } else if(condition == "!=") {
            return this.checkBoolean(val1) != this.checkBoolean(val2);
          } else if(condition == ">=") {
            return Number(val2) >= Number(val1);
          } else if(condition == "<=") {
            return Number(val2) <= Number(val1);
          } else if(condition == ">") {
            return Number(val2) > Number(val1);
          } else if(condition == "<") {
            return Number(val2) < Number(val1);
          } else if(condition == "()") {
            return window[val1](context, control, val2); // FIXED: function method
          } else if(condition == "any") {
            return $.inArray(val2, val1.split(',')) > -1;
          } else if(condition == "not-any") {
            return $.inArray(val2, val1.split(',')) == -1;
          } else {
            throw new Error("Unknown condition:" + condition);
          }

        },

        /**
         *
         * ShapedPlugin Framework
         * Added Boolean value type checker
         *
         * @since 1.0.0
         * @version 1.0.0
         *
         */
        checkBoolean: function(value) {

          switch(value) {

            case true:
            case 'true':
            case 1:
            case '1':
            //case 'on':
            //case 'yes':
              value = true;
            break;

            case false:
            case 'false':
            case 0:
            case '0':
            //case 'off':
            //case 'no':
              value = false;
            break;

          }

          return value;
        },

        /**
         * Evaluate the condition of this rule in given jQuery context.
         *
         * The widget value is extracted using getControlValue()
         *
         * @param {jQuery} context The jQuery selection in which this rule is evaluated.
         *
         */
        checkCondition : function(context, cfg) {

            // We do not have condition set, we are always true
            if(!this.condition) {
                return true;
            }

            var control = context.find(this.controller);
            if(control.size() === 0 && cfg.log) {
                log("Evaling condition: Could not find controller input " + this.controller);
            }

            var val = this.getControlValue(context, control);
            if(cfg.log && val === undefined) {
                log("Evaling condition: Could not exctract value from input " + this.controller);
            }

            if(val === undefined) {
                return false;
            }

            val = this.normalizeValue(control, this.value, val);

            return this.evalCondition(context, control, this.condition, this.value, val);
        },

        /**
         * Make sure that what we read from input field is comparable against Javascript primitives
         *
         */
        normalizeValue : function(control, baseValue, val) {

            if(typeof baseValue == "number") {
                // Make sure we compare numbers against numbers
                return parseFloat(val);
            }

            return val;
        },

        /**
         * Read value from a diffent HTML controls.
         *
         * Handle, text, checkbox, radio, select.
         *
         */
        getControlValue : function(context, control) {

          /**
           *
           * ShapedPlugin Framework
           * Added multiple checkbox value control
           *
           * @since 1.0.0
           * @version 1.0.0
           *
           */
          if( ( control.attr("type") == "radio" || control.attr("type") == "checkbox" ) && control.size() > 1 ) {
            return control.filter(":checked").val();
          }

          // Handle individual checkboxes & radio
          if ( control.attr("type") == "checkbox" || control.attr("type") == "radio" ) {
            return control.is(":checked");
          }

          return control.val();

        },

        /**
         * Create a sub-rule.
         *
         * Example:
         *
         *      var masterSwitch = ruleset.createRule("#mechanicalThrombectomyDevice")
         *      var twoAttempts = masterSwitch.createRule("#numberOfAttempts", "==", 2);
         *
         * @return Rule instance
         */
        createRule : function(controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },

        /**
         * Include a control in this rule.
         *
         * @param  {String} input     jQuery expression to match the input within ruleset context
         */
        include : function(input) {

            if(!input) {
                throw new Error("Must give an input selector");
            }

            this.controls.push(input);
        },

        /**
         * Apply this rule to all controls in the given context
         *
         * @param  {jQuery} context  jQuery selection within we operate
         * @param  {Object} cfg      {@link Configuration} object or undefined
         * @param  {Object} enforced Recursive rule enforcer: undefined to evaluate condition, true show always, false hide always
         *
         */
        applyRule : function(context, cfg, enforced) {

            var result;

            if(enforced === undefined) {
                result = this.checkCondition(context, cfg);
            } else {
                result = enforced;
            }

            if(cfg.log) {
                log("Applying rule on " + this.controller + "==" + this.value + " enforced:" + enforced + " result:" + result);
            }

            if(cfg.log && !this.controls.length) {
                log("Zero length controls slipped through");
            }

            // Get show/hide callback functions

            var show = cfg.show || function(control) {
                control.show();
            };

            var hide = cfg.hide || function(control) {
                control.hide();
            };


            // Resolve controls from ids to jQuery selections
            // we are controlling in this context
            var controls = $.map(this.controls, function(elem, idx) {
                var control = context.find(elem);
                if(cfg.log && control.size() === 0) {
                    log("Could not find element:" + elem);
                }
                return control;
            });

            if(result) {

                $(controls).each(function() {


                    // Some friendly debug info
                    if(cfg.log && $(this).size() === 0) {
                        log("Control selection is empty when showing");
                        log(this);
                    }

                    show(this);
                });

                // Evaluate all child rules
                $(this.rules).each(function() {
                    this.applyRule(context, cfg);
                });

            } else {

                $(controls).each(function() {

                    // Some friendly debug info
                    if(cfg.log && $(this).size() === 0) {
                        log("Control selection is empty when hiding:");
                        log(this);
                    }

                    hide(this);
                });

                // Supress all child rules
                $(this.rules).each(function() {
                    this.applyRule(context, cfg, false);
                });
            }
        }
    });

    /**
     * A class which manages interdependenice rules.
     */
    function Ruleset() {

        // Hold a tree of rules
        this.rules = [];
    }

    $.extend(Ruleset.prototype, {

        /**
         * Add a new rule into this ruletset.
         *
         * See  {@link Rule} about the contstruction parameters.
         * @return {Rule}
         */
        createRule : function(controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },

        /**
         * Apply these rules on an element.
         *
         * @param {jQuery} context Selection we are dealing with
         *
         * @param cfg {@link Configuration} object or undefined.
         */
        applyRules: function(context, cfg) {
            var i;

            cfg = cfg || {};

            if(cfg.log) {
                log("Starting evaluation ruleset of " + this.rules.length + " rules");
            }

            for(i=0; i<this.rules.length; i++) {
                this.rules[i].applyRule(context, cfg);
            }
        },

        /**
         * Walk all rules and sub-rules in this ruleset
         * @param  {Function} callback(rule)
         *
         * @return {Array} Rules as depth-first searched
         */
        walk : function() {

            var rules = [];

            function descent(rule) {

                rules.push(rule);

                $(rule.children).each(function() {
                    descent(this);
                });
            }

            $(this.rules).each(function() {
                descent(this);
            });

            return rules;
        },


        /**
         * Check that all controllers and controls referred in ruleset exist.
         *
         * Throws an Error if any of them are missing.
         *
         * @param {jQuery} context jQuery selection of items
         *
         * @param  {Configuration} cfg
         */
        checkTargets : function(context, cfg) {

            var controls = 0;
            var rules = this.walk();

            $(rules).each(function() {

                if(context.find(this.controller).size() === 0) {
                    throw new Error("Rule's controller does not exist:" + this.controller);
                }

                if(this.controls.length === 0) {
                    throw new Error("Rule has no controls:" + this);
                }

                $(this.controls).each(function() {

                    if(safeFind(context, this) === 0) {
                        throw new Error("Rule's target control " + this + " does not exist in context " + context.get(0));
                    }

                    controls++;
                });

            });

            if(cfg.log) {
                log("Controller check ok, rules count " + rules.length + " controls count " + controls);
            }

        },

        /**
         * Make this ruleset effective on the whole page.
         *
         * Set event handler on **window.document** to catch all input events
         * and apply those events to defined rules.
         *
         * @param  {Configuration} cfg {@link Configuration} object or undefined
         *
         */
        install : function(cfg) {
            $.deps.enable($(document.body), this, cfg);
        }

    });

    /**
     * jQuery interdependencie plug-in
     *
     * @class jQuery.deps
     *
     */
    var deps = {

        /**
         * Create a new Ruleset instance.
         *
         * Example:
         *
         *      $(document).ready(function() {
         *           // Start creating a new ruleset
         *           var ruleset = $.deps.createRuleset();
         *
         *
         * @return {Ruleset}
         */
        createRuleset : function() {
            return new Ruleset();
        },


        /**
         * Enable ruleset on a specific jQuery selection.
         *
         * Checks the existince of all ruleset controllers and controls
         * by default (see config).
         *
         * See possible IE event bubbling problems: http://stackoverflow.com/q/265074/315168
         *
         * @param  {Object} selection jQuery selection in where we monitor all change events. All controls and controllers must exist within this selection.
         * @param  {Ruleset} ruleset
         * @param  {Configuration} cfg
         */
        enable : function(selection, ruleset, cfg) {

            cfg = cfg || {};

            if(cfg.checkTargets || cfg.checkTargets === undefined) {
                ruleset.checkTargets(selection, cfg);
            }

            var self = this;

            if(cfg.log) {
                log("Enabling dependency change monitoring on " + selection.get(0));
            }

            // Namespace our handler to avoid conflicts
            //
            var handler = function() { ruleset.applyRules(selection, cfg); };
            var val = selection.on ? selection.on("change.deps", null, null, handler) : selection.live("change.deps", handler);

            ruleset.applyRules(selection, cfg);

            return val;
        }
    };

    $.deps = deps;

})(jQuery);
;/* ========================================================================
 * Bootstrap: transition.js v3.3.4
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ========================================================================
 * Changed function name for avoid conflict
 * ======================================================================== */
+function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.CSemulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function (e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
      }
    }
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: tooltip.js v3.3.4
 * http://getbootstrap.com/javascript/#tooltip
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ========================================================================
 * Changed function and class names for avoid conflict
 * ======================================================================== */
+function ($) {
  'use strict';

  // TOOLTIP PUBLIC CLASS DEFINITION
  // ===============================

  var SPTooltip = function (element, options) {
    this.type       = null
    this.options    = null
    this.enabled    = null
    this.timeout    = null
    this.hoverState = null
    this.$element   = null

    this.init('sptooltip', element, options)
  }

  SPTooltip.VERSION  = '3.3.4'

  SPTooltip.TRANSITION_DURATION = 150

  SPTooltip.DEFAULTS = {
    animation: true,
    placement: 'top',
    selector: false,
    template: '<div class="sp-tooltip" role="tooltip"><div class="sp-tooltip-arrow"></div><div class="sp-tooltip-inner"></div></div>',
    trigger: 'hover focus',
    title: '',
    delay: 0,
    html: false,
    container: false,
    viewport: {
      selector: 'body',
      padding: 0
    }
  }

  SPTooltip.prototype.init = function (type, element, options) {
    this.enabled   = true
    this.type      = type
    this.$element  = $(element)
    this.options   = this.getOptions(options)
    this.$viewport = this.options.viewport && $(this.options.viewport.selector || this.options.viewport)

    if (this.$element[0] instanceof document.constructor && !this.options.selector) {
      throw new Error('`selector` option must be specified when initializing ' + this.type + ' on the window.document object!')
    }

    var triggers = this.options.trigger.split(' ')

    for (var i = triggers.length; i--;) {
      var trigger = triggers[i]

      if (trigger == 'click') {
        this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
      } else if (trigger != 'manual') {
        var eventIn  = trigger == 'hover' ? 'mouseenter' : 'focusin'
        var eventOut = trigger == 'hover' ? 'mouseleave' : 'focusout'

        this.$element.on(eventIn  + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
      }
    }

    this.options.selector ?
      (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
      this.fixTitle()
  }

  SPTooltip.prototype.getDefaults = function () {
    return SPTooltip.DEFAULTS
  }

  SPTooltip.prototype.getOptions = function (options) {
    options = $.extend({}, this.getDefaults(), this.$element.data(), options)

    if (options.delay && typeof options.delay == 'number') {
      options.delay = {
        show: options.delay,
        hide: options.delay
      }
    }

    return options
  }

  SPTooltip.prototype.getDelegateOptions = function () {
    var options  = {}
    var defaults = this.getDefaults()

    this._options && $.each(this._options, function (key, value) {
      if (defaults[key] != value) options[key] = value
    })

    return options
  }

  SPTooltip.prototype.enter = function (obj) {
    var self = obj instanceof this.constructor ?
      obj : $(obj.currentTarget).data('bs.' + this.type)

    if (self && self.$tip && self.$tip.is(':visible')) {
      self.hoverState = 'in'
      return
    }

    if (!self) {
      self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
      $(obj.currentTarget).data('bs.' + this.type, self)
    }

    clearTimeout(self.timeout)

    self.hoverState = 'in'

    if (!self.options.delay || !self.options.delay.show) return self.show()

    self.timeout = setTimeout(function () {
      if (self.hoverState == 'in') self.show()
    }, self.options.delay.show)
  }

  SPTooltip.prototype.leave = function (obj) {
    var self = obj instanceof this.constructor ?
      obj : $(obj.currentTarget).data('bs.' + this.type)

    if (!self) {
      self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
      $(obj.currentTarget).data('bs.' + this.type, self)
    }

    clearTimeout(self.timeout)

    self.hoverState = 'out'

    if (!self.options.delay || !self.options.delay.hide) return self.hide()

    self.timeout = setTimeout(function () {
      if (self.hoverState == 'out') self.hide()
    }, self.options.delay.hide)
  }

  SPTooltip.prototype.show = function () {
    var e = $.Event('show.bs.' + this.type)

    if (this.hasContent() && this.enabled) {
      this.$element.trigger(e)

      var inDom = $.contains(this.$element[0].ownerDocument.documentElement, this.$element[0])
      if (e.isDefaultPrevented() || !inDom) return
      var that = this

      var $tip = this.tip()

      var tipId = this.getUID(this.type)

      this.setContent()
      $tip.attr('id', tipId)
      this.$element.attr('aria-describedby', tipId)

      if (this.options.animation) $tip.addClass('fade')

      var placement = typeof this.options.placement == 'function' ?
        this.options.placement.call(this, $tip[0], this.$element[0]) :
        this.options.placement

      var autoToken = /\s?auto?\s?/i
      var autoPlace = autoToken.test(placement)
      if (autoPlace) placement = placement.replace(autoToken, '') || 'top'

      $tip
        .detach()
        .css({ top: 0, left: 0, display: 'block' })
        .addClass(placement)
        .data('bs.' + this.type, this)

      this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)

      var pos          = this.getPosition()
      var actualWidth  = $tip[0].offsetWidth
      var actualHeight = $tip[0].offsetHeight

      if (autoPlace) {
        var orgPlacement = placement
        var $container   = this.options.container ? $(this.options.container) : this.$element.parent()
        var containerDim = this.getPosition($container)

        placement = placement == 'bottom' && pos.bottom + actualHeight > containerDim.bottom ? 'top'    :
                    placement == 'top'    && pos.top    - actualHeight < containerDim.top    ? 'bottom' :
                    placement == 'right'  && pos.right  + actualWidth  > containerDim.width  ? 'left'   :
                    placement == 'left'   && pos.left   - actualWidth  < containerDim.left   ? 'right'  :
                    placement

        $tip
          .removeClass(orgPlacement)
          .addClass(placement)
      }

      var calculatedOffset = this.getCalculatedOffset(placement, pos, actualWidth, actualHeight)

      this.applyPlacement(calculatedOffset, placement)

      var complete = function () {
        var prevHoverState = that.hoverState
        that.$element.trigger('shown.bs.' + that.type)
        that.hoverState = null

        if (prevHoverState == 'out') that.leave(that)
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        $tip
          .one('bsTransitionEnd', complete)
          .CSemulateTransitionEnd(SPTooltip.TRANSITION_DURATION) :
        complete()
    }
  }

  SPTooltip.prototype.applyPlacement = function (offset, placement) {
    var $tip   = this.tip()
    var width  = $tip[0].offsetWidth
    var height = $tip[0].offsetHeight

    // manually read margins because getBoundingClientRect includes difference
    var marginTop = parseInt($tip.css('margin-top'), 10)
    var marginLeft = parseInt($tip.css('margin-left'), 10)

    // we must check for NaN for ie 8/9
    if (isNaN(marginTop))  marginTop  = 0
    if (isNaN(marginLeft)) marginLeft = 0

    offset.top  = offset.top  + marginTop
    offset.left = offset.left + marginLeft

    // $.fn.offset doesn't round pixel values
    // so we use setOffset directly with our own function B-0
    $.offset.setOffset($tip[0], $.extend({
      using: function (props) {
        $tip.css({
          top: Math.round(props.top),
          left: Math.round(props.left)
        })
      }
    }, offset), 0)

    $tip.addClass('in')

    // check to see if placing tip in new offset caused the tip to resize itself
    var actualWidth  = $tip[0].offsetWidth
    var actualHeight = $tip[0].offsetHeight

    if (placement == 'top' && actualHeight != height) {
      offset.top = offset.top + height - actualHeight
    }

    var delta = this.getViewportAdjustedDelta(placement, offset, actualWidth, actualHeight)

    if (delta.left) offset.left += delta.left
    else offset.top += delta.top

    var isVertical          = /top|bottom/.test(placement)
    var arrowDelta          = isVertical ? delta.left * 2 - width + actualWidth : delta.top * 2 - height + actualHeight
    var arrowOffsetPosition = isVertical ? 'offsetWidth' : 'offsetHeight'

    $tip.offset(offset)
    this.replaceArrow(arrowDelta, $tip[0][arrowOffsetPosition], isVertical)
  }

  SPTooltip.prototype.replaceArrow = function (delta, dimension, isVertical) {
    this.arrow()
      .css(isVertical ? 'left' : 'top', 50 * (1 - delta / dimension) + '%')
      .css(isVertical ? 'top' : 'left', '')
  }

  SPTooltip.prototype.setContent = function () {
    var $tip  = this.tip()
    var title = this.getTitle()

    $tip.find('.sp-tooltip-inner')[this.options.html ? 'html' : 'text'](title)
    $tip.removeClass('fade in top bottom left right')
  }

  SPTooltip.prototype.hide = function (callback) {
    var that = this
    var $tip = $(this.$tip)
    var e    = $.Event('hide.bs.' + this.type)

    function complete() {
      if (that.hoverState != 'in') $tip.detach()
      that.$element
        .removeAttr('aria-describedby')
        .trigger('hidden.bs.' + that.type)
      callback && callback()
    }

    this.$element.trigger(e)

    if (e.isDefaultPrevented()) return

    $tip.removeClass('in')

    $.support.transition && $tip.hasClass('fade') ?
      $tip
        .one('bsTransitionEnd', complete)
        .CSemulateTransitionEnd(SPTooltip.TRANSITION_DURATION) :
      complete()

    this.hoverState = null

    return this
  }

  SPTooltip.prototype.fixTitle = function () {
    var $e = this.$element
    if ($e.attr('title') || typeof ($e.attr('data-original-title')) != 'string') {
      $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
    }
  }

  SPTooltip.prototype.hasContent = function () {
    return this.getTitle()
  }

  SPTooltip.prototype.getPosition = function ($element) {
    $element   = $element || this.$element

    var el     = $element[0]
    var isBody = el.tagName == 'BODY'

    var elRect    = el.getBoundingClientRect()
    if (elRect.width == null) {
      // width and height are missing in IE8, so compute them manually; see https://github.com/twbs/bootstrap/issues/14093
      elRect = $.extend({}, elRect, { width: elRect.right - elRect.left, height: elRect.bottom - elRect.top })
    }
    var elOffset  = isBody ? { top: 0, left: 0 } : $element.offset()
    var scroll    = { scroll: isBody ? document.documentElement.scrollTop || document.body.scrollTop : $element.scrollTop() }
    var outerDims = isBody ? { width: $(window).width(), height: $(window).height() } : null

    return $.extend({}, elRect, scroll, outerDims, elOffset)
  }

  SPTooltip.prototype.getCalculatedOffset = function (placement, pos, actualWidth, actualHeight) {
    return placement == 'bottom' ? { top: pos.top + pos.height,   left: pos.left + pos.width / 2 - actualWidth / 2 } :
           placement == 'top'    ? { top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2 } :
           placement == 'left'   ? { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth } :
        /* placement == 'right' */ { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width }

  }

  SPTooltip.prototype.getViewportAdjustedDelta = function (placement, pos, actualWidth, actualHeight) {
    var delta = { top: 0, left: 0 }
    if (!this.$viewport) return delta

    var viewportPadding = this.options.viewport && this.options.viewport.padding || 0
    var viewportDimensions = this.getPosition(this.$viewport)

    if (/right|left/.test(placement)) {
      var topEdgeOffset    = pos.top - viewportPadding - viewportDimensions.scroll
      var bottomEdgeOffset = pos.top + viewportPadding - viewportDimensions.scroll + actualHeight
      if (topEdgeOffset < viewportDimensions.top) { // top overflow
        delta.top = viewportDimensions.top - topEdgeOffset
      } else if (bottomEdgeOffset > viewportDimensions.top + viewportDimensions.height) { // bottom overflow
        delta.top = viewportDimensions.top + viewportDimensions.height - bottomEdgeOffset
      }
    } else {
      var leftEdgeOffset  = pos.left - viewportPadding
      var rightEdgeOffset = pos.left + viewportPadding + actualWidth
      if (leftEdgeOffset < viewportDimensions.left) { // left overflow
        delta.left = viewportDimensions.left - leftEdgeOffset
      } else if (rightEdgeOffset > viewportDimensions.width) { // right overflow
        delta.left = viewportDimensions.left + viewportDimensions.width - rightEdgeOffset
      }
    }

    return delta
  }

  SPTooltip.prototype.getTitle = function () {
    var title
    var $e = this.$element
    var o  = this.options

    title = $e.attr('data-original-title')
      || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

    return title
  }

  SPTooltip.prototype.getUID = function (prefix) {
    do prefix += ~~(Math.random() * 1000000)
    while (document.getElementById(prefix))
    return prefix
  }

  SPTooltip.prototype.tip = function () {
    return (this.$tip = this.$tip || $(this.options.template))
  }

  SPTooltip.prototype.arrow = function () {
    return (this.$arrow = this.$arrow || this.tip().find('.sp-tooltip-arrow'))
  }

  SPTooltip.prototype.enable = function () {
    this.enabled = true
  }

  SPTooltip.prototype.disable = function () {
    this.enabled = false
  }

  SPTooltip.prototype.toggleEnabled = function () {
    this.enabled = !this.enabled
  }

  SPTooltip.prototype.toggle = function (e) {
    var self = this
    if (e) {
      self = $(e.currentTarget).data('bs.' + this.type)
      if (!self) {
        self = new this.constructor(e.currentTarget, this.getDelegateOptions())
        $(e.currentTarget).data('bs.' + this.type, self)
      }
    }

    self.tip().hasClass('in') ? self.leave(self) : self.enter(self)
  }

  SPTooltip.prototype.destroy = function () {
    var that = this
    clearTimeout(this.timeout)
    this.hide(function () {
      that.$element.off('.' + that.type).removeData('bs.' + that.type)
    })
  }


  // TOOLTIP PLUGIN DEFINITION
  // =========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.sptooltip')
      var options = typeof option == 'object' && option

      if (!data && /destroy|hide/.test(option)) return
      if (!data) $this.data('bs.sptooltip', (data = new SPTooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.sptooltip

  $.fn.sptooltip             = Plugin
  $.fn.sptooltip.Constructor = SPTooltip


  // TOOLTIP NO CONFLICT
  // ===================

  $.fn.sptooltip.noConflict = function () {
    $.fn.sptooltip = old
    return this
  }

}(jQuery);