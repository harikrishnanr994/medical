<div class="row">
    <div class="col-2">
    </div>
    <div class="col-8">
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #000000d4  !important;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">

        @if(count($theme_specs))
            <form action="{{route('admin.category.themeSpec')}}" method="post" >
                {{csrf_field()}}
                <div class="box">
                    <div class="box-header with-border">
                        <b>UPDATE CATEGORY THEME</b>
                    </div>

                    <input type="text" value="{{$category_id}}" name="category_id" style="display: none">
                    <input type="text" value="{{$used}}" name="used" style="display: none">
                    <div class="box-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <label>Category</label>
                                <input type="text" class="form-control" name="category" id="category"  value="{{$category_name}}" readonly>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <label>Variation Theme Name</label>
                                <input type="text" class="form-control" name="theme_name" id="theme_name" value="{{$theme_specs['theme_name']}}" required>
                            </div>
                        </div>
                        <?php
                        $selected_specs=array();
                        $used_specs='';
                        foreach($theme_specs['theme_specs'] as $theme)
                        {
                            $selected_specs[]=$theme->category_spec_id;
                        }
                        if($used=='true')
                        {
                            $used_specs='';
                            foreach($specs as $spec)
                            {
                                if(in_array($spec->id,$selected_specs))
                                {
                                    $used_specs=$used_specs.','.$spec->spec_name;
                                }
                            }
                        }

                        ?>
                        @if($used=='true')

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <label>Selected Variants</label>

                                    <input type="text" class="form-control" value="{{$used_specs}}"disabled>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <label>Add New Variants</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select variants" name="variants[]" required >

                                        @foreach($specs as $spec)
                                            @if(in_array($spec->id,$selected_specs))
                                                <option value="{{$spec->id}}" selected>{{$spec->spec_name}}</option>
                                            @else
                                                <option value="{{$spec->id}}">{{$spec->spec_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        @else
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <label>Variants</label>


                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select variants" name="variants[]" required>

                                        @foreach($specs as $spec)
                                            @if(in_array($spec->id,$selected_specs))
                                                <option value="{{$spec->id}}" selected>{{$spec->spec_name}}</option>
                                            @else
                                                <option value="{{$spec->id}}">{{$spec->spec_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        @endif

                    </div>


                    <div class="box-footer">
                        <button class="btn btn-danger" type="submit">Update Theme</button>
                    </div>

                </div>

            </form>


        @else
            <form action="{{route('admin.category.themeSpec')}}" method="post" >
                {{csrf_field()}}
                <div class="box">
                    <div class="box-header with-border">
                        <b>ADD CATEGORY THEME</b>

                    </div>
                    <input type="text" value="{{$category_id}}" name="category_id" style="display: none">
                    <input type="text" value="{{$used}}" name="used" style="display: none">
                    <div class="box-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <label>Category</label>
                                <input type="text" class="form-control" name="category" id="category" value="{{$category_name}}" readonly>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <label>Variation Theme Name</label>
                                <input type="text" class="form-control" name="theme_name" id="theme_name" value="" required>
                            </div>
                        </div>
                        {{-- {{dd($specs)}}--}}
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <label>Choose variants</label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select variants" name="variants[]" required>
                                    @foreach($specs as $spec)
                                        <option value="{{$spec->id}}">{{$spec->spec_name}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                    </div>


                    <div class="box-footer">
                        <button class="btn btn-danger" type="submit">Save Theme</button>
                    </div>

                </div>

            </form>

        @endif
    </div>
    <div class="col-2">
    </div>
    <!-- MinimalPro Admin for advanced form element -->
    <script src="{{ asset('admin/js/pages/advanced-form-element.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
</div>