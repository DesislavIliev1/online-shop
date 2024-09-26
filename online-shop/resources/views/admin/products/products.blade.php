@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>@lang('admin/general.products')</h1>
@stop

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="card col-12">
                    <div class="card-header row d-flex justify-content-between">
                        <div class="col-12 mb-2">
                            <div class="row">
                                <h6 class="text-center my-auto">@lang('admin/general.products')</h6>
                                <a class="btn btn-success ml-auto" href="{{route('Admin.products.create')}}"><i
                                        class="fas fa-edit"></i> @lang('admin/general.createButtonText')</a>
                                <form method="GET" action="{{ route('Admin.products.index') }}"
                                    class="per_page ml-1 d-flex">
                                    <select name="perPage" class="form-select form-select-lg bg-dark rounded p-1"
                                        onchange="this.form.submit()">
                                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('Admin.products.index') }}" method="GET">
                                <div class="row justify-content-between">
                                    <div class="col-4 col">
                                        <div class="input-group">
                                            <input type="text" class="form-control mr-1" name="search"
                                                value="{{ request('search') }}" placeholder="@lang('admin/general.search')">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@lang('admin/general.from')</span>
                                            </div>
                                            <input type="date" class="form-control" name="from"
                                                value="{{ request('from') }}" >

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@lang('admin/general.to')</span>
                                            </div>
                                            <input type="date" class="form-control" name="to"
                                                value="{{ request('to') }}">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mr-1"><i
                                                class="fas fa-search"></i>@lang('admin/general.search')</button>
                                        <button type="submit" class="btn btn-danger" name="clear" value="true"><i
                                                class="fas fa-times"></i> @lang('general.delete-all')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <form action="{{ route('Admin.products.index') }}" method="GET">
                                    <tr class="bg-light">
                                        <th scope="col">
                                            <div class="d-flex">
                                                ID
                                                <button type="submit" name="sortOrderByID"
                                                    value="{{ request('sortOrderByID') == 'desc' ? 'asc' : 'desc' }}"
                                                    class="btn btn-link p-0 ml-1">
                                                    <i class="fas fa-sort"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th scope="col">
                                            @lang('admin/general.title')
                                            <button type="submit" name="sortOrderByTitle"
                                                value="{{ request('sortOrderByTitle') == 'desc' ? 'asc' : 'desc' }}"
                                                class="btn btn-link p-0">
                                                <i class="fas fa-sort"></i>
                                            </button>
                                        </th>
                                        <th scope="col">@lang('admin/general.slug')</th>
                                        <th scope="col">@lang('admin/general.image')</th>
                                        <th scope="col">
                                            <div class="d-flex">
                                                @lang('admin/general.category_id')
                                                <button type="submit" name="sortOrderByCategoryID"
                                                    value="{{ request('sortOrderByCategoryID') == 'desc' ? 'asc' : 'desc' }}"
                                                    class="btn btn-link p-0 ml-1">
                                                    <i class="fas fa-sort"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th scope="col">@lang('admin/general.user')</th>
                                        <th scope="col">@lang('admin/general.locations')</th>
                                        <th scope="col">@lang('admin/general.price')</th>
                                        <th scope="col">@lang('admin/general.action')</th>
                                    </tr>
                                </form>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    @php
                                    @endphp
                                    @if ($index % 25 == 0 && $index != 0)
                                        <tr class="bg-light">
                                            <th scope="col">
                                                <div class="d-flex">
                                                    ID
                                                    <button type="submit" name="sortOrderByID"
                                                        value="{{ request('sortOrderByID') == 'desc' ? 'asc' : 'desc' }}"
                                                        class="btn btn-link p-0 ml-1">
                                                        <i class="fas fa-sort"></i>
                                                    </button>
                                                </div>
                                            </th>
                                            <th scope="col">
                                                @lang('admin/general.title')
                                                <button type="submit" name="sortOrderByTitle"
                                                    value="{{ request('sortOrderByTitle') == 'desc' ? 'asc' : 'desc' }}"
                                                    class="btn btn-link p-0">
                                                    <i class="fas fa-sort"></i>
                                                </button>
                                            </th>
                                            <th scope="col">@lang('admin/general.slug')</th>
                                            <th scope="col">@lang('admin/general.image')</th>
                                            <th scope="col">
                                                <div class="d-flex">
                                                    @lang('admin/general.category_id')
                                                    <button type="submit" name="sortOrderByCategoryID"
                                                        value="{{ request('sortOrderByCategoryID') == 'desc' ? 'asc' : 'desc' }}"
                                                        class="btn btn-link p-0 ml-1">
                                                        <i class="fas fa-sort"></i>
                                                    </button>
                                                </div>
                                            </th>
                                            <th scope="col">@lang('admin/general.user')</th>
                                            <th scope="col">@lang('admin/general.locations')</th>
                                            <th scope="col">@lang('admin/general.price')</th>
                                            <th scope="col">@lang('admin/general.action')</th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td></td>
                                        <td>
                                            @if ($product->image)
                                                <a data-fancybox="gallery" class="fancy"
                                                    href="https://cdn.megacars.bg/products/{{ $product->image }}">
                                                    <img class="product-image" data-id="{{ $product->id }}"
                                                        src="https://cdn.megacars.bg/products/{{ $product->image }}"
                                                        alt="product image">
                                                </a>
                                            @else
                                                <img class="admin-image d-none" data-id="{{ $product->id }}"
                                                    src="">
                                                <span class="image no-image">No image found!</span>
                                            @endif
                                            <input type="file" class="form-control d-none quick-edit"
                                                id="fileUpload{{ $product->id }}" accept=".png, .jpeg, .jpg, .webp"
                                                name="image" />
                                            <button data-id="{{ $product->id }}"
                                                class="btn btn-primary btn-sm up-bt d-none">@lang('admin/general.upload')</button>
                                        </td>
                                        {{-- <td>{{ $product->getCategoryName() }}</td> --}}
                                        <td>{{ $product->user->name }}</td>
                                        {{-- <td>{{ $product->location->name }}</td> --}}
                                        <td>{{ $product->price }}</td>

                                        <td class="d-flex">
                                            <a href="{{ route('Admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-info mr-1"> <i class="fas fa-edit"></i>
                                                @lang('admin/general.editButtonText')</a>
                                            <form action="{{ route('Admin.products.destroy', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mr-1"> <i
                                                        class="fas fa-trash"></i>
                                                    @lang('admin/general.deleteButtonText')</button>
                                            </form>
                                            <div class="dropdown d-flex">
                                                <button class="btn btn-block btn-sm btn-outline-warning dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    @lang('admin/general.more')
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('Admin.products.index', $product->id) }}"
                                                        target="_blank"> <i class="fas fa-eye"></i> @lang('admin/general.showInMC')</a>
                                                    @if (isset($product->user->slug))
                                                        <a class="dropdown-item"
                                                            href="{{ route('user.ads', $product->user->slug) }}"
                                                            target="_blank"> <i class="fas fa-eye"></i>
                                                            @lang('admin/general.showPublicProfile')</a>
                                                    @else
                                                        <a class="dropdown-item disabled" href="#" target="_blank">
                                                            <i class="fas fa-eye"></i> @lang('admin/general.showPublicProfile')</a>
                                                    @endif
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('Admin.users.show', $product->user->id) }}"> <i
                                                            class="fas fa-fw fa-lock "></i> @lang('admin/general.showUserInAdmin')</a> --}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $products->links() }}
                            <form method="GET" action="{{ route('Admin.products.index') }}"
                                class="per_page ml-auto">
                                <select name="perPage" class="form-select p-1 bg-dark rounded "
                                    onchange="this.form.submit()">
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
