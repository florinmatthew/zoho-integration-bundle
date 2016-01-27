define([
    'jquery',
    'underscore',
    'routing',
    'backbone',
    'orotranslation/js/translator',
    'oroui/js/mediator',
    'oroui/js/messenger'
], function ($, _, routing, Backbone, __, mediator, messenger) {
    "use strict";

    return Backbone.View.extend({
        events: {
            'click': 'processClick'
        },
        
        route: 'orocrm_zoho_rest_check',
        requiredOptions: [
            'authApiUrl', 'scope', 'email', 'password'
        ],
        resultTemplate: _.template("<div class='alert alert-<%= type %> connection-status'><%= message %></div>"),
        url: null,
        transportEntityid: null,
        authTokenField: null,
        organizationEl: null,
        /**
         * 
         * @param {type} params
         * @returns {undefined}
         */
        initialize: function(params){
            
            this.options = _.defaults(params || {}, this.options);
            this.transportEntityid = params.transportEntityId;
            this.authTokenField = params.authTokenField;
            this.url = this.generateUrl();
            this.organizationEl = params.organizationEl;
            
            var missingParams = this.requiredOptions.filter(function (option) {
                return _.isUndefined(params[option]);
            });
            
            if (missingParams.length) {
                throw new TypeError('Missing required option(s): ' + missingParams.join(','));
            }
        },
        
        processClick: function(){
            
            var data = this.$el.parents('form').serializeArray(), _that = this;
            var typeData = _.filter(data, function (field) {
                return field.name.indexOf('[type]') !== -1;
            });
            
            mediator.execute('showLoading');
            $.post(this.generateUrl(typeData), data, _.bind(this.responseHandler, this), 'json')
                .always(_.bind(function (response, status) {
                    mediator.execute('hideLoading');
                    if (status !== 'success') {
                        _that.renderResult('error', __('orocrm.zoho.token.server_error'));
                    }
                }, this));
        },
        
        /**
         * 
         * @param {type} res
         * @returns {undefined}
         */
        responseHandler: function(res){
            if(res.success == false){
                this.renderResult('error', __('orocrm.zoho.token.'+ res.error_type +'.'+ res.which));
            }else{
                this.manageAPIResponse(res);
            }
        },
        
        /**
         * 
         * @param {type} res
         * @returns {undefined}
         */
        manageAPIResponse: function(res){
            if(res.response.body.result === "TRUE"){
                console.log(res);
                $(document).find(this.authTokenField).val(res.response.body.token);
                this.renderResult('success', __('orocrm.zoho.token.success'));
            }else{
                this.renderResult('error', __('orocrm.zoho.token.'+ res.response.body.cause.toLowerCase()));
            }
        },
        
        /**
         * 
         * @param {type} type
         * @returns routing
         */
        generateUrl: function (type) {
            var params = {id: this.transportEntityid};
            if (type !== undefined) {
                params.type = type;
            }

            return routing.generate(this.route, params);
        },
        
        /**
         * 
         * @param {type} type
         * @param {type} message
         * @returns {undefined}
         */
        renderResult: function (type, message) {
            var container = this.$el.parent();
            container.find('.alert').remove();
            messenger.notificationMessage(type, message, {container: container, template: this.resultTemplate});
        }
    })
});