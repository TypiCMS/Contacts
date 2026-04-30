<x-core::layouts.page
    :page="$page"
    :body-class="'body-contacts body-contact-sent body-page body-page-' . $page->id"
>
    <div class="page-body">
        <div class="page-body-container">
            <div class="rich-content">{!! $page->formattedBody() !!}</div>

            <p class="alert alert-success">@lang('message when contact form is sent')</p>
        </div>
    </div>
</x-core::layouts.page>
