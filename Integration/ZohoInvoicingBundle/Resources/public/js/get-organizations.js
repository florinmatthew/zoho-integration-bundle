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
        
        route: 'orocrm_zoho_organizations',
        requiredOptions: [
            'apiUrl', 'authTokenField', 'organizationEl', 'organizationsList'
        ],
        resultTemplate: _.template("<div class='alert alert-<%= type %> connection-status'><%= message %></div>"),
        url: null,
        
        /**
         * 
         * @param {type} params
         * @returns {undefined}
         */
        initialize: function(params){
            this.options = _.defaults(params || {}, this.options);
            this.url = this.generateUrl();
              
            var missingParams = this.requiredOptions.filter(function (option) {
                return _.isUndefined(params[option]);
            });
            
            if (missingParams.length) {
                throw new TypeError('Missing required option(s): ' + missingParams.join(','));
            }
        },
        
        processClick: function(){
            
            var _that = this;
            var data = {
                authToken: $(this.options.authTokenField).val(),
                apiUrl   : $(this.options.apiUrl).val()
            };
            
            mediator.execute('showLoading');
            $.post(this.generateUrl(), data, _.bind(this.responseHandler, this), 'json')
                .always(_.bind(function (response, status) {
                    mediator.execute('hideLoading');
                    if (status !== 'success') {
                        console.log(response);
                        _that.renderResult('error', __('orocrm.zoho.org.server_error'));
                    }
                }, this));
        },
        
        responseHandler: function(res){
            if(res.success == false){
                this.renderResult('error', __('orocrm.zoho.org.'+ res.error_type +'.'+ res.which));
            }else{
                this.manageAPIResponse(res);
            }
        },
        
        manageAPIResponse: function(res){
            if(res.response.body.message === "success"){
                var $select = $(this.options.organizationEl), $list = $(this.options.organizationsList);
                
                $list.val(JSON.stringify(res.response.body.organizations));
                $select.empty();
                _.each(res.response.body.organizations, function (org) {
                    $select.append($("<option />").val(org.organization_id).text(org.name));
                });
                $select.trigger('change');
                
                this.renderResult('success', __('orocrm.zoho.org.success'));
            }else{
                this.renderResult('error', __('orocrm.zoho.org.'+ res.response.body.cause.toLowerCase()));
            }
        },
        
        /**
         * 
         * @param {type} type
         * @returns routing
         */
        generateUrl: function (type) {
            var params = {id: this.options.transportEntityid};
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