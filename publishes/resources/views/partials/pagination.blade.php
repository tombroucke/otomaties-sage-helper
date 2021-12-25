@if(!empty($pages))
  <x-pagination>
    @foreach($pages as $page)
      <li class="page-item {{ $page['active'] ? 'active' : '' }}">{!! wp_kses($page['link'], ['a' => ['href' => [], 'title' => [], 'class' => []], 'span' => ['class' => []]]) !!}</li>
    @endforeach
  </x-pagination>
@endif
