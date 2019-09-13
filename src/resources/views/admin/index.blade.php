@extends('core::admin.master')

@section('title', __('Contacts'))

@section('content')

<item-list
    url-base="/api/contacts"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,created_at,name,email,message"
    table="contacts"
    title="contacts"
    :publishable="false"
    :searchable="['name,email,message']"
    :sorting="['-created_at']">

    <template slot="add-button">
        @include('core::admin._button-create', ['module' => 'contacts'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox"></item-list-column-header>
        <item-list-column-header name="edit"></item-list-column-header>
        <item-list-column-header name="created_at" sortable :sort-array="sortArray" :label="$t('Date')"></item-list-column-header>
        <item-list-column-header name="name" sortable :sort-array="sortArray" :label="$t('Name')"></item-list-column-header>
        <item-list-column-header name="email" sortable :sort-array="sortArray" :label="$t('Email')"></item-list-column-header>
        <item-list-column-header name="message" sortable :sort-array="sortArray" :label="$t('Message')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td>@include('core::admin._button-edit', ['module' => 'contacts'])</td>
        <td>@{{ model.created_at | date }}</td>
        <td>@{{ model.name }}</td>
        <td><a :href="'mailto:'+model.email">@{{ model.email }}</a></td>
        <td>@{{ model.message }}</td>
    </template>

</item-list>

@endsection
