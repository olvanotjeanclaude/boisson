@extends('layouts.app')

@section('title')
    Nouveau Article
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Article',
        'breadcrumbs' => [
            ['text' => 'Articles', 'link' => route('admin.articles.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <form action="{{ route('admin.articles.store') }}" id="newArticle" method="POST">
        @csrf
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-capitalize">Information du fournisseur</h5>
                        <select name="achat[1]['supplier_id']" class="form-control">
                            <option value="">Fournisseur</option>
                            @forelse ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->code }}-{{ Str::upper($supplier->identification) }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-primary float-right zindex-1 position-fixed" style="right: 0; top:100px;min-width:200px">
                    <div class="card-body text-center">
                        <h4 class="text-white font-weight-bold">Montant</h4>
                        <p class="card-text text-white">10000 ARIARY</p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-white btn-lg text-dark w-100">Valider</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="isiaFormRepeater repeat-section" id="achatFournisseur" data-field-id="achat"
            data-items-index-array="[1]">
            <div class="repeat-items">
                <div class="card repeat-item" data-field-index="1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6 col-md">
                                        <a data-repeat-remove-btn class="repeat-remove btn-sm btn btn-danger mb-1"
                                            href="#">Supprimer</a>
                                    </div>

                                    <div class="col-sm-6 mt-2 mt-sm-0 col-md">
                                        <span class="badge badge-pill badge-primary float-right">1000 Ariary</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-6 mt-1">
                                        <label class="text-bold-400 text-dark">Type D'Article</label>
                                        <select name="achat[1][article_type]" class="form-control repeat-el">
                                            <option value="">Choisir</option>
                                            <option value="1">Article</option>
                                            <option value="2">Consignation</option>
                                            <option value="3">Deconsignation</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <label class="text-bold-400 text-dark" id="achat[categoory_id]">Famille</label>
                                        <select name="achat[1][categoory_id]" class="form-control repeat-el"
                                            id="achat[categoory_id]">
                                            <option value="">Choisir</option>
                                            @foreach ($catArticles as $catArticle)
                                                <option value="{{ $catArticle->id }}">{{ $catArticle->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-bold-400 text-dark">Designation</label>
                                        <input type="text" class="repeat-el form-control" placeholder="Designation"
                                            id="achat[designation]" name="achat[1][designation]">
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-center text-bold-400 text-dark">Type</label>
                                        <div class="d-flex">
                                            <select class="form-control repeat-el" id="achat[quantity_type]"
                                                name="achat[1][quantity_type]">
                                                <option value="">Choisir</option>
                                                @foreach (\App\Models\Articles::UNITS as $key => $value)
                                                    @if ($key == 'pcs')
                                                        @continue
                                                    @endif
                                                    <option @if ($key == 'cageot') selected @endif
                                                        value="{{ $value }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" class="form-control repeat-el" id="achat[quantity_type_value]"
                                                name="achat[1][quantity_type_value]" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-bold-400 text-dark">Quantité Bouitelle</label>
                                        <input type="number" class="repeat-el form-control" placeholder="Qtt Bouteille"
                                            id="achat[quantity_bottle]" name="achat[1][quantity_bottle]">
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-bold-400 text-dark">Contenance</label>
                                        <input type="number" placeholder="0" value="20" class="repeat-el form-control"
                                            id="achat[contenance]" name="achat[1][contenance]">
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-bold-400 text-dark">Unite</label>
                                        <select id="achat[unity]" name="achat[1][unity]" class="repeat-el form-control">
                                            <option value="">Choisir</option>
                                            @foreach (\App\Models\Articles::UNITS as $key => $value)
                                                <option @if ($key == 'pcs') selected @endif
                                                    value="{{ $value }}">
                                                    {{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-1">
                                        <label class="text-bold-400 text-dark">Prix Unitaire</label>
                                        <input type="number" class="repeat-el form-control" id="achat[unit_price]"
                                            name="achat[1][unit_price]" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex mt-1 justify-content-center align-items-center">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h4 class="text-center">Tarif</h4>
                                        <div class="input-group">
                                            <label class="text-bold-400 text-dark">Prix D'Achat</label>
                                            <input type="number"  name="achat[1][buying_price]" class="ml-1 repeat-el form-control" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">AR</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label class="text-bold-400 text-dark">Prix De Gros</label>
                                            <input type="number"  name="achat[1][wholesale_price]" class="ml-1 repeat-el form-control" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">AR</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label class="text-bold-400 text-dark">Prix Détail</label>
                                            <input type="number"  name="achat[1][detail_price]" class="ml-1 repeat-el form-control" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">AR</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

            $("#newArticle").submit(function(e) {
                e.preventDefault();
                let data = new FormData(this);
                const url = $(this).attr("action");
                axios.post(url,data)
                .then((response) =>{
                    dataResponse = response.data;
                    console.log(dataResponse);
                });
            })
        });
    </script>
@endsection
