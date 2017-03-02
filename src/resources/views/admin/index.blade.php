@extends('core::admin.master')

@section('title', __('contacts::global.name'))

@section('content')

<div ng-app="typicms" ng-cloak ng-controller="ListController">

    @include('core::admin._button-create', ['module' => 'contacts'])

    <h1>@lang('contacts::global.name')</h1>

    <div class="btn-toolbar">
        @include('core::admin._button-select')
        @include('core::admin._button-actions')
        @include('core::admin._button-export')
        @include('core::admin._lang-switcher-for-list')
    </div>

    <div class="table-responsive">

        <table st-persist="contactsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="first_name" class="first_name st-sort">{{ __('First name') }}</th>
                    <th st-sort="last_name" class="last_name st-sort">{{ __('Last name') }}</th>
                    <th st-sort="email" class="email st-sort">{{ __('Email') }}</th>
                    <th st-sort="message" class="message st-sort">{{ __('Message') }}</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input st-search="first_name" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="last_name" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="email" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="message" class="form-control input-sm" placeholder="@lang('Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td>
                        <input type="checkbox" checklist-model="checked.models" checklist-value="model">
                    </td>
                    <td>
                        @include('core::admin._button-edit', ['module' => 'contacts'])
                    </td>
                    <td>@{{ model.first_name }}</td>
                    <td>@{{ model.last_name }}</td>
                    <td>@{{ model.email }}</td>
                    <td>@{{ model.message }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
