@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp
                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                                            style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div
                                    class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name"
                                           style="color: #000; font-weight: bold">{{ $row->display_name }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add')])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label>Категории</label>
                                <ul style="list-style-type: none; padding-left: 0">
                                    @foreach ($categories as $category)
                                        @if($category->children->count() > 0)
                                            <li><label>
                                                    <input value="{{ $category->id }}" type="checkbox" name="category[]"
                                                           style="margin-right: 5px;" {{ $categoriesForProduct->contains($category) ? 'checked' : '' }}>
                                                    {{ $category->name }}
                                                    @foreach($category->children as $subCategory)
                                                        <ul>
                                                            <li style="list-style-type: none;">
                                                                <input value="{{ $subCategory->id }}" type="checkbox"
                                                                       name="category[]"
                                                                       style="margin-right: 5px;" {{ $categoriesForProduct->contains($subCategory) ? 'checked' : '' }}>
                                                                {{$subCategory->name}}
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </label></li>
                                        @else
                                            <li><label>
                                                    <input value="{{ $category->id }}" type="checkbox" name="category[]"
                                                           style="margin-right: 5px;" {{ $categoriesForProduct->contains($category) ? 'checked' : '' }}>
                                                    {{ $category->name }}
                                                </label></li>
                                        @endif
                                    @endforeach


                                </ul>
                                <hr>
                                @if(isset($coffeeAttributes) && $coffeeAttributes->count() !== 0)
                                    <h4>Атрибуты кофе</h4>
                                        <div class="form-group">
                                            @foreach($coffeeAttributes as $attribute)
                                            <label>Процент арабики(от 0 до 100)</label>
                                            <input type="text" class="form-control" name="coffeeAttributes[arabica_percent]" value="<?= $attribute['arabica_percent'] ?>">
                                            <label>Процент нута(от 0 до 100)</label>
                                            <input type="text" id="color" class="form-control" name="coffeeAttributes[chickpea_percent]" value="<?= $attribute['chickpea_percent'] ?>">
                                            <label>Процент робусты(от 0 до 100)</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[robusta_percent]" value="<?= $attribute['robusta_percent'] ?>">
                                            <label>Страна сбора</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[origin]" value="<?= $attribute['origin'] ?>">
                                            <label>Горчинка(от 1 до 6)</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[bitterness]" value="<?= $attribute['density'] ?>">
                                            <label>Плотность(от 1 до 6)</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[density]" value="<?= $attribute['density'] ?>">
                                            <label>Крепость(от 1 до 6)</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[strong]" value="<?= $attribute['strong'] ?>">
                                            <label>Аромат (от 1 до 6)</label>
                                            <input type="text" id="size" class="form-control" name="coffeeAttributes[aroma]" value="<?= $attribute['aroma'] ?>">
                                            <label for="use">Использование</label>
                                            @if(isset($attribute->uses))
                                                <div id="use">
                                                    @foreach(json_decode($attribute->uses) as $uses)
                                                        <img src="<?= '/' . $uses ?>" alt="123" width="50px" height="50px">
                                                        @endforeach
                                                </div>
                                                @endif
                                                    <button id="new-uses">Выбрать новое</button>
                                                <select style="height: 300px" multiple class="form-control" name="coffeeAttributes[uses][]" id="select">
                                                    <option value="images/uses/filter.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/filter-pot-coffee.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-pot-coffee.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/filter-filter.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-filter.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/filter-espresso.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-espresso.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/frape-mikser.png" style="width: 120px; height: 100px; background-image:url(/images/uses/frape-mikser.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/kapsuli.png" style="width: 120px; height: 100px; background-image:url(/images/uses/kapsuli.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/profesionalno.png" style="width: 120px; height: 100px; background-image:url(/images/uses/profesionalno.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/filter-instant.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-instant.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/vending.png" style="width: 120px; height: 100px; background-image:url(/images/uses/vending.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/zelen-chai.png" style="width: 120px; height: 100px; background-image:url(/images/uses/zelen-chai.png); background-repeat: no-repeat;"></option>
                                                    <option value="images/uses/zeleno-kafe.png" style="width: 120px; height: 100px; background-image:url(/images/uses/zeleno-kafe.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/meka-opakovka.png" style="width: 120px; height: 100px; background-image:url(/images/uses/meka-opakovka.png); background-repeat: no-repeat;" ></option>
                                                    <option value="images/uses/metalna-opakovka.png" style="width: 120px; height: 100px; background-image:url(/images/uses/metalna-opakovka.png); background-repeat: no-repeat;" ></option>
                                                </select>
                                                @endforeach

                                        </div>
                                @else
                                <h4>Добавить Атрибуты кофе</h4>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="font-weight-bold">Процент арабики</label>
                                    <input type="text" class="form-control" name="coffeeAttributes[arabica_percent]">
                                <label for="exampleInputEmail1" class="font-weight-bold">Процент нута</label>
                                <input type="text" id="color" class="form-control" name="coffeeAttributes[chickpea_percent]">
                                    <label for="exampleInputEmail1" class="font-weight-bold">Процент робусты</label>
                                <input type="text" id="size" class="form-control" name="coffeeAttributes[robusta_percent]">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Страна производства</label>
                                <input type="text" id="size" class="form-control" name="coffeeAttributes[origin]">
                                        <label for="exampleInputEmail1" class="font-weight-bold">211</label>
                                <input type="text" id="size" class="form-control" name="coffeeAttributes[density]">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Крепость</label>
                                <input type="text" id="size" class="form-control" name="coffeeAttributes[strong]">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Аромат</label>
                                <input type="text" id="size" class="form-control" name="coffeeAttributes[aroma]">
                                        <label for="exampleInputEmail1" class="font-weight-bold">Использование</label>
                                    <button id="new-uses">Выбрать</button>
                                    <select style="height: 300px" multiple class="form-control" name="coffeeAttributes[uses][]" id="select">
                                        <option value="images/uses/filter.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/filter-pot-coffee.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-pot-coffee.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/filter-filter.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-filter.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/filter-espresso.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-espresso.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/frape-mikser.png" style="width: 120px; height: 100px; background-image:url(/images/uses/frape-mikser.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/kapsuli.png" style="width: 120px; height: 100px; background-image:url(/images/uses/kapsuli.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/profesionalno.png" style="width: 120px; height: 100px; background-image:url(/images/uses/profesionalno.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/filter-instant.png" style="width: 120px; height: 100px; background-image:url(/images/uses/filter-instant.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/vending.png" style="width: 120px; height: 100px; background-image:url(/images/uses/vending.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/zelen-chai.png" style="width: 120px; height: 100px; background-image:url(/images/uses/zelen-chai.png); background-repeat: no-repeat;"></option>
                                        <option value="images/uses/zeleno-kafe.png" style="width: 120px; height: 100px; background-image:url(/images/uses/zeleno-kafe.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/meka-opakovka.png" style="width: 120px; height: 100px; background-image:url(/images/uses/meka-opakovka.png); background-repeat: no-repeat;" ></option>
                                        <option value="images/uses/metalna-opakovka.png" style="width: 120px; height: 100px; background-image:url(/images/uses/metalna-opakovka.png); background-repeat: no-repeat;" ></option>
                                    </select>
                                </div>
                                @endif
                            </div><!-- panel-body -->
                            <div class="panel-footer">
                                @section('submit-buttons')
                                    <button type="submit"
                                            class="btn btn-primary save" id="submit">{{ __('voyager::generic.save') }}</button>
                                @stop
                                @yield('submit-buttons')
                            </div>
                        </div>
                    </form>
                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'
                    </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function () {
                $file = $(this).siblings(tag);

                params = {
                    slug: '{{ $dataType->slug }}',
                    filename: $file.data('file-name'),
                    id: $file.data('id'),
                    field: $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        const select = document.querySelector('#select');
        const newUses = document.querySelector('#new-uses');
        select.style.visibility = 'hidden';
        newUses.onclick = (e) => {
            e.preventDefault();
            select.style.visibility = 'visible'};
        // $('#colorButton').on('click', (e) => {
        //     e.preventDefault();
        //     $('#color').attr('type', 'color');
        // });
        // $('#sizeButton').on('click', (e) => {
        //     e.preventDefault();
        //     $('#size').attr('type', 'text')
        // });
        // $('#submit').on('click', (e) => {
        //     if(size.value && !color.value) {
        //         e.preventDefault();
        //         alert('Укажите цвет к размеру');
        //     }
        // });
    </script>
@stop
