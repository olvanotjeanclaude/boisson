@extends('layouts.app')

@section('title')
    Nouveau Achat Fournisseur
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Client',
        'breadcrumbs' => [
            ['text' => 'Achat Fournisseurs', 'link' => route('admin.achat-fournisseurs.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <div class="isiaFormRepeater repeat-section" id="achatFournisseur" data-field-id="achat" data-items-index-array="[1]">
        <div class="repeat-items">
            <div class="card repeat-item" data-field-index="1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <a data-repeat-remove-btn class="repeat-remove btn-sm btn btn-danger mb-1" href="#">Supprimer</a>
                            <span class="badge badge-pill badge-primary">1000 Ariary</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 mt-1">
                            <label class="text-bold-400 text-dark">Designation</label>
                            <input type="text" class="repeat-el form-control" placeholder="Designation"
                                id="achat[designation][1]" name="achat[designation][1]">
                        </div>
                        <div class="col-sm-6 col-md mt-1">
                            <label class="text-bold-400 text-dark">Type</label>
                            <select name="type" class="form-control" id="type">
                                <option value="">Choisir</option>
                                <option value="">Cageot</option>
                                <option value="">Carton</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md mt-1">
                            <label class="text-bold-400 text-dark">Quantité Bll</label>
                            <input type="number" class="repeat-el form-control" placeholder="Quantité Bll"
                                id="achat[qtt_bll][1]" name="achat[qtt_bll][1]">
                        </div>
                        <div class="col-sm-6 col-md mt-1">
                            <label class="text-bold-400 text-dark">Contenance</label>
                            <input type="number" placeholder="Contenance" class="repeat-el form-control"
                                id="achat[contenance][1]" name="achat[contenance][1]">
                        </div>
                        <div class="col-sm-6 col-md mt-1">
                            <label class="text-bold-400 text-dark">Unite</label>
                            <input type="text" value="pcs" disabled placeholder="pcs" class="repeat-el form-control"
                                id="achat[unity][1]" name="achat[unity][1]">
                        </div>
                        <div class="col-sm-6 col-md mt-1">
                            <label class="text-bold-400 text-dark">Prix Unitaire</label>
                            <input type="number" class="repeat-el form-control" id="achat[unit_price][1]"
                                name="achat[unit_price][1]" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        /* ========= THE PLUGIN ========= */

        (function($, window, document, undefined) {

            'use strict';

            // Create the defaults once
            // Declare global variables
            let pluginName = 'formRepeater',
                el, addEl, removeEl, fieldId, itemsIndexArray, maxItemIndex, repeatItem;
            const defaults = {
                addButton: '<div class="repeat-add-wrapper"><a data-repeat-add-btn class="repeat-add" href="#">Add</a></div>',
                //removeButton: '<a data-repeat-remove-btn class="repeat-remove" href="#">Remove</a>',
            };

            // The actual plugin constructor
            function Plugin(element, options) {
                this.element = element;
                this.el = el;
                this.addEl = addEl;
                this.removeEl = removeEl;
                this.fieldId = fieldId;
                this.itemsIndexArray = itemsIndexArray;
                this.maxItemIndex = maxItemIndex;
                this.repeatItem = repeatItem;
                this.settings = $.extend({}, defaults, options);
                this._defaults = defaults;
                this._name = pluginName;
                this.init();
            }

            // Avoid Plugin.prototype conflicts
            $.extend(Plugin.prototype, {
                init() {

                    /**
                     * [el The element id]
                     * @type {String}
                     */
                    this.el = '#' + this.element.id;

                    /**
                     * [addEl The add button class]
                     * @type {[type]}
                     */
                    this.addEl = $('a[data-repeat-add-btn]');

                    /**
                     * [removeEl The remove button class]
                     * @type {[type]}
                     */
                    this.removeEl = $('a[data-repeat-remove-btn]');

                    /**
                     * [fieldId The id of the option field]
                     * @type {[type]}
                     */
                    this.fieldId = $(this.el).attr('data-field-id');

                    /**
                     * [itemsIndexArray The keys of the array items currently present ]
                     * @type {[type]}
                     */
                    this.itemsIndexArray = JSON.parse($(this.el).attr('data-items-index-array'));

                    this.maxItemIndex = Math.max.apply(null, this.itemsIndexArray);

                    //Create add button
                    this.createAddButton(this.settings.addButton);

                    //Create remove button
                    this.createRemoveButton(this.settings.removeButton);

                    //Add Item
                    this.addItem(this.el, this.addEl, this.itemsIndexArray, this.maxItemIndex, this.settings
                        .removeButton, this.repeatItem);

                    //Remove Item
                    this.removeItem(this.el, this.removeEl, this.itemsIndexArray, this.maxItemIndex);

                },
                createAddButton(addButton) {
                    $(this.el).append(addButton);
                },
                createRemoveButton(removeButton) {
                    $(this.el + ' .repeat-item').each(function(i) {
                        if (i !== 0) {
                            $(this).prepend(removeButton);
                        }
                    });
                },
                addItem(el, addEl, itemsIndexArray, maxItemIndex, removeButton, repeatItem) {
                    $(this.el).on('click', addEl, function(event) {
                        event.preventDefault();
                        if (!event.target.hasAttribute('data-repeat-add-btn')) {
                            event.stopPropagation();
                        } else {
                            itemsIndexArray.push(maxItemIndex + 1);

                            $(el).attr('data-items-index-array', '[' + itemsIndexArray.toString() +
                                ']');

                            maxItemIndex = Math.max.apply(null, itemsIndexArray);

                            repeatItem = $(el + ' .repeat-item:first').clone(true);
                            repeatItem.attr('data-field-index', maxItemIndex);
                            repeatItem.find(':input').val('');
                            repeatItem.find('checkbox').checked = false;
                            repeatItem.find('radio').checked = false;
                            repeatItem.find('.repeat-el').each(function() {
                                const newName = this.name.replace(/[[]\d+[\]]/g, '[' +
                                    maxItemIndex + ']');
                                this.name = newName;
                            });

                            repeatItem.prepend(removeButton);
                            repeatItem.appendTo(el + ' .repeat-items');

                        }
                    });

                },
                removeItem(el, removeEl, itemsIndexArray) {
                    $(el + ' .repeat-item').on('click', removeEl, function(event) {
                        event.preventDefault();
                        if (!event.target.hasAttribute('data-repeat-remove-btn')) {
                            event.stopPropagation();
                        } else {
                            const currentFieldIndex = parseInt($(this).attr('data-field-index'));
                            if (currentFieldIndex !== 1) {
                                const remove_index = itemsIndexArray.indexOf(currentFieldIndex);

                                if (remove_index > -1) {
                                    itemsIndexArray.splice(remove_index, 1);
                                    maxItemIndex = Math.max.apply(null, itemsIndexArray);
                                }

                                $(el).attr('data-items-index-array', '[' + itemsIndexArray.toString() +
                                    ']');

                                $(el + ' .repeat-item[data-field-index=' + currentFieldIndex + ']')
                                    .remove();
                            }
                        }

                    });
                },

            });

            // A really lightweight plugin wrapper around the constructor,
            // preventing against multiple instantiations
            $.fn[pluginName] = function(options) {
                return this.each(function() {
                    if (!$.data(this, 'plugin_' + pluginName)) {
                        $.data(this, 'plugin_' +
                            pluginName, new Plugin(this, options));
                    }
                });
            };

        }(jQuery, window, document));

        /* ========= DEMO SET UP ========= */
        $(document).ready(function() {
            $('#achatFournisseur').formRepeater({
                addButton: '<div class="repeat-add-wrapper"><a data-repeat-add-btn class="repeat-add btn-sm btn btn-success" href="#">Ajouter</a></div>',
                //removeButton: '<a data-repeat-remove-btn class="repeat-remove btn-sm btn btn-danger mb-1" href="#">Supprimer</a>'
            });
        });
    </script>
@endsection
