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

            var field1 = uiRegistry.get('index = field2Depend1');
            if (field1.visibleValue == value) {
                field1.show();
            } else {
                field1.hide();
            }

            var field2 = uiRegistry.get('index = field3Depend1');
            if (field2.visibleValue == value) {
                field2.show();
            } else {
                field2.hide();
            }

            return this._super();
        },
    });
});