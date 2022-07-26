<section class="ia-section-intro">
    <x-web.badge-location country="Colombia" city="Bogotá" dark />
	<h2>{{ $content->title }}</h2>
   
</section>
<div class="comp">
    <p>{{ $article->publication_date }}</p>
    <p>Compartir</p>
</div>
<section class="section-team">
  @if (count($users) > 3)
    <p class='number'>+{{ count($users) - 3 }}</p>  
  @endif

  @php($u = 0)
  @foreach ($users as $user)
    <div class="container-image">
      <img src="{{ $user->thumbnail_file }}"
      alt="" />
    </div>
    @php($u++)
    @if ($u >= 3)
      @break
    @endif
  @endforeach
  
  <div>
    <p class="team-work">Cocreadores</p>
    <a href="{{ URL::route('integrantes') }}" style="text-decoration:none"><p>Conoce a las y los integrantes de este proyecto > </p></a>
  </div>

  <div class="fecha">
    <p>{{ $article->publication_date }}</p>
    <p>Comparta</p>
  </div>
  
  <a><x-web.menu.social-arrow-movil/></a>
</section>
<hr class="vl">