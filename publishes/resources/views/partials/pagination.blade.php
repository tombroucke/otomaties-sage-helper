@if(!empty($pages))
  <x-pagination>
    @foreach($pages as $page)
      <li class="page-item {{ $page['active'] ? 'active' : '' }}">{!! $page['link'] !!}</li>
    @endforeach
  </x-pagination>
@endif
