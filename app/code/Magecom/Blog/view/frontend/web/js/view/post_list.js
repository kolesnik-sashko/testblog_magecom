define(
    [
        'jquery',
        'ko',
        'uiComponent'
    ],
    function ($, ko, Component) {
        "use strict";
        return Component.extend({
            defaults: {
                
            },
            initialize : function(){
                return this._super()                    
            }            
        });
    }
);