define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magecom_Blog/js/view/grid/price'
    ],
    function ($, ko, component, priceRender) {
        "use strict";

        return component.extend({
            items: ko.observableArray([]),
            columns: ko.observableArray([]),
            defaults: {
                template: 'Magecom_Blog/grid'
            },
            initialize: function () {
                this._super();
                this._render();
            },
            _render: function() {
                this._prepareColumns();
                this._prepareItems();
            },
            _prepareItems: function () {
                console.log(this.data);
                var items = JSON.parse(this.data);
                console.log(items);

                this.addItems(items);

            },
            _prepareColumns: function () {
                this.addColumn({headerText: "Item Name", rowText: "name", renderer: ''});
                this.addColumn({headerText: "Sales Count", rowText: "sales", renderer: ''});
                this.addColumn({headerText: "Price", rowText: "price", renderer: priceRender()});
            },
            addItem: function (item) {
                item.columns = this.columns;
                this.items.push(item);
            },
            addItems: function (items) {
                for (var i in items) {
                    this.addItem(items[i]);
                }
            },
            addColumn: function (column) {
                this.columns.push(column);
            }
        });
    }
);
