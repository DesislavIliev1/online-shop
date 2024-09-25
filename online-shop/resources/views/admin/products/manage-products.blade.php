@extends('adminlte::page')

@section('title', $action == 'create' ? __('admin/general.createProduct') : __('admin/general.editProduct'))

@section('content_header')
<h1>{{ $action == 'create' ? __('admin/general.createProduct') : __('admin/general.editProduct') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <label>@lang('admin/general.errorsInputs')</label><br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $action == 'create' ? __('admin/general.createProduct') : __('admin/general.editProduct') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ $action == 'create' ? route('Admin.products.store') : route('Admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($action == 'edit')
                        @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="title">@lang('admin/general.title')</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $action == 'edit' ? $product->title : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">@lang('admin/general.category_id')</label>
                            <select class="form-select form-select-lg select2-style mb-3 form-control" name="category_id" id="category_id" data-control="select2">
                                <option value="" selected>@lang('admin/general.selectCategory')</option>
                                {{-- @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(isset($product) && ($product->category_id != null) && $product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location_id">@lang('admin/general.locations')</label>
                            <select class="form-select form-select-lg select2-style mb-3 form-control" name="location_id" id="location_id" data-control="select2">
                                <option value="" selected>@lang('admin/general.selectLocation')</option>
                                {{-- @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" @if(isset($product) && ($product->location_id != null) && $product->location_id == $location->id) selected @endif>{{ $location->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        @if($action != 'create')
                            <div class="form-group">
                                <label for="slug">@lang('admin/general.slug')</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $action == 'edit' ? $product->slug : '') }}" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="product-image">@lang('admin/general.image')</label>
                            <div class="mb-2 d-flex justify-content-start">
                                <div class="wrapper-img" style="width: 150px; height: 150px; overflow: hidden;">
                                    <input type="hidden" name="image" id="uploaded_image_name" value="" />
                                    @if(isset($product))
                                        @if(isset($product->image))
                                            <img id="product-image" data-id="{{ $product->id }}" class="selected-image upload-image img-fluid" src="https://cdn.megacars.bg/products/{{ $product->image }}" />
                                        @else
                                            <img id="product-image" data-id="{{ $product->id }}" class="selected-image upload-image img-fluid" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" />
                                        @endif
                                        <label for="editImg" class="btn btn-info btn-sm w-100 mt-1">
                                            @lang('admin/general.upload')
                                        </label>
                                        <input type="file" class="form-control d-none img-upload editImg" id="editImg" accept=".png, .jpeg, .jpg, .webp" name="image" />
                                    @else
                                        <img id="product-image" class="upload-image img-fluid" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" />
                                        <label for="editImg" class="btn btn-info btn-sm w-100 mt-1">
                                            @lang('admin/general.upload')
                                        </label>
                                        <input type="file" class="form-control d-none img-upload editImg" id="editImg" accept=".png, .jpeg, .jpg, .webp" name="image" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('admin/general.description')</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $action == 'edit' ? $product->description : '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">@lang('admin/general.price')</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="" value="{{ $product->price ?? old('price') }}" />
                            @error('price')
                            <div class="alert mt-1 mb-1 py-1 px-2 alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">@lang('admin/general.save')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
