/**
 * Created by mohith on 20/9/18.
 */
define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal'
], function (_, uiRegistry, select, modal) {
    'use strict';

    return select.extend({

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            console.log('Selected Value: ' + value);
            var field1 = uiRegistry.get('index = product_id');
            console.log(field1.visibleValue);
            console.log(uiRegistry);
             console.log(uiRegistry.get('index'));
             console.log(field1);
            console.log('hi' +field1.visibleValue);
            if (field1.visibleValue == value) {
                console.log(field1.visibleValue);
                field1.show();
            } else {
                field1.hide();
            }

            var field2 = uiRegistry.get('index = category');
            console.log(field2);
            if (field2.visibleValue == value) {
                console.log(field2.visibleValue);
                field2.show();
            } else {
                field2.hide();
            }

            return this._super();
        },
    });
});
