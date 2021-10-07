@extends('layouts.main')

@section('titulo', 'Pesquisa')

@section('conteudo')

    <div class="container bg-white shadow mt-3 mb-3 rounded">
        <div class="row">
            <div class="col-sm-3 bg-light rounded">
                {{-- Botões de alternar entre pessoas e instituições --}}
                <div class="text-center mt-3">


                    <a href="/pesquisa?q={{ $pesquisa }}" class="w-100">
                        <ion-icon name="heart" class="me-2"></ion-icon>Instituições
                    </a>
                    <hr>

                    <a href="/pesquisa/campanha?q={{ $pesquisa }}" class="w-100">
                        <ion-icon name="heart" class="me-2"></ion-icon>Campanhas
                    </a>
                    <hr>

                    <a href="/pesquisa/pessoas?q={{ $pesquisa }}" class="w-100">
                        <ion-icon name="people" class="me-2"></ion-icon>Pessoas
                    </a>
                    <hr>

                    <a href="/pesquisa/postsusers?q={{ $pesquisa }}" class="w-100">
                        <ion-icon name="people" class="me-2"></ion-icon>Posts de usuários
                    </a>
                    <hr>

                    <a href="/pesquisa/postsinstitutes?q={{ $pesquisa }}" class="w-100">
                        <ion-icon name="people" class="me-2"></ion-icon>Posts de instituições
                    </a>
                    <hr>

                </div>
            </div>
            <div class="col-sm-9">
                <div class="container mt-3">

                    <h4>
                        <ion-icon name="search-circle-outline" class="me-2"></ion-icon>Você está pesquisando por
                        "{{ $pesquisa }}"
                    </h4>

                    @if ($qtd_posts < 1)
                        <div class="container bg-white p-3 mt-3 mb-3 rounded">
                            <div class="container text-center">
                                <h5>Não encontramos nenhuma postagem com esse termo! 😢</h5>
                                <div class="container p-3">
                                    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_sosleqza.json"
                                        background="transparent" speed="1" style="width: 80%;" class="mx-auto" loop
                                        autoplay></lottie-player>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($posts_users as $post)
                            <div class="container bg-white p-3 mt-3 mb-3 rounded">
                                <div class="mt-1">
                                    <div class="row mt-1">
                                        <div class="col-post-foto">
                                            <div class="text-center p-2">
                                                @if ($post->profile_photo_path == '')
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->name) }}&color=7F9CF5&background=EBF4FF"
                                                        alt="Imagem de perfil">
                                                @else
                                                    <img src="/storage/{{ $post->profile_photo_path }}"
                                                        alt="Imagem de perfil">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-post-data">
                                            <div class="container">
                                                <a href="/perfil/{{ $post->id }}">
                                                    <b>{{ $post->name }}</b>
                                                </a>
                                                <p>{{ $post->data }}</p>

                                                @if ($post->image != '')
                                                    <img src="{{ $post->image }}" alt="Imagem"
                                                        class="img-fluid rounded shadow mb-3">
                                                @endif

                                                <div class="row">
                                                    <div class="col-sm">
                                                        <p class="text-muted me-3">Postado em {{date('d/m/Y', strtotime($post->created_at))}}</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <form action="/report_post_institute/{{ $post->id }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="border-0 bg-white"
                                                                onclick="return alert('Post reportado! Nossa equipe verificará o ocorrido o mais rápido possível! 😉');">
                                                                <span class="text-primary">Reportar post</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        @if (count($posts_users) > 29)
                            <div class="container bg-white rounded shadow p-3 mt-3 mb-3">
                                <div class="wrapper">
                                    {{ $posts_users->appends(['q' => $pesquisa])->links() }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
