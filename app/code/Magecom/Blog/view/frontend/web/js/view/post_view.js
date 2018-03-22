define(
    [
        'jquery',
        'ko',
        'uiComponent'

    ],
    function ($, ko, component) {
        "use strict";

        return component.extend({
            initialize : function(){
                return this._super();
            }
        });
    }
);